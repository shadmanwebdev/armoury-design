CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fname varchar(255) DEFAULT NULL,
  lname varchar(255) DEFAULT NULL,
  username varchar(255) DEFAULT NULL,
  bio text DEFAULT NULL,
  email varchar(255) NOT NULL,
  pwd varchar(255) NOT NULL,
  photo varchar(255) DEFAULT NULL,
  user_status varchar(255) NOT NULL,
  account_status varchar(255) NOT NULL,
  created_at varchar(255) DEFAULT NULL,
  updated_at varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`fname`, `lname`, `username`, `bio`, `email`, `pwd`, `photo`, `user_status`, `account_status`, `created_at`, `updated_at`) VALUES
('', '', '', '', 'admin@gmail.com', '$2y$12$DKZNVhQyX0mnj74qDW5uxOFcrpGzbCHqeb51Bm4R8bIcIxOHTNVrO', '', 'admin', 'active', '2020-07-09', '2020-07-09');

CREATE TABLE site_settings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sitename varchar(255) DEFAULT NULL,
  title_tag varchar(255) DEFAULT NULL,
  meta_description varchar(255) DEFAULT NULL,
  copyright_text varchar(255) DEFAULT NULL,
  contact varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `site_settings` (
    `id`, 
    `sitename`, 
    `title_tag`, 
    `meta_description`, 
    `copyright_text`,
    `contact`
) VALUES (1, 'Armoury Design', 'Armoury Design', 
'Full Stack Web Development', 'Coypright © Armoury Design', 'contact@armourydesign.com');


CREATE TABLE smtp_email_setup (
  id INT AUTO_INCREMENT PRIMARY KEY,
  smtp_host VARCHAR(255) NOT NULL,
  smtp_encryption VARCHAR(255) NOT NULL,
  smtp_port VARCHAR(255) NOT NULL,
  username VARCHAR(255) NOT NULL,
  pwd VARCHAR(255) NOT NULL
);

INSERT INTO smtp_email_setup (smtp_host, smtp_encryption, smtp_port, username, pwd)
VALUES ('smtp.gmail.com', 'SSL', '465', 'testemail6329@gmail.com', 'ffscmltnjhwnxwnw');

CREATE TABLE pwd_reset (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pwd_reset_email VARCHAR(255) NOT NULL,
    pwd_reset_selector TEXT NOT NULL,
    pwd_reset_token TEXT NOT NULL,
    pwd_reset_expires TEXT NOT NULL
);

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

CREATE TABLE faqs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT DEFAULT NULL,
    answer TEXT DEFAULT NULL
);

INSERT INTO faqs (question, answer) 
VALUES (
    'Lorem ipsum dolor sit amet?',
    'Magnis modipsae que voloratati andigen daepeditem quiate conecus aut labore. Laceaque quiae sitiorem rest non restibusaes maio es dem tumquam explabo.'
),
(
    'Lorem ipsum dolor sit amet?',
    'Magnis modipsae que voloratati andigen daepeditem quiate conecus aut labore. Laceaque quiae sitiorem rest non restibusaes maio es dem tumquam explabo.'
),
(
    'Lorem ipsum dolor sit amet?',
    'Magnis modipsae que voloratati andigen daepeditem quiate conecus aut labore. Laceaque quiae sitiorem rest non restibusaes maio es dem tumquam explabo.'
),
(
    'Lorem ipsum dolor sit amet?',
    'Magnis modipsae que voloratati andigen daepeditem quiate conecus aut labore. Laceaque quiae sitiorem rest non restibusaes maio es dem tumquam explabo.'
),
(
    'Lorem ipsum dolor sit amet?',
    'Magnis modipsae que voloratati andigen daepeditem quiate conecus aut labore. Laceaque quiae sitiorem rest non restibusaes maio es dem tumquam explabo.'
),
(
    'Lorem ipsum dolor sit amet?',
    'Magnis modipsae que voloratati andigen daepeditem quiate conecus aut labore. Laceaque quiae sitiorem rest non restibusaes maio es dem tumquam explabo.'
)
;

CREATE TABLE quotes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(255) DEFAULT NULL,
    lname VARCHAR(255) DEFAULT NULL,
    email VARCHAR(255) DEFAULT NULL,
    phone VARCHAR(255) DEFAULT NULL,
    pitch TEXT DEFAULT NULL,
    key_val TEXT DEFAULT NULL,
    future TEXT DEFAULT NULL,
    competitors TEXT DEFAULT NULL,
    diff TEXT DEFAULT NULL,
    goals TEXT DEFAULT NULL,
    defsuccess TEXT DEFAULT NULL,
    avoidfail TEXT DEFAULT NULL,
    leastfavsites TEXT DEFAULT NULL,
    audience TEXT DEFAULT NULL,
    curaudience TEXT DEFAULT NULL,
    information TEXT DEFAULT NULL,
    website_url TEXT DEFAULT NULL,
    qualities TEXT DEFAULT NULL,
    tochange TEXT DEFAULT NULL,
    deadline_budget TEXT DEFAULT NULL,
    features TEXT DEFAULT NULL,
    created_at DATETIME NOT NULL
);

