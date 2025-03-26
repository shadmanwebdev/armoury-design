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