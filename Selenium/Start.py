from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.common.by import By
import time

def EnterText(xpath,text): #Function to send keys to a specified XPATH with specified text
    textbox = driver.find_element(By.XPATH, xpath)
    textbox.send_keys(text)

def EnterByPlaceholder(placeholder,text): #Function to send keys to a textbox by reffering to its placeholder text
    EnterText("//input[@placeholder='"+placeholder+"']",text)

def ClickByText(objClass,text): #Function to Click elements by type
    button = driver.find_element(By.XPATH, "//"+objClass+"[(text()='"+text+"')]")
    button.click()

def ClickButtonByText(text): #Function to click button type elements 
    ClickByText('button',text)

options = Options()
options.add_argument("--window-size=1600,900")
driver = webdriver.Chrome(options=options)
driver.get("http://localhost/register.php")

#Enter the user information on form using send_keys functions by placeholder XPATH
EnterByPlaceholder('Firstname','Admin')
EnterByPlaceholder('Surname','Test')
EnterByPlaceholder('Email','admin@gmail.com')
EnterByPlaceholder('Password','Password123')
EnterByPlaceholder('Password again','Password123')
#ClickByText('a','Already got an account?') #This Clicks elements that are not of button class
ClickButtonByText('Register')
time.sleep(60) #Prevent software from exiting immediately
