//USER_TABLE
CREATE TABLE user(
    username VARCHAR(50) NOT NULL PRIMARY KEY,
    email VARCHAR(50) NOT NULL ,
    h_password VARCHAR(40) NOT NULL,
    salt VARCHAR(30) NOT NULL,
    firstname VARCHAR(25) NOT NULL,
    lastname VARCHAR(25) NOT NULL,
    dob_month INT(2),
    dob_date INT(2),
    dob_year INT(4),
    sex ENUM('M','F','O'),
    street_number VARCHAR(10),
    street_name VARCHAR(25),
    city VARCHAR(25),
    state VARCHAR(15),
    zip INT(5),
    country VARCHAR(15)
);


INSERT INTO user (
    email, h_password, salt, firstname, lastname
) VALUES('user1@njit.edu','3d589ce4187655bb60cfc97469440bda782856f8', 'wROfqKslpSy02RVfAhlc','test','user');

//CITY_TABLE
CREATE TABLE city(
    city_id INT(10) PRIMARY KEY,
    city_name VARCHAR(25)   
);

//RESTAURANT_TABLE 
CREATE TABLE restaurant(
    restaurant_id INT(10) NOT NULL PRIMARY KEY,
    city_id INT(10) NOT NULL,
    restaurant_name VARCHAR(25) NOT NULL,
    restaurant_address VARCHAR(100),
    menu_url VARCHAR(2083),
    thumbnail_url VARCHAR(2083),
    aggregate_rating ENUM ('1','2','3','4','5'),
    rating_text TEXT(15),
    FOREIGN KEY (city_id) REFERENCES city(city_id)

);

//REVIEW_TABLE
CREATE TABLE review(
    restaurant_id INT(10) NOT NULL,
    username VARCHAR(50) NOT NULL,
    review_text VARCHAR(1000),
    review_rating ENUM ('1','2','3','4','5'),
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(restaurant_id),
    FOREIGN KEY (username) REFERENCES user(username)
);

//SUGGESTION_TABLE
CREATE TABLE suggestion(
    username VARCHAR(50) NOT NULL,
    restaurant_id INT(10) NOT NULL,
    suggestion VARCHAR(250),
    dish_name VARCHAR(50),
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(restaurant_id),
    FOREIGN KEY (username) REFERENCES user(username)

);

//FAVORITE_TABLE
CREATE TABLE favorite(
    username VARCHAR(50) NOT NULL,
    restaurant_id INT(10) NOT NULL,
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(restaurant_id),
    FOREIGN KEY (username) REFERENCES user(username)
);

//CUISINE_TABLE
CREATE TABLE cuisine(
    cuisine_id INT(10) PRIMARY KEY,
    cuisine_name VARCHAR(50)
);

//RESTAURANT_CUISINE_TABLE
CREATE TABLE restaurant_cuisine(
    restaurant_id INT(10) NOT NULL,
    cuisine_id INT(10) NOT NULL,
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(restaurant_id),
    FOREIGN KEY (cuisine_id) REFERENCES cuisine(cuisine_id)
);

//USADATA_TABLE
CREATE TABLE usadata(
    zip INT(5),
    state CHAR(2),
    city VARCHAR(25),
    lat DOUBLE,
    lon DOUBLE
);



    
 
















