<?php

$lorem = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, laudantium quae provident voluptas aliquam consequuntur distinctio quibusdam. Quasi ad repellendus veniam consequuntur velit inventore error dolorum, rem ipsum laboriosam est delectus officia, recusandae porro vero soluta dolorem? Quis, quo sequi laudantium numquam et mollitia eaque, pariatur, error porro fugiat non! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium ipsam quas, quidem mollitia laudantium vel sed omnis expedita quia eos quis sequi repellendus distinctio minima numquam harum vitae quae ipsa placeat quam consectetur doloremque. Eveniet rem, vitae, reprehenderit in porro asperiores perspiciatis at quod quos sunt quam numquam temporibus ratione?\nLorem ipsum dolor sit amet consectetur adipisicing elit. Neque, laudantium quae provident voluptas aliquam consequuntur distinctio quibusdam. Quasi ad repellendus veniam consequuntur velit inventore error dolorum, rem ipsum laboriosam est delectus officia, recusandae porro vero soluta dolorem? Quis, quo sequi laudantium numquam et mollitia eaque, pariatur, error porro fugiat non! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium ipsam quas, quidem mollitia laudantium vel sed omnis expedita quia eos quis sequi repellendus distinctio minima numquam harum vitae quae ipsa placeat quam consectetur doloremque. Eveniet rem, vitae, reprehenderit in porro asperiores perspiciatis at quod quos sunt quam numquam temporibus ratione?\nLorem ipsum dolor sit amet consectetur adipisicing elit. Neque, laudantium quae provident voluptas aliquam consequuntur distinctio quibusdam. Quasi ad repellendus veniam consequuntur velit inventore error dolorum, rem ipsum laboriosam est delectus officia, recusandae porro vero soluta dolorem? Quis, quo sequi laudantium numquam et mollitia eaque, pariatur, error porro fugiat non! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium ipsam quas, quidem mollitia laudantium vel sed omnis expedita quia eos quis sequi repellendus distinctio minima numquam harum vitae quae ipsa placeat quam consectetur doloremque. Eveniet rem, vitae, reprehenderit in porro asperiores perspiciatis at quod quos sunt quam numquam temporibus ratione?\n";

$lorem2 = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, laudantium quae provident voluptas aliquam consequuntur distinctio quibusdam. Quasi ad repellendus veniam consequuntur velit inventore error dolorum, rem ipsum laboriosam est delectus officia, recusandae porro vero soluta dolorem?";

$db_connection = mysqli_connect("localhost", "gustavo", "123", "cms");

// // // POSTS
// $posts = "CREATE TABLE posts(
//   id INT PRIMARY KEY AUTO_INCREMENT,
//   `date` TIMESTAMP DEFAULT NOW(),
//   author INT NOT NULL,
//   category INT,
//   title VARCHAR(50) NOT NULL,
//   body TEXT NOT NULL
// )";
  
// // USERS
// $users = "CREATE TABLE users(
//   id INT PRIMARY KEY AUTO_INCREMENT,
//   username VARCHAR(25) NOT NULL,
//   password VARCHAR(255) NOT NULL
// )";

// // COMMENTS
// $comments = "CREATE TABLE comments(
//   id INT PRIMARY KEY AUTO_INCREMENT,
//   `date` TIMESTAMP DEFAULT NOW(),
//   author VARCHAR(25) NOT NULL,
//   post INT NOT NULL,
//   body TEXT NOT NULL,
//   moderated BOOLEAN DEFAULT 0
//   FOREIGN KEY(post) REFERENCES posts(id) ON DELETE CASCADE
// )";

// // CATEGORIES
// $categories = "CREATE TABLE categories(
//   id INT PRIMARY KEY AUTO_INCREMENT,
//   name VARCHAR(25) NOT NULL
// )";

// // POSTS FOREIGN KEY
// $posts2 = "ALTER TABLE posts
// ADD FOREIGN KEY (category)
// REFERENCES categories(id)";
// $posts3 = "ALTER TABLE posts
// ADD FOREIGN KEY (author)
// REFERENCES users(id)";

// // CONTACT TABLE
// $contact = "CREATE TABLE contact(
//   id INT PRIMARY KEY AUTO_INCREMENT,
//   `name` VARCHAR(50),
//   `email` VARCHAR(50),
//   `message` VARCHAR(255)
// )";


// mysqli_query($db_connection, $posts);
// mysqli_query($db_connection, $users);
// mysqli_query($db_connection, $comments);
// mysqli_query($db_connection, $categories);
// mysqli_query($db_connection, $posts2);
// mysqli_query($db_connection, $posts3);
// mysqli_query($db_connection, $contact);

// USERS
// for ($i = 0; $i < 20; $i++) {
//   $pw = password_hash("pass{$i}", PASSWORD_DEFAULT);
//   $query = "INSERT INTO users (id, username, `password`) VALUES ($i, \"user{$i}\", \"$pw\")";
//   mysqli_query($db_connection, $query);
// }
// my user
// $pass = password_hash("123", PASSWORD_DEFAULT);
// $query = "INSERT INTO users (username, `password`) VALUES (\"gustavo\", \"$pass\")";
// mysqli_query($db_connection, $query);

// CATEGORIES
// $subjects = ["one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten"];
// foreach ($subjects as $sub) {
//   $query = "INSERT INTO categories (name) VALUES (\"$sub\")";
//   mysqli_query($db_connection, $query);
// }

// POSTS
// for ($i = 1; $i < 30; $i++) {
//   $author = mt_rand(1, 10);
//   $category = mt_rand(1, 5);
//   $query = "INSERT INTO posts (id, author, category, title, body) 
//   VALUES ($i, \"$author\", \"$category\", \"This is title $i\", \"$lorem\")";
//   mysqli_query($db_connection, $query);
// }

// COMMENTS
// for ($i = 1; $i < 50; $i++) {
//   $post = mt_rand(1, 29);
//   $query = "INSERT INTO comments (id, author, post, body) VALUES ($i, \"author\", \"$post\", \"$lorem2\")";
//   mysqli_query($db_connection, $query);
// }

// close connection
mysqli_close($db_connection);
