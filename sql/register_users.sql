CREATE TABLE register_users (
	nsu_id VARCHAR(10) NOT NULL,
    email VARCHAR(50),
    passkey VARCHAR(255) NOT NULL,
    fname VARCHAR(150),
    lname VARCHAR(150),
    
    PRIMARY KEY (nsu_id)
);