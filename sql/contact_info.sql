CREATE TABLE contact_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    addr VARCHAR(255) DEFAULT NULL,
    phone VARCHAR(255) DEFAULT NULL,
    email VARCHAR(255) DEFAULT NULL
);

INSERT INTO contact_info (addr, phone, email) 
VALUES (
    '203 Fake St. Mountain View, San Francisco, California, USA',
    '+1 232 3235 324',
    'youremail@domain.com'
);