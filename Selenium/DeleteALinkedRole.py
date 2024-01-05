from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.common.actions.action_builder import ActionBuilder
from selenium.webdriver.common.by import By
import time

def EnterText(xpath,text): #Function to send keys to a specified XPATH with specified text
    textbox = driver.find_element(By.XPATH, xpath)
    textbox.send_keys(text)

def EnterByPlaceholder(placeholder,text): #Function to send keys to a textbox by reffering to its placeholder text
    EnterText("//input[@placeholder='"+placeholder+"']",text)

def EnterByID(ID,text):
    driver.find_element(By.ID,ID).send_keys(text) #Function to send keys to a textbox by its ID

def ClickByText(objClass,text): #Function to Click elements by type
    button = driver.find_element(By.XPATH, "//"+objClass+"[(text()='"+text+"')]")
    button.click()

def ClickByID(ID): #Function to click button type elements 
    button = driver.find_element(By.ID, ID)
    button.click()

def ClickButtonByText(text): #Function to click button type elements 
    ClickByText('button',text)

def ClickByXPath(xpath):
    element = driver.find_element(By.XPATH, xpath)
    element.click()

options = Options()
options.add_argument("--window-size=1600,900")
driver = webdriver.Chrome(options=options)
driver.get("http://localhost/login.php")

#Enter the user information on form using send_keys functions by placeholder XPATH
EnterByPlaceholder('Email','admin@gmail.com')
EnterByPlaceholder('Password','Password123!')
#ClickByText('a','Already got an account?') #This Clicks elements that are not of button class
ClickButtonByText('Login')
ClickByText('a','Role Management') #href buttons require a class instead of button, therefore needing clickByText function
time.sleep(1)
ClickByXPath("/html/body/div[3]/table/tbody[2]/tr[3]/td[2]/div/form[1]/button")
time.sleep(1)
ClickByID('DeleteRole') #Cannot do same as above due to conflict
time.sleep(0.5)
driver.get("http://localhost/Users.php")

time.sleep(60) #Prevent software from exiting immediately

