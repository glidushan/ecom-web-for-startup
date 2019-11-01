CREATE TABLE `Admins` (
  `id` INT(10) AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(20),
  `password` VARCHAR(20),
  `firstname` VARCHAR(20),
  `lastname` VARCHAR(20),
  `admin_flag` BOOLEAN
);

CREATE TABLE `Users` (
  `id` INT(10) AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(20),
  `password` VARCHAR(20),
  `firstname` VARCHAR(20),
  `lastname` VARCHAR(20),
  `user_flag` BOOLEAN
);

CREATE TABLE `Owners` (
  `id` INT(10) AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(20),
  `password` VARCHAR(20),
  `firstname` VARCHAR(20),
  `lastname` VARCHAR(20),
  `owner_flag` BOOLEAN,
  `store_name` VARCHAR(20)
);

CREATE TABLE `Stores` (
  `id` INT(10) AUTO_INCREMENT PRIMARY KEY,
  `store_name` VARCHAR(20),
  `owner_id` INT(10)
);

CREATE TABLE `Items` (
  `id` INT(10) AUTO_INCREMENT PRIMARY KEY,
  `store_id` VARCHAR(20),
  `item_name` VARCHAR(50),
  `item_count` INT(4),
  `item_price` INT(4),
  `item_image_location` VARCHAR(500),
  `item_description` VARCHAR(500)
);

INSERT INTO `Admins` (`username`, `password`, `firstname`, `lastname`, `admin_flag`)
VALUES ('lidushan', 'admin1234', 'Lidushan', 'Gunaseelan', TRUE);

INSERT INTO `Users` (`username`, `password`, `firstname`, `lastname`, `user_flag`)
VALUES ('markwal', 'user1234', 'Mark', 'Wahlberg', TRUE);

INSERT INTO `Owners` (`username`, `password`, `firstname`, `lastname`, `owner_flag`, `store_name`)
VALUES ('tomston', 'owner1234', 'Tom', 'Hiddleston', TRUE, 'Fashion Stars');

INSERT INTO `Stores` (`store_name`, `owner_id`)
VALUES ('Fashion Stars', 1);

INSERT INTO `Items` (`store_id`, `item_name`, `item_count`, `item_price`, `item_image_location`,`item_description`)
VALUES ('1', 'Hair Brush', 10, 500, 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/hbz-best-hair-brushes-index-1558997704.jpg', 'Just a Typical Hair Brush');
