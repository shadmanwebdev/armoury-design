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



/*
CREATE TABLE quick_quote (
    id INT AUTO_INCREMENT PRIMARY KEY,
    redesign VARCHAR(255) DEFAULT NULL,
    pages INT(11) DEFAULT NULL,
    logo VARCHAR(255) DEFAULT NULL,
    content VARCHAR(255) DEFAULT NULL,
    created_at DATETIME NOT NULL
);
*/


-- pitch, key_val, future, competitors, diff, goals, defsuccess, avoidfail, 
-- leastfavsites, audience, curaudience, information, website_url, qualities, 
-- tochange, deadline_budget, features, created_at