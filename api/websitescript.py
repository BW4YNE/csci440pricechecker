from selenium import webdriver
from bs4 import BeautifulSoup
import pymysql
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.chrome.options import Options





class SearchItem:
    def __init__(self, url):
        self.url = url
        pass

    def data(self):
        driver.get(self.url)
        soup = BeautifulSoup(driver.page_source, 'html.parser')
        results = soup.find_all('div', {'data-component-type': 's-search-result'})
        pass

    def write(self, file):
        pass


def get_url(term):
    return 'https://www.amazon.com/s?k=' + term.replace(' ', '+')


def search_for(search):
    conn = pymysql.connect(
        host='testdatabase.c6qpu4laltjr.us-east-2.rds.amazonaws.com',
        user='admin',
        password='testPass!',
        port=3306
    )
    cursor = conn.cursor()
    cursor.execute("select version()")
    data = cursor.fetchone()

    sql = '''use blah'''
    cursor.execute(sql)

    sql = f'''
    create table {search_term.replace(" ","")}(
    id int not null auto_increment,
    price text, 
    rating text, 
    reviews text, 
    description text, 
    url text,
    primary key (id))
    '''
    cursor.execute(sql)


    file_title = search
    search = get_url(search)
    driver.get(search)
    soup = BeautifulSoup(driver.page_source, 'html.parser')
    results = soup.find_all('div', {'data-component-type': 's-search-result'})
    for result in results:
        item = result
        atag = item.h2.a
        desc = atag.text.strip()
        url = 'https://www.amazon.com' + atag.get('href')

        try:
            price_parent = item.find('span', 'a-price')
        except AttributeError:
            price_parent = ''
        try:
            price = price_parent.find('span', 'a-offscreen').text
        except AttributeError:
            price = 'Unavailable'
        try:
            rating = item.i.text
        except AttributeError:
            rating = ''
        try:
            reviews = item.find('span', {'class': 'a-size-base', 'dir': 'auto'}).text
        except AttributeError:
            reviews = ''
        try:
            str(price)
        except AttributeError:
            price = 'NULL'
        try:
            str(desc)
        except AttributeError:
            desc = 'NULL'
        try:
            str(rating)
        except AttributeError:
            rating = 'NULL'
        try:
            str(reviews)
        except AttributeError:
            reviews = 'NULL'
        output = "{}," \
                 "{}," \
                 "{}," \
                 "{}," \
                 "{};".format(desc.replace(',', '.'), price.replace(',', '.'),
                              rating.replace(',', '.'), reviews.replace(',', '.'), url)
        print(output)

        sql = f'''insert into {search_term.replace(" ","")} (price,rating,reviews,description,url) 
        values ("{price}", "{rating}", "{reviews}", "{desc}", "{url}")'''
        cursor.execute(sql)
        cursor.connection.commit()


#C:/Program Files (x86)/Google/Chrome/chromedriver   

#chrome_options = Options()
#chrome_options.add_argument("--headless")

search_term = str(input("Search term: "))

#driver = webdriver.Chrome(C:/Program Files (x86)/Google/Chrome/chromedriver) <--This was the original code when ran locally. Might have to downlaod bs4 and selenium for this to work

driver = webdriver.Chrome("selenium/webdriver/chrome/") #<--- This directory path is what is giving me issues when trying to implement this online-
#- here. Since this path is for local use, I can't figure out how to make this work on Vercel... if we can even run a web browser instance on here.

#driver.get("https://www.google.co.in")
search_for(search_term)






