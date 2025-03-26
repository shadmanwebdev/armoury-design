CREATE TABLE about (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  content text DEFAULT NULL,
  btn_text VARCHAR(255) DEFAULT NULL,
  about_img varchar(255) DEFAULT NULL
);

INSERT INTO about (title, content, btn_text, about_img)
VALUES 
(
    'Neque porro quisquam est qui dolorem ipsum quia dolor.', 
    'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident', 
    'Get a Quote',
    'about4.jpg'
);