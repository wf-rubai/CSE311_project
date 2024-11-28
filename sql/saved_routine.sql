CREATE TABLE save_routine (
    table_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(7) NOT NULL,          
    routine_data JSON,

    FOREIGN KEY (user_id) REFERENCES users(nsu_id) ON DELETE CASCADE         
);
