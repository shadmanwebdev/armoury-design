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