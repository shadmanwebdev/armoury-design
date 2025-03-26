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