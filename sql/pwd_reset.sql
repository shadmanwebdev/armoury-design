CREATE TABLE pwd_reset (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pwd_reset_email VARCHAR(255) NOT NULL,
    pwd_reset_selector TEXT NOT NULL,
    pwd_reset_token TEXT NOT NULL,
    pwd_reset_expires TEXT NOT NULL
);