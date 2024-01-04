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
    driver.find_element(By.ID,ID).send_keys(text) #Function to send keys to a textbox by its ID

def ClickByText(objClass,text): #Function to Click elements by type
    button = driver.find_element(By.XPATH, "//"+objClass+"[(text()='"+text+"')]")
    button.click()

def ClickByID(ID): #Function to click button type elements 
    button = driver.find_element(By.ID, ID)
    button.click()

def ClickButtonByText(text): #Function to click button type elements 
    ClickByText('button',text)

def UploadFileByXpath(xpath,fileLocation): #Function to upload file by xpath using filepath to POST files in form
    elem = driver.find_element(By.XPATH,xpath)
    elem.send_keys(fileLocation)


options = Options()
options.add_argument("--window-size=1600,900")
driver = webdriver.Chrome(options=options)
driver.get("http://localhost/login.php")

#Enter the user information on form using send_keys functions by placeholder XPATH
EnterByPlaceholder('Email','admin@gmail.com')
EnterByPlaceholder('Password','Password123!')
#ClickByText('a','Already got an account?') #This Clicks elements that are not of button class
ClickButtonByText('Login')
ClickByText('a','Inventory Management') #href buttons require a class instead of button, therefore needing clickByText function
ClickButtonByText('Edit')
time.sleep(0.5)
EnterText("/html/body/div[5]/div/div/div[2]/form/div[1]/input","Chicken") #Enter text directly through XPATH
EnterText("/html/body/div[5]/div/div/div[2]/form/div[2]/textarea","It's a chicken.")
EnterText("/html/body/div[5]/div/div/div[2]/form/div[4]/input","4.73")
EnterText("/html/body/div[5]/div/div/div[2]/form/div[5]/input","5.2")
EnterText("/html/body/div[5]/div/div/div[2]/form/div[6]/input","26")
UploadFileByXpath("/html/body/div[5]/div/div/div[2]/form/div[7]/input","C:\\Users\\Hannah\\Pictures\\Chicken.png")
ClickButtonByText('Update')

time.sleep(60) #Prevent software from exiting immediately
