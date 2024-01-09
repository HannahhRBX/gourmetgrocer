from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.common.actions.action_builder import ActionBuilder
from selenium.webdriver.common.by import By
import time

def EnterText(xpath,text): #Function to send keys to a specified XPATH with specified text
    textbox = driver.find_element(By.XPATH, xpath)
    textbox.clear() #Make sure textbox does not have text in already
    textbox.send_keys(text)

def EnterByPlaceholder(placeholder,text): #Function to send keys to a textbox by reffering to its placeholder text
    EnterText("//input[@placeholder='"+placeholder+"']",text)

def EnterByID(ID,text):
    textbox = driver.find_element(By.ID,ID)
    textbox.clear() #Make sure textbox does not have text in already
    textbox.send_keys(text) #Function to send keys to a textbox by its ID

def ClickByText(objClass,text): #Function to Click elements by type
    button = driver.find_element(By.XPATH, "//"+objClass+"[(text()='"+text+"')]")
    button.click()

def ClickButtonByText(text): #Function to click button type elements 
    ClickByText('button',text)

options = Options()
options.add_argument("--window-size=1800,900")
driver = webdriver.Chrome(options=options)
driver.get("http://localhost/login.php")

#Enter the user information on form using send_keys functions by placeholder XPATH
EnterByPlaceholder('Email','admin@gmail.com')
EnterByPlaceholder('Password','Password123!')
#ClickByText('a','Already got an account?') #This Clicks elements that are not of button class
ClickButtonByText('Login')
ClickByText('a','Inventory') #href buttons require a class instead of button, therefore needing clickByText function
time.sleep(1)
EnterByID("ItemQuantity","12") #Enter restock values
ClickButtonByText('Restock')
time.sleep(1)
driver.get("http://localhost/Cart.php") #Navigate to cart

time.sleep(60) #Prevent software from exiting immediately


