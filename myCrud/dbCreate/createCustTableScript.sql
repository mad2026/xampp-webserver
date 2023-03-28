USE phpcrud;
-- create a new table
CREATE TABLE customers (
   custId INT AUTO_INCREMENT NOT NULL,
   custName VARCHAR(100) NOT NULL,
   custEmail VARCHAR(150) UNIQUE NOT NULL,
   custPassword VARCHAR(100),
   PRIMARY KEY (custId)
);
INSERT INTO customers (custName, custEmail, custPassword)
VALUES
('Sam Henry', 'sam@henry.com', NULL),
('Wilma Flinstone', 'wilma@bedrock.com', NULL),
('William Gates', 'bill@gates.com', NULL);
/*
-- CREATE USER 
CREATE USER 'kermit'@'localhost' IDENTIFIED BY 'sesame';

USE phpcrud;
GRANT SELECT, INSERT, UPDATE ON customers TO 'kermit'@'localhost';
FLUSH PRIVILEGES;
*/