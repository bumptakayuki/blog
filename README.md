# SQL
```
CREATE DATABASE blog CHARACTER SET utf8mb4

CREATE TABLE posts (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  title TEXT,
  description TEXT,
  username TEXT,
  created_at TIMESTAMP
);

CREATE TABLE users (
user_id INT( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
username VARCHAR( 25 ) NOT NULL ,
email VARCHAR( 35 ) NOT NULL ,
password VARCHAR( 60 ) NOT NULL ,
UNIQUE (email)
);
```
