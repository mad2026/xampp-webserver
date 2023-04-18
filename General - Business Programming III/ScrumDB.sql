DROP DATABASE scrumprojectprog3acme;
CREATE DATABASE scrumprojectprog3acme;
USE scrumprojectprog3acme;


CREATE TABLE acme_user_accounts (
   user_id INT AUTO_INCREMENT NOT NULL UNIQUE,
   job_title VARCHAR(15) NOT NULL,
   first_name VARCHAR(30) NOT NULL,
   last_name VARCHAR(30) NOT NULL,
   creation_date VARCHAR(50) NOT NULL,
   encrypted_password VARCHAR(50),
   PRIMARY KEY (user_id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE medications (
   medication_id INT AUTO_INCREMENT NOT NULL unique,
   medication_name VARCHAR(30) NOT NULL,
   PRIMARY KEY (medication_id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE patient_information (
   patient_id INT AUTO_INCREMENT NOT NULL UNIQUE,
   first_name VARCHAR(100) NOT NULL,
   last_name VARCHAR(150) NOT NULL,
   gender VARCHAR(150) NOT NULL,
   birth_date VARCHAR(150) NOT NULL,
   genetics VARCHAR(500),
   diabetes VARCHAR(3) NOT NULL,
   other_conditions VARCHAR(500),
   PRIMARY KEY (patient_id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE doctor_visit_fev1 (
   visit_id INT AUTO_INCREMENT NOT NULL UNIQUE,
   patient_id INT NOT NULL,
   doctor_user_id INT NOT NULL,
   date_time VARCHAR(100) NOT NULL,
   fev1 VARCHAR(15) NOT NULL,
   PRIMARY KEY (visit_id),
   FOREIGN KEY (patient_id) REFERENCES patient_information(patient_id),
   FOREIGN KEY (doctor_user_id) REFERENCES acme_user_accounts(user_id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE medication_prescribed (
   patient_id INT NOT NULL,
   medication_id INT NOT NULL,
   visit_id INT NOT NULL,
   medication_type VARCHAR(50),
   notes_dosage VARCHAR(500),
   PRIMARY KEY (patient_id, medication_id),
   FOREIGN KEY (visit_id) REFERENCES doctor_visit_fev1(visit_id),
   FOREIGN KEY (medication_id) REFERENCES medications(medication_id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;	


/*sample data inserted*/



insert  into acme_user_accounts(user_id, job_title, first_name, last_name, creation_date,encrypted_password) values 
(NULL,'Doctor','Sam','Winchester',20230101,'5a639c4d66f148a9744a7b5b7b341a00641122da'),
(NULL,'Nurse','Ratchet','Ash',20230101,'5a639c4d66f148a9744a7b5b7b341a00641122da'),
(NULL,'Doctor','Harrison','Ford',20230101,'5a639c4d66f148a9744a7b5b7b341a00641122da');

insert  into medications(medication_id,medication_name) values 
(NULL,'Vest'),
(NULL,'Acapella'),
(NULL,'Pulmozyme'),
(NULL,'Inhaled Tobi'),
(NULL,'Hypertonic saline'),
(NULL,'Azithromycin'),
(NULL,'Clarithromycin'),
(NULL,'Gentamicin'),
(NULL,'Enzymes');

insert  into patient_information(patient_id, first_name, last_name, gender, birth_date, genetics, diabetes, other_conditions) values 
(NULL,'Adam','Sandler','Male',19700101,'Bad','No','Makes some terrible movies. Some good ones too'),
(NULL,'Hugh','Jackman','Male',19600605,'Good','No','Has metal bones'),
(NULL,'John','Goodman','Male',19301205,'Bad','Yes',NULL);

insert  into doctor_visit_fev1(visit_id, patient_id, doctor_user_id, date_time, fev1) values 
/* I'm not sure how date/time will be implemented here with php code. the format can probably be improved from what I put in. */
(NULL,1,1,'20230101 1:00','65, 70, 68'),
(NULL,1,2,'20230201 1:00','65, 70, 68'),
(NULL,1,3,'20230301 1:00','65, 70, 68'),
(NULL,2,1,'20230301 1:00','65, 70, 68'),
(NULL,2,2,'20230301 1:00','65, 70, 68'),
(NULL,2,3,'20230301 1:00','65, 70, 68'),
(NULL,3,1,'20230301 1:00','65, 70, 68'),
(NULL,3,2,'20230301 1:00','65, 70, 68'),
(NULL,3,3,'20230301 1:00','65, 70, 68');

insert  into medication_prescribed(patient_id, medication_id, visit_id, medication_type, notes_dosage) values 
(1,1,1,NULL,'Random notes'),
(1,2,1,NULL,'Random notes'),
(1,3,1,NULL,'Received on 02/12/2018'),
(2,4,1,NULL,'Random notes'),
(2,5,1,'3%','Saline'),
(2,6,1,NULL,'Random notes'),
(3,7,1,NULL,'Random notes'),
(3,8,1,NULL,'Random notes'),
(3,9,1,'Creon','2400 mg');


-- create user only run the commands below once  
CREATE USER 'kermit'@'localhost' IDENTIFIED BY 'sesame';

USE scrumprojectprog3acme;
GRANT SELECT, INSERT, UPDATE ON acme_user_accounts TO 'kermit'@'localhost';
GRANT SELECT, INSERT, UPDATE ON patient_information TO 'kermit'@'localhost';
GRANT SELECT, INSERT, UPDATE ON medications TO 'kermit'@'localhost';
GRANT SELECT, INSERT, UPDATE ON doctor_visit_fev1 TO 'kermit'@'localhost';
FLUSH PRIVILEGES;