CREATE TABLE services (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title varchar(255) NOT NULL,
  content text DEFAULT NULL,
  icon varchar(255) DEFAULT NULL
);

INSERT INTO services (title, content, icon)
VALUES 
('Lorem Ipsum', 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident', 'ion-ios-analytics-outline'),
('Lorem Ipsum', 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident', 'ion-ios-bookmarks-outline'),
('Lorem Ipsum', 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident', 'ion-ios-paper-outline'),
('Lorem Ipsum', 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident', 'ion-ios-speedometer-outline'),
('Lorem Ipsum', 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident', 'ion-ios-world-outline'),
('Lorem Ipsum', 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident', 'ion-ios-clock-outline');



CREATE TABLE testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    profession VARCHAR(255) NOT NULL,
    content TEXT DEFAULT NULL,
    photo VARCHAR(255) DEFAULT NULL
);

INSERT INTO testimonials (fullname, profession, content, photo) 
VALUES (
    'Cloe Marena',
    'Owner of Building Co.',
    'Laboriosam nisi natus quos soluta blanditiis iste in distinctio fugiat perferendis, architecto eveniet provident, consequatur dolore ab nihil voluptatibus laborum magnam cum assumenda nobis, nam quam quae! Unde porro laboriosam nam qui! Eligendi, qui!',
    'person_1.jpg'
),
(
    'Nathalie Channie',
    'Owner of Building Co.',
    'Laboriosam nisi natus quos soluta blanditiis iste in distinctio fugiat perferendis, architecto eveniet provident, consequatur dolore ab nihil voluptatibus laborum magnam cum assumenda nobis, nam quam quae! Unde porro laboriosam nam qui! Eligendi, qui!',
    'person_2.jpg'
),
(
    'Will Turner',
    'Owner of Building Co.',
    'Laboriosam nisi natus quos soluta blanditiis iste in distinctio fugiat perferendis, architecto eveniet provident, consequatur dolore ab nihil voluptatibus laborum magnam cum assumenda nobis, nam quam quae! Unde porro laboriosam nam qui! Eligendi, qui!',
    'person_3.jpg'
),
(
    'Nicolas Stainer',
    'Owner of Building Co.',
    'Laboriosam nisi natus quos soluta blanditiis iste in distinctio fugiat perferendis, architecto eveniet provident, consequatur dolore ab nihil voluptatibus laborum magnam cum assumenda nobis, nam quam quae! Unde porro laboriosam nam qui! Eligendi, qui!',
    'person_4.jpg'
)
;

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

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(255) NOT NULL,
    sdate VARCHAR(255) DEFAULT NULL,
    edate VARCHAR(255) DEFAULT NULL,
    project_status VARCHAR(255) DEFAULT NULL,
    assignee VARCHAR(255) DEFAULT NULL
);

INSERT INTO projects(project_name, sdate, edate, project_status, assignee) VALUES 
(
    'Project Apollo',
    '01/01/2020',
    '31/06/2020',
    'Done',
    'Vanessa Tucker'
),
(
    'Project Fireball',
    '01/01/2020',
    '31/06/2020',
    'Cancelled',
    'William Harris'
),
(
    'Project Hades',
    '01/01/2020',
    '31/06/2020',
    'Done',
    'Sharon Lessman'
),
(
    'Project Phoenix',
    '01/01/2020',
    '31/06/2020',
    'In progress',
    'Vanessa Tucker'
),
(
    'Project Romeo',
    '01/01/2020',
    '31/06/2020',
    'Done',
    'Christina Mason'
),
(
    'Project Wombat',
    '01/01/2020',
    '31/06/2020',
    'Done',
    'William Harris'
),
(
    'Project Nitro',
    '01/01/2020',
    '31/06/2020',
    'In progress',
    'Vanessa Tucker'
);

CREATE TABLE contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fname VARCHAR(255) NOT NULL,
  lname VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone VARCHAR(255) NOT NULL,
  msg_subject VARCHAR(255) NOT NULL,
  msg TEXT DEFAULT NULL,
  created_at VARCHAR(255) DEFAULT NULL
);

INSERT INTO `contacts` (`fname`, `lname`, `email`, `phone`, `msg_subject`, `msg`, `created_at`) VALUES
('John', 'Doe', 'johndoe@gmail.com', '435467424', 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '2022-06-19 18:39:00'),
('Jane', 'Doe', 'janedoe@gmail.com', '435467424', 'Lorem ipsum dolor', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.', '2022-06-19 18:41:04');