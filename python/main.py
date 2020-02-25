import os
import sys
import json
import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

class SRSTest(unittest.TestCase):
    @classmethod
    def setUp(self):
        parameter_path = os.path.join(sys.path[0], 'parameter.json')
        with open(parameter_path) as f:
            my_dict = json.load(f)
        self.driver = webdriver.Chrome(my_dict["chromedriver"])
        self.driver.implicitly_wait(5)
        self.url = my_dict["url"]
    
    @classmethod
    def tearDown(self):
        self.driver.quit()
    
    def test_successful_login(self):
        driver = self.driver
        driver.get(self.url)
        self.login(driver, "21602150", "admin")
        
        timeout = 5
        try:
            element_present = EC.presence_of_element_located((By.ID, 'Logout'))
            WebDriverWait(driver, timeout).until(element_present)
        except TimeoutException:
            print("Scenario 1: Successful Login FAIL")
            raise TimeoutException
        except Exception:
            print("Scenario 1: Successful Login FAIL")
            raise Exception
        
        try:
            self.assertEqual(driver.find_element_by_xpath("/html/body/center/h1").text, "Welcome 21602150")
            print("Scenario 1: Successful Login OK")
        except Exception:
            print("Scenario 1: FAIL")
            raise Exception

    def test_very_long_string(self):
        driver = self.driver
        driver.get(self.url)
        very_long_string = "x" * 500
        self.login(driver, very_long_string, very_long_string)
        try:
            alert = driver.switch_to.alert
            self.assertEqual(alert.text, "No such user with the given password in the system")
            print("Scenario 2: Very Long String OK")
        except Exception:
            print("Scenario 2: Very Long String FAIL")
            raise Exception

    def test_wrong_password(self):
        driver = self.driver
        driver.get(self.url)
        self.login(driver, "21602150", "amdin")
        try:
            alert = driver.switch_to.alert
            self.assertEqual(alert.text, "No such user with the given password in the system")
            print("Scenario 3: Wrong Password OK")
        except Exception:
            print("Scenario 3: Wrong Password FAIL")
            raise Exception

    def test_page_opens(self):
        driver = self.driver
        driver.get(self.url)
        try:
            self.assertTrue("Login" in driver.title)
            # TODO assert other parts of the webpage also loads
            print("Scenario 4: Web Page Loading OK")
        except Exception:
            print("Scenario 4: Web Page Loading FAIL")

    def test_sql_injection(self):
        driver = self.driver
        driver.get(self.url)
        injection = ' " or ""=" '
        self.login(driver, injection, injection)
        try:
            alert = driver.switch_to.alert
            self.assertEqual(alert.text, "No such user with the given password in the system")
            print("Scenario 5: SQL Injection OK")
        except Exception:
            print("Scenario 5: SQL Injection FAIL")
            raise Exception

    @classmethod
    def login(cls,driver,username, password):
        user_input = driver.find_element_by_name("bil_id")
        password_input = driver.find_element_by_name("pass")
        
        user_input.clear()
        user_input.send_keys(username)
        
        password_input.clear()
        password_input.send_keys(password)
        
        password_input.send_keys(Keys.RETURN)


if __name__ == "__main__":
    unittest.main()