CREATE TABLE users (
	nsu_id VARCHAR(10) PRIMARY KEY,
    email VARCHAR(50),
    nsu_email VARCHAR(50),
    passkey VARCHAR(255) NOT NULL,
    fullname VARCHAR(150) NOT NULL DEFAULT "user123",
    department VARCHAR(255),
    completed_credit TINYINT(255) NOT NULL DEFAULT 0,
    profile_pic VARCHAR(255)  
);