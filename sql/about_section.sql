CREATE TABLE about_section (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  subtitle VARCHAR(255) NOT NULL,
  content text DEFAULT NULL,
  btn_text VARCHAR(255) DEFAULT NULL,
  about_img varchar(255) DEFAULT NULL,
  about_text_1 varchar(255) DEFAULT NULL,
  about_text_2 varchar(255) DEFAULT NULL,
  about_text_3 varchar(255) DEFAULT NULL,
  about_text_4 varchar(255) DEFAULT NULL
);

INSERT INTO about_section (title, subtitle, content, btn_text, about_img, about_text_1, about_text_2, about_text_3, about_text_4)
VALUES (
    'About Us',
    'LEARN TO KNOW',
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate fuga ipsum commodi aliquid aspernatur reiciendis enim cum voluptas id itaque, asperiores modi, voluptatibus sed voluptate nulla et ratione aliquam! Quaerat.',
    'Read More About Us',
    'avel-chuklanov-DUmFLtMeAbQ-unsplash.jpg',
    'Asperiores modi sed',
    'Enim cum voluptas',
    'Commodi aliquid aspernatur',
    'Cupiditate fuga ipsum commodi'
);