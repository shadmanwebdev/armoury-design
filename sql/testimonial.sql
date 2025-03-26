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