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