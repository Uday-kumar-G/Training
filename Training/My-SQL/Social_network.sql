
-- 1st Create a database to implement a simple social network like facebook. You'll need to store a persons information, his friends information and his posts. Create relevant tables with keys for this using the schema below
create db facebook;
USE facebook;
CREATE TABLE USER( USER_ID INT PRIMARY KEY AUTO_INCREMENT, 
NAME VARCHAR(40) NOT NULL, 
EMAIL VARCHAR(40) NOT NULL, 
PASSWORD VARCHAR(40) NOT NULL,
ADDRESS VARCHAR(100),
PHONE VARCHAR(10));


CREATE TABLE FRIEND(
    USER_ID INT, 
    FRIEND_ID INT,
    FOREIGN KEY(USER_ID) REFERENCES USER(USER_ID),
    FOREIGN KEY(FRIEND_ID) REFERENCES USER(USER_ID));


CREATE TABLE WALL(USER_ID INT,POSTING_DATE DATETIME DEFAULT CURRENT_TIMESTAMP, 
POST VARCHAR(200) NOT NULL, FOREIGN KEY(USER_ID) REFERENCES USER(USER_ID));


 INSERT INTO USER(NAME,EMAIL,PASSWORD,ADDRESS,PHONE)VALUES('Uday Kumar', 'uday@gmail.com', 'uday123', 'Bengaluru', '9876543210'),
     ('Rahul Sharma', 'rahul@gmail.com', 'rahul123', 'Mysuru', '9876543211'),
     ('Priya Reddy', 'priya@gmail.com', 'priya123', 'Hyderabad', '9876543212'),
     ('Arun Kumar', 'arun@gmail.com', 'arun123', 'Chennai', '9876543213'),
     ('Sneha Rao', 'sneha@gmail.com', 'sneha123', 'Mangaluru', '9876543214'),
     ('Kiran Raj', 'kiran@gmail.com', 'kiran123', 'Bengaluru', '9876543215');


     INSERT INTO FRIEND(USER_ID,FRIEND_ID)VALUES(1, 2),
     (1, 3),
     (1, 5),
     (2, 3),
     (2, 4),
     (3, 5),
     (3, 6),
     (4, 1),
     (5, 2),
     (6, 1);



 INSERT INTO WALL(USER_ID,POST)VALUES
     (1, 'Hello everyone! This is my first post.'),
     (2, 'Learning SQL today.'),
     (3, 'Good morning everyone!'),
     (1, 'SQL joins are interesting.'),
     (4, 'Working on my new project.'),
     (5, 'Happy to connect with everyone.'),
     (6, 'Practicing database concepts.'),
     (2, 'Completed my SQL assignment.'),
     (3, 'Learning about foreign keys.'),
     (1, 'Database practice completed!');


-- 2ND Write a query to fetch all information for a person given his name.
select * from USER WHERE NAME='Uday Kumar';

-- 3RD. Write a query to fetch all posts of a person given his name
SELECT *FROM WALL WHERE USER_ID=(SELECT USER_ID FROM USER WHERE NAME='Uday Kumar');

-- 4TH. Write a query to fetch all posts of a particular friend of a person, given his name and the friends name.
SELECT * FROM WALL WHERE USER_ID =( 
    SELECT USER_ID FROM USER WHERE NAME='Rahul Sharma' AND USER_ID IN (
        SELECT F.FRIEND_ID  FROM USER U JOIN FRIEND F ON U.USER_ID=F.USER_ID 
        WHERE U.NAME="Uday Kumar"));

-- 5TH. Write a query to fetch all friends of a particular friend of a person, given the persons name and friend's name.
SELECT * FROM USER WHERE USER_ID IN (
    SELECT F.FRIEND_ID FROM USER U JOIN FRIEND F ON U.USER_ID=F.USER_ID WHERE U.NAME='Rahul Sharma' and U.USER_ID IN (
        SELECT F.FRIEND_ID FROM USER U JOIN FRIEND F ON U.USER_ID=F.USER_ID WHERE U.NAME='Uday Kumar'));


-- 6TH. Write a query to remove a particular friend from a persons list, given the persons name
DELETE FROM FRIEND WHERE USER_ID=(SELECT USER_ID FROM USER WHERE NAME="Uday Kumar")AND 
FRIEND_ID=(SELECT USER_ID FROM USER WHERE NAME="Rahul Sharma");

-- 7TH. Write a query to post something on his wall
INSERT INTO WALL(USER_ID,POST) (SELECT USER_ID,"HELLO HOW ARE YOU" FROM USER WHERE NAME="Uday Kumar");
