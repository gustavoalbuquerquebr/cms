<?php

$lorem = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, laudantium quae provident voluptas aliquam consequuntur distinctio quibusdam. Quasi ad repellendus veniam consequuntur velit inventore error dolorum, rem ipsum laboriosam est delectus officia, recusandae porro vero soluta dolorem? Quis, quo sequi laudantium numquam et mollitia eaque, pariatur, error porro fugiat non! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium ipsam quas, quidem mollitia laudantium vel sed omnis expedita quia eos quis sequi repellendus distinctio minima numquam harum vitae quae ipsa placeat quam consectetur doloremque. Eveniet rem, vitae, reprehenderit in porro asperiores perspiciatis at quod quos sunt quam numquam temporibus ratione?";

// connect to database
$db_connection = mysqli_connect("localhost", "gustavo", "123", "test");
if(mysqli_connect_errno()) echo "Fail:" . mysqli_connect_errno();

// // POSTS
// $q = "CREATE TABLE posts(
//   id INT PRIMARY KEY AUTO_INCREMENT,
//   `date` TIMESTAMP DEFAULT NOW(),
//   title VARCHAR(50) NOT NULL,
//   post TEXT NOT NULL
// )";
// $req = mysqli_query($db_connection, $q);
// // create 10 posts
// for($i = 0; $i < 20; $i++) {
//   $title = "This is a title " . $i;
//   $q = "INSERT INTO posts (title, post) VALUES (\"$title\", \"$lorem\")";
//   echo mysqli_query($db_connection, $q);
// }

// // CONTACT TABLE
// $query = "CREATE TABLE contact(
//   id INT PRIMARY KEY AUTO_INCREMENT,
//   `name` VARCHAR(50),
//   `email` VARCHAR(50),
//   `message` VARCHAR(255)
// )";
// $result = mysqli_query($db_connection, $query);

// COMMENTS TABLE
// $query = "CREATE TABLE comments(
//   id INT PRIMARY KEY AUTO_INCREMENT,
//   post INT NOT NULL,
//   `date` TIMESTAMP DEFAULT NOW(),
//   user VARCHAR(25) NOT NULL,
//   comment VARCHAR(255) NOT NULL,
//   FOREIGN KEY(post) REFERENCES posts(id) ON DELETE CASCADE
// )";
// $result = mysqli_query($db_connection, $query);

// USER TABLE
// $query = "CREATE TABLE users(
//   id INT PRIMARY KEY AUTO_INCREMENT,
//   username VARCHAR(20) NOT NULL,
//   password VARCHAR(255) NOT NULL
// )";
// $result = mysqli_query($db_connection, $query);

// $pw = password_hash("ls804028", PASSWORD_DEFAULT);
// $query = "INSERT INTO users (username, `password`) VALUES ('gustavo', \"$pw\")";
// $result = mysqli_query($db_connection, $query);


// close connection
mysqli_close($db_connection);

?>