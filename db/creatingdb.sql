//USER_TABLE
CREATE TABLE user(
    username VARCHAR(50) NOT NULL PRIMARY KEY,
    email VARCHAR(50) NOT NULL ,
    h_password VARCHAR(40) NOT NULL,
    salt VARCHAR(30) NOT NULL,
    firstname VARCHAR(25) NOT NULL,
    lastname VARCHAR(25) NOT NULL
);


INSERT INTO user (
    email, h_password, salt, firstname, lastname
) VALUES('user1@njit.edu','3d589ce4187655bb60cfc97469440bda782856f8', 'wROfqKslpSy02RVfAhlc','test','user');


//RESTAURANT_TABLE 
CREATE TABLE restaurant(
    restaurant_id INT(10) NOT NULL PRIMARY KEY,
    restaurant_name VARCHAR(25), 
    restaurant_address VARCHAR(100),
    city_id INT(8),
    menu_url VARCHAR(2083),
    thumbnail_url VARCHAR(2083),
    aggregate_rating DECIMAL(2,1),
    rating_text VARCHAR(15)

);

//REVIEW_TABLE
CREATE TABLE review(
    username VARCHAR(50) NOT NULL,
    restaurant_id INT(10) NOT NULL,
    review_text VARCHAR(1000),
    review_rating DECIMAL(2,1),
    CONSTRAINT fk3_restaurant_id FOREIGN KEY (restaurant_id) REFERENCES restaurant(restaurant_id),
    CONSTRAINT fk2_username FOREIGN KEY (username) REFERENCES user(username)
);

//SUGGESTION_TABLE
CREATE TABLE suggestion(
    username VARCHAR(50) NOT NULL,
    restaurant_id INT(10) NOT NULL,
    suggestion VARCHAR(250),
    dish_name VARCHAR(50),
    CONSTRAINT fk2_restaurant_id FOREIGN KEY (restaurant_id) REFERENCES restaurant(restaurant_id),
    CONSTRAINT fk1_username FOREIGN KEY (username) REFERENCES user(username)

);

//FAVORITE_TABLE
CREATE TABLE favorite(
    username VARCHAR(50) NOT NULL,
    restaurant_id INT(10) NOT NULL,
    CONSTRAINT fk_restaurant_id FOREIGN KEY (restaurant_id) REFERENCES restaurant(restaurant_id),
    CONSTRAINT fk_username FOREIGN KEY (username) REFERENCES user(username)
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
    CONSTRAINT fk_restaurant_id FOREIGN KEY (restaurant_id) REFERENCES restaurant(restaurant_id),
    CONSTRAINT fk_cuisine_id FOREIGN KEY (cuisine_id) REFERENCES cuisine(cuisine_id)
);

//USADATA_TABLE
CREATE TABLE usadata(
    zip INT(5),
    state CHAR(2),
    city VARCHAR(25),
    lat DOUBLE,
    lon DOUBLE
);

CREATE TABLE dish_name(
    restaurant_id INT(10) NOT NULL,
    dish VARCHAR(100) NOT NULL,
    CONSTRAINT fk4_restaurant_id FOREIGN KEY (restaurant_id) REFERENCES restaurant(restaurant_id) ON DELETE CASCADE
);



    
 
















