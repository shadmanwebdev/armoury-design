CREATE TABLE top_section (
  id INT AUTO_INCREMENT PRIMARY KEY,
  background_img VARCHAR(255) DEFAULT NULL,
  logo VARCHAR(255) DEFAULT NULL,
  logo_subtitle VARCHAR(255) DEFAULT NULL,
  title VARCHAR(255) DEFAULT NULL,
  subtitle VARCHAR(255) DEFAULT NULL,
  btn_text VARCHAR(255) DEFAULT NULL
);
INSERT INTO top_section (background_img, logo, logo_subtitle, title, subtitle, btn_text) 
VALUES ('pexels-steven-hylands-1650824.jpg', '', '', 'Armoury Design', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Get a Quote!');