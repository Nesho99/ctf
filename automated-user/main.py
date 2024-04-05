import asyncio
from pyppeteer import launch
from time import sleep

async def main():
    
    browser = await launch(
    headless=False,
    executablePath="C:\Program Files\Google\Chrome Beta\Application\chrome.exe",
    slowMo=5
    )
    page = await browser.newPage()
    
 
    await page.goto('http://localhost/admin-login.html')

    await page.type('input[name="username"]', 'admin')
    await page.type('input[name="password"]', 'MrR0b0t15Th3B3st')
    
    login_button_selector = 'button[type="submit"]'
    await page.click(login_button_selector)
    await browser.close()
    


asyncio.get_event_loop().run_until_complete(main())
