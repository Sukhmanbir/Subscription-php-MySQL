DROP TABLE IF EXISTS android;
CREATE TABLE android(
	id             INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name     VARCHAR(50)  NOT NULL,
	last_name	   VARCHAR(50)  NOT NULL,
	gender		   VARCHAR(6)   NOT NULL,
	address		   VARCHAR(500) NOT NULL,
	province       CHAR(2)      NOT NULL,
    email          VARCHAR(100) NOT NULL,
    UNIQUE(email)
);
