CREATE DATABASE you_gallery;

USE you_gallery;

CREATE TABLE user(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, username VARCHAR(25) NOT NULL, password VARCHAR(128) NOT NULL, email VARCHAR(50) NOT NULL, status VARCHAR(50), profile_picture BLOB);

CREATE TABLE picture(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, user_id INT NOT NULL, name VARCHAR(60) NOT NULL, FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE); 

CREATE TABLE user_comments_picture(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, user_id INT NOT NULL, picture_id INT NOT NULL, comment VARCHAR(150) NOT NULL, FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY (picture_id) REFERENCES picture(id) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE theme(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, name VARCHAR(25) NOT NULL);

CREATE TABLE picture_has_theme(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, picture_id INT NOT NULL, theme_id INT NOT NULL, FOREIGN KEY (picture_id) REFERENCES picture(id) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY (theme_id) REFERENCES theme(id) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE user_follows_theme(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, user_id INT NOT NULL, theme_id INT NOT NULL, FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY (theme_id) REFERENCES theme(id) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE user_likes_picture(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, user_id INT NOT NULL, picture_id INT NOT NULL, FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY (picture_id) REFERENCES picture(id) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE user_follows_user(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, user1_id INT NOT NULL, user2_id INT NOT NULL, FOREIGN KEY (user1_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY (user2_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE);