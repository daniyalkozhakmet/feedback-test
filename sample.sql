   CREATE TABLE IF NOT EXISTS feedbacks ( 
     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
     name VARCHAR(30) NOT NULL, 
     email VARCHAR(30) NOT NULL, 
     phone VARCHAR(30) NOT NULL, 
     message TEXT NOT NULL, 
     image VARCHAR(255) NOT NULL, 
           is_accepted BOOLEAN default false, 
           is_edited BOOLEAN default false, 
     user_id INT(6) UNSIGNED, 
     date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
           FOREIGN KEY (user_id) REFERENCES users(id) 
           ); 