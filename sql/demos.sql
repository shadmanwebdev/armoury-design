CREATE TABLE demos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    tags VARCHAR(255) DEFAULT NULL,
    link VARCHAR(255) DEFAULT NULL,
    thumbnail VARCHAR(255) NOT NULL
);

INSERT INTO demos (title, tags, link, thumbnail) 
VALUES (
    'Website 1',
    'Business, Service, Product, Template',
    '',
    '2.jpg'
),
(
    'Website 2',
    'Business, Service, Product, Template',
    '',
    '3.jpg'
),
(
    'Website 3',
    'Business, Service, Product, Template',
    '',
    '5.jpg'
),
(
    'Website 4',
    'Business, Service, Product, Template',
    '',
    '6.jpg'
),
(
    'Website 5',
    'Business, Service, Product, Template',
    '',
    '9.jpg'
)
;