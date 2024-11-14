CREATE TABLE review (
	review_id BIGINT AUTO_INCREMENT PRIMARY KEY,
    review_of VARCHAR(255) NOT NUll,
    learning_points TINYINT NOT NULL CHECK (learning_points BETWEEN 0 AND 10) DEFAULT 0,
    grading_points TINYINT NOT NULL CHECK (grading_points BETWEEN 0 AND 10) DEFAULT 0,
    user_comment TEXT,
    review_by VARCHAR(255),
    is_anonymous BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (review_of) REFERENCES faculty(initial)   
);