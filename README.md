# Ciphers: A Dish Suggestion App

The repository contains all of the necessary code files to run this Dish Suggestion application. This was created as a project for IT490-104, Systems Integration at NJIT under Donald Kehoe. Users will be able to find restaurants around the world. Users can view list of restaurants, restaurant’s menu, add restaurants to favorite list and can suggest their new dishes to add to the restaurant's menu. Users are also able to rate and review the restaurant. You can see technologies used in the project below.

* Front End: PHP, HTML, CSS, JavaScript and Bootstrap
* Backend: PHP, Simple HTML DOM library
* Technologies: RabbitMQ, MySQL, GIT
* Restaurants Data Source: Zomato

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.
The repository is divided into 4 folders i.e. Front end, Db, DMZ, RabittMQ

### Setting up

Following shows the instructions on how to set up the files and listener files to test the website:

* RabbitMQ:
  * Enable rabbitmq_management_plugin and start the rabbitMQ instance in web browser
  * Make two exchanges for the communication between front-end to database and database to dmz
    * First exchange: dbExchange and bind dbQueue to it
    * Second exchange: dmzExchange and bing dmzQueue to it
  * Make one exchange for error logging
    * rmqExchange and bind rmqQueue to it
  * In terminal start /rabbitmq/error_log/rmqListener.php (this will start listening to the errors sent from all servers)
* DB:
  * Database backup is in db/db_backup.sql
    * User: root
    * Password: hrishi123
  * Change /db/rabbitmqphp_example/rabbitMQ_db.ini file and assign BROKER_HOST the IP address of RabbitMQ server
  * Change /db/rabbitmqphp_example/rabbitMQ_dmz.ini file and assign BROKER_HOST the IP address of RabbitMQ server
  * Change /db/rabbitmqphp_example/rabbitMQ_rmq.ini file and assign BROKER_HOST the IP address of RabbitMQ server
  * In terminal start /db/php/dbListener.php (this will start listening to the messages sent from RabbitMQ server)
* DMZ:
  * Change /dmz/rabbitmqphp_example/rabbitMQ_db.ini file and assign BROKER_HOST the IP address of RabbitMQ server
  * Change /dmz/rabbitmqphp_example/rabbitMQ_rmq.ini file and assign BROKER_HOST the IP address of RabbitMQ server
  * In terminal start /dmz/php/dmzListener.php (this will start listening to the messages sent from RabbitMQ server)
* Front-end:
  * Change /frontend/rabbitmqphp_example/rabbitMQ_db.ini file and assign BROKER_HOST the IP address of RabbitMQ server
  * Change /frontend/rabbitmqphp_example/rabbitMQ_rmq.ini file and assign BROKER_HOST the IP address of RabbitMQ server
  * Open /fronend/html/loginRegister.html in browser to begin testing


## Running the tests

* Open /fronend/html/loginRegister.html in browser to begin testing
* Register:
  * Enter fields as specified to register a new user and then after submit close the modal
* Login:
  * Login with the registered username and password
* Search Restuarant page:
  * Select state: This will dinamically populate the cities of that state
  * Select city
  * Select cuisine
  * Hit search
* After the restaurants gets populated: 
  * Enter a suggestion for the restaurant by clicking on "Suggestion"
  * Enter a review for the restaurant by clicking on "Review"
  * To select the restaurant restaurant click on the name of the restaurant
* After select the unique restaurant from the list, you will be redirected to selected restaurant page
  * NOTE: webscrapping works but with hard-coded link, it shows some error when request sent from database.
  * To test the menu please select this combination: State-New Jersey, City-Parsipanny, Cuisine-Indian, Restaurant-Chand Palace (This menu is already populated using the hard-coded menu link)


## Zomato

* We would like to thank Zomato for providing us with API access free of use for this project. Feature requests for the Zomato Restaurants Data API, available [here](https://www.zomato.com).
 

## Authors

* **Jeet Patel** - *Front End* - [MrPatel95](https://github.com/MrPatel95)
* **Hrishi Patel** - *Database* - [HrishiPatel27](https://github.com/HrishiPatel27)
* **Ajay Patel** - *DMZ* - [ajayp98](https://github.com/ajayp98)
* **Jay Suthar** - *RabbitMQ* - [js745](https://github.com/js745)

## Acknowledgments

