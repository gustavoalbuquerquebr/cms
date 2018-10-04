<?php

$lorem = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, laudantium quae provident voluptas aliquam consequuntur distinctio quibusdam. Quasi ad repellendus veniam consequuntur velit inventore error dolorum, rem ipsum laboriosam est delectus officia, recusandae porro vero soluta dolorem? Quis, quo sequi laudantium numquam et mollitia eaque, pariatur, error porro fugiat non! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium ipsam quas, quidem mollitia laudantium vel sed omnis expedita quia eos quis sequi repellendus distinctio minima numquam harum vitae quae ipsa placeat quam consectetur doloremque. Eveniet rem, vitae, reprehenderit in porro asperiores perspiciatis at quod quos sunt quam numquam temporibus ratione?\nLorem ipsum dolor sit amet consectetur adipisicing elit. Neque, laudantium quae provident voluptas aliquam consequuntur distinctio quibusdam. Quasi ad repellendus veniam consequuntur velit inventore error dolorum, rem ipsum laboriosam est delectus officia, recusandae porro vero soluta dolorem? Quis, quo sequi laudantium numquam et mollitia eaque, pariatur, error porro fugiat non! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium ipsam quas, quidem mollitia laudantium vel sed omnis expedita quia eos quis sequi repellendus distinctio minima numquam harum vitae quae ipsa placeat quam consectetur doloremque. Eveniet rem, vitae, reprehenderit in porro asperiores perspiciatis at quod quos sunt quam numquam temporibus ratione?\nLorem ipsum dolor sit amet consectetur adipisicing elit. Neque, laudantium quae provident voluptas aliquam consequuntur distinctio quibusdam. Quasi ad repellendus veniam consequuntur velit inventore error dolorum, rem ipsum laboriosam est delectus officia, recusandae porro vero soluta dolorem? Quis, quo sequi laudantium numquam et mollitia eaque, pariatur, error porro fugiat non! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium ipsam quas, quidem mollitia laudantium vel sed omnis expedita quia eos quis sequi repellendus distinctio minima numquam harum vitae quae ipsa placeat quam consectetur doloremque. Eveniet rem, vitae, reprehenderit in porro asperiores perspiciatis at quod quos sunt quam numquam temporibus ratione?\n";

$lorem2 = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, laudantium quae provident voluptas aliquam consequuntur distinctio quibusdam. Quasi ad repellendus veniam consequuntur velit inventore error dolorum, rem ipsum laboriosam est delectus officia, recusandae porro vero soluta dolorem?";

$db_connection = mysqli_connect("localhost", "gustavo", "123", "cms");

// // // POSTS
// $posts = "CREATE TABLE posts(
//   id INT PRIMARY KEY AUTO_INCREMENT,
//   `date` TIMESTAMP DEFAULT NOW(),
//   user INT NOT NULL,
//   category INT,
//   title VARCHAR(100) NOT NULL,
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
//   user VARCHAR(25) NOT NULL,
//   post INT NOT NULL,
//   body TEXT NOT NULL,
//   moderated BOOLEAN DEFAULT 0
//   FOREIGN KEY(post) REFERENCES posts(id) ON DELETE CASCADE
// )";

// // CATEGORIES
// $categories = "CREATE TABLE categories(
//   id INT PRIMARY KEY AUTO_INCREMENT,
//   name VARCHAR(25) NOT NULL DEFAULT 1
// )";

// // POSTS FOREIGN KEY
// $posts2 = "ALTER TABLE posts
// ADD FOREIGN KEY (category)
// REFERENCES categories(id)";
// $posts3 = "ALTER TABLE posts
// ADD FOREIGN KEY (user)
// REFERENCES users(id)";

// // CONTACT TABLE
// $contact = "CREATE TABLE contact(
//   id INT PRIMARY KEY AUTO_INCREMENT,
//    date TIMESTAMP DEFAULT NOW(),
//   `name` VARCHAR(50),
//   `email` VARCHAR(50),
//   `message` VARCHAR(255)
// )";


// PAGE PAGE
// $page = "CREATE TABLE pages(
//   id INT PRIMARY KEY AUTO_INCREMENT,
//   `date` TIMESTAMP DEFAULT NOW(),
//   aside BOOLEAN NOT NULL DEFAULT 1,
//   nav BOOLEAN NOT NULL DEFAULT 1,
//   user INT NOT NULL,
//   title VARCHAR(100) NOT NULL,
//   body TEXT NOT NULL
// )";

// mysqli_query($db_connection, $posts);
// mysqli_query($db_connection, $users);
// mysqli_query($db_connection, $comments);
// mysqli_query($db_connection, $categories);
// mysqli_query($db_connection, $posts2);
// mysqli_query($db_connection, $posts3);
// mysqli_query($db_connection, $contact);
// mysqli_query($db_connection, $page);

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
// uncategorized with id of 1 is set as default at categories table
// $subjects = ["uncategorized", one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten"];
// foreach ($subjects as $key => $sub) {
//   $id = $key + 1;
//   $query = "INSERT INTO categories (id, name) VALUES (\"$id\", \"$sub\")";
//   mysqli_query($db_connection, $query);
// }

// POSTS
// for ($i = 1; $i < 30; $i++) {
//   $user = mt_rand(1, 10);
//   $category = mt_rand(1, 5);
//   $query = "INSERT INTO posts (id, user, category, title, body) 
//   VALUES ($i, \"$user\", \"$category\", \"This is title $i\", \"$lorem\")";
//   mysqli_query($db_connection, $query);
// }

// COMMENTS
// for ($i = 1; $i < 50; $i++) {
//   $post = mt_rand(1, 29);
//   $query = "INSERT INTO comments (id, user, post, body) VALUES ($i, \"user\", \"$post\", \"$lorem2\")";
//   mysqli_query($db_connection, $query);
// }

// $page1 = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, laudantium quae provident voluptas aliquam consequuntur distinctio quibusdam. Quasi ad repellendus veniam consequuntur velit inventore error dolorum, rem ipsum laboriosam est delectus officia, recusandae porro vero soluta dolorem? Quis, quo sequi laudantium numquam et mollitia eaque, pariatur, error porro fugiat non! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium ipsam quas, quidem mollitia laudantium vel sed omnis expedita quia eos quis sequi repellendus distinctio minima numquam harum vitae quae ipsa placeat quam consectetur doloremque. Eveniet rem, vitae, reprehenderit in porro asperiores perspiciatis at quod quos sunt quam numquam temporibus ratione?";


  // $query = "INSERT INTO pages (user, title, body) VALUES (1, 'Contact Page', '\"$page1\"')";
  // mysqli_query($db_connection, $query);


mysqli_close($db_connection);