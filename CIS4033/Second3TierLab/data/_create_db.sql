/*****************************************
* Create the my_first_3_tier_app  database
*****************************************/
DROP DATABASE IF EXISTS my_first_3_tier_app;
CREATE DATABASE my_first_3_tier_app;
USE my_first_3_tier_app;  -- MySQL command

-- create the table
CREATE TABLE my_customers (
  email       VARCHAR(255)        NOT NULL,
  password    VARCHAR(255)   	  NOT NULL,
  first_name  VARCHAR(255) 		NOT NULL,
  state		VARCHAR(2)			NOT NULL,
  zip       VARCHAR(10)			NOT NULL,
  phone		VARCHAR(20)			NOT NULL,
  membership_type VARCHAR(20)   NOT NULL,
  starting_date DATETIME        NOT NULL,
  PRIMARY KEY (email)
);

-- create the users and grant priveleges to those users
CREATE USER kermit
IDENTIFIED BY 'sesame';

GRANT SELECT, INSERT, DELETE, UPDATE
ON my_customers
TO kermit@localhost
IDENTIFIED BY 'sesame';

