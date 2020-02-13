from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

usr_pass_tuples = [("user@phptravels.com", "demouser")]

#usr_pass_tuples = [("user@phptravels.com", "demouser"), ("user@phptravels.com", "1demouser"),
#                   ("user@phptravels.com", "demouser"), ("user@phptravels.com", "demouser"),
#                   ("user@phptravels.com", "demouser")]

for usr_pass_tuple in usr_pass_tuples:
    driver = webdriver.Chrome("/Users/ege/Downloads/chromedriver")
    driver.get("https://www.phptravels.net/login")
    assert "Login" in driver.title


    user_input = driver.find_element_by_name("username")
    password_input = driver.find_element_by_name("password")
    #login_button = driver.find_element_by_class_name("loginbtn")

    user_input.clear()
    user_input.send_keys(usr_pass_tuple[0])

    password_input.clear()
    password_input.send_keys(usr_pass_tuple[1])

    password_input.send_keys(Keys.RETURN)

    print(driver.current_url)
    print(driver.title)
    print(driver.find_element_by_tag_name("title").text)

    delay = 3  # seconds
    myElem = WebDriverWait(driver, delay)#.until(EC.presence_of_element_located((By.ID, 'IdOfMyElement')))
    print (driver.title)

    #driver.close()
#assert "Python" in driver.title




