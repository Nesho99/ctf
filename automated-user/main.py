import asyncio 
from pyppeteer import launch 


async def main():
    browser = await launch(
        headless=True,
        executablePath="/snap/bin/chromium",
        slowMo=5,
        args=['--no-sandbox', '--headless']
    )
    page = await browser.newPage()

    await page.goto('http://localhost/admin-login.html')

    await page.type('input[name="username"]', 'moderator')
    await page.type('input[name="password"]', 'Y0uShallN0tP455!')

    login_button_selector = 'button[type="submit"]'
    await page.click(login_button_selector)
    content = await page.content()
    print(content)
    await browser.close()

asyncio.get_event_loop().run_until_complete(main())
