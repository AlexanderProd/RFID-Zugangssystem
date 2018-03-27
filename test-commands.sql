CREATE DATABASE test_db;

SHOW DATABASES;

DROP DATABASE test_db;

CREATE TABLE accounts (
	id TINYINT,
    firstName TINYTEXT,
    lastName TINYTEXT
);

INSERT INTO accounts (id, firstName, lastName)
VALUES ('2', 'Alexander', 'Hoerl');

SELECT * FROM accounts;

DELETE FROM accounts
WHERE id = '3';