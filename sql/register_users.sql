CREATE TABLE register_users (
	nsu_id VARCHAR(10) PRIMARY KEY,
    email VARCHAR(50),
    passkey VARCHAR(255) NOT NULL,
    fullname VARCHAR(150) 
);