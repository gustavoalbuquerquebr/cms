<?php

function create_tables_db() {
  
  // $db_connection = new_db_connection();
  $db_connection = mysqli_connect($_POST["dbhost"], $_POST["dbuser"], $_POST["dbpass"], $_POST["dbname"]);

  // POSTS
  $posts = "CREATE TABLE posts(
    id INT PRIMARY KEY AUTO_INCREMENT,
    `date` TIMESTAMP DEFAULT NOW(),
    user INT NOT NULL,
    category INT,
    title VARCHAR(100) NOT NULL,
    body TEXT NOT NULL
  )";
    
  // USERS
  $users = "CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(25) NOT NULL,
    password VARCHAR(255) NOT NULL
  )";

  // COMMENTS
  $comments = "CREATE TABLE comments(
    id INT PRIMARY KEY AUTO_INCREMENT,
    `date` TIMESTAMP DEFAULT NOW(),
    user VARCHAR(25) NOT NULL,
    post INT NOT NULL,
    body TEXT NOT NULL,
    moderated BOOLEAN DEFAULT 0,
    FOREIGN KEY(post) REFERENCES posts(id) ON DELETE CASCADE
  )";

  // CATEGORIES
  $categories = "CREATE TABLE categories(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(25) NOT NULL DEFAULT 1
  )";

  // POSTS FOREIGN KEY
  $posts2 = "ALTER TABLE posts
  ADD FOREIGN KEY (category)
  REFERENCES categories(id)";
  $posts3 = "ALTER TABLE posts
  ADD FOREIGN KEY (user)
  REFERENCES users(id)";

  // CONTACT
  $contact = "CREATE TABLE contact(
    id INT PRIMARY KEY AUTO_INCREMENT,
    date TIMESTAMP DEFAULT NOW(),
    `name` VARCHAR(50),
    `email` VARCHAR(50),
    `message` VARCHAR(255)
  )";

  // PAGE PAGE
  $page = "CREATE TABLE pages(
    id INT PRIMARY KEY AUTO_INCREMENT,
    `date` TIMESTAMP DEFAULT NOW(),
    aside BOOLEAN NOT NULL DEFAULT 1,
    nav BOOLEAN NOT NULL DEFAULT 1,
    user INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    body TEXT NOT NULL
  )";

  mysqli_query($db_connection, $posts);
  mysqli_query($db_connection, $users);
  mysqli_query($db_connection, $comments);
  mysqli_query($db_connection, $categories);
  mysqli_query($db_connection, $posts2);
  mysqli_query($db_connection, $posts3);
  mysqli_query($db_connection, $contact);
  mysqli_query($db_connection, $page);

  mysqli_close($db_connection);

  return true;
}


function populate_tables_db() {

  $lorem = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, laudantium quae provident voluptas aliquam consequuntur distinctio quibusdam. Quasi ad repellendus veniam consequuntur velit inventore error dolorum, rem ipsum laboriosam est delectus officia, recusandae porro vero soluta dolorem? Quis, quo sequi laudantium numquam et mollitia eaque, pariatur, error porro fugiat non! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium ipsam quas, quidem mollitia laudantium vel sed omnis expedita quia eos quis sequi repellendus distinctio minima numquam harum vitae quae ipsa placeat quam consectetur doloremque. Eveniet rem, vitae, reprehenderit in porro asperiores perspiciatis at quod quos sunt quam numquam temporibus ratione?\nLorem ipsum dolor sit amet consectetur adipisicing elit. Neque, laudantium quae provident voluptas aliquam consequuntur distinctio quibusdam. Quasi ad repellendus veniam consequuntur velit inventore error dolorum, rem ipsum laboriosam est delectus officia, recusandae porro vero soluta dolorem? Quis, quo sequi laudantium numquam et mollitia eaque, pariatur, error porro fugiat non! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium ipsam quas, quidem mollitia laudantium vel sed omnis expedita quia eos quis sequi repellendus distinctio minima numquam harum vitae quae ipsa placeat quam consectetur doloremque. Eveniet rem, vitae, reprehenderit in porro asperiores perspiciatis at quod quos sunt quam numquam temporibus ratione?\nLorem ipsum dolor sit amet consectetur adipisicing elit. Neque, laudantium quae provident voluptas aliquam consequuntur distinctio quibusdam. Quasi ad repellendus veniam consequuntur velit inventore error dolorum, rem ipsum laboriosam est delectus officia, recusandae porro vero soluta dolorem? Quis, quo sequi laudantium numquam et mollitia eaque, pariatur, error porro fugiat non! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium ipsam quas, quidem mollitia laudantium vel sed omnis expedita quia eos quis sequi repellendus distinctio minima numquam harum vitae quae ipsa placeat quam consectetur doloremque. Eveniet rem, vitae, reprehenderit in porro asperiores perspiciatis at quod quos sunt quam numquam temporibus ratione?\n";

  $lorem2 = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, laudantium quae provident voluptas aliquam consequuntur distinctio quibusdam. Quasi ad repellendus veniam consequuntur velit inventore error dolorum, rem ipsum laboriosam est delectus officia, recusandae porro vero soluta dolorem?";

  // $db_connection = new_db_connection();
  $db_connection = mysqli_connect($_POST["dbhost"], $_POST["dbuser"], $_POST["dbpass"], $_POST["dbname"]);

  // USERS
  // starts at two, because the user created at installation is the id number 1
  for ($i = 1; $i <= 20; $i++) {
    $pw = password_hash("pass{$i}", PASSWORD_DEFAULT);
    $query = "INSERT INTO users (id, username, `password`) VALUES ($i, \"user{$i}\", \"$pw\")";
    mysqli_query($db_connection, $query);
  }

  // CATEGORIES
  // uncategorized with id of 1 is set as default at categories table
  $subjects = ["uncategorized", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten"];
  foreach ($subjects as $key => $sub) {
    $id = $key + 1;
    $query = "INSERT INTO categories (id, name) VALUES (\"$id\", \"$sub\")";
    mysqli_query($db_connection, $query);
  }

  // POSTS
  for ($i = 1; $i <= 20; $i++) {
    $user = mt_rand(1, 10);
    $category = mt_rand(1, 5);
    $query = "INSERT INTO posts (id, user, category, title, body) 
    VALUES ($i, \"$user\", \"$category\", \"This is title $i\", \"$lorem\")";
    mysqli_query($db_connection, $query);
  }

  // COMMENTS
  for ($i = 1; $i < 50; $i++) {
    $post = mt_rand(1, 20);
    $query = "INSERT INTO comments (id, user, post, body) VALUES ($i, \"user\", \"$post\", \"$lorem2\")";
    mysqli_query($db_connection, $query);
  }

  mysqli_close($db_connection);
}


function fetch_users_db() {

  // $db_connection = new_db_connection();
  $db_connection = mysqli_connect($_POST["dbhost"], $_POST["dbuser"], $_POST["dbpass"], $_POST["dbname"]);

  $query = "SELECT id, username FROM users";

  $result = mysqli_query($db_connection, $query);

  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

  close_db_connection($db_connection, $result);

  return $users;
}


function check_duplicateusername_db($username) {

  $users = fetch_users_db();

  foreach ($users as $user) {
    if ($user["username"] === $username) return true;
  }
  
  return false;
}


function insert_user_db() {
  
  // $db_connection = new_db_connection();
  $db_connection = mysqli_connect($_POST["dbhost"], $_POST["dbuser"], $_POST["dbpass"], $_POST["dbname"]);

  $username = mysqli_real_escape_string($db_connection, $_POST["username"]);
  $password = mysqli_real_escape_string($db_connection, $_POST["password"]);
  $password_hashed = password_hash($password, PASSWORD_DEFAULT);

  
  // cannot insert if username already exists
  if (check_duplicateusername_db($username)) {
    return ["error", "Username already exists"];
  }

  $query = "INSERT INTO users (username, `password`)
            VALUES (\"$username\", \"$password_hashed\")";

  $result = mysqli_query($db_connection, $query);

  close_db_connection($db_connection, $result);

  return ["success"];
}


function empty_database_db() {

  // $db_connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
  $db_connection = mysqli_connect($_POST["dbhost"], $_POST["dbuser"], $_POST["dbpass"], $_POST["dbname"]);

  $query = "DROP DATABASE " . DB_NAME;
  $result = mysqli_query($db_connection, $query);
  $query = "CREATE DATABASE " . DB_NAME;
  $result = mysqli_query($db_connection, $query);

  close_db_connection($db_connection, $result);
}


function edit_constants_initfile() {

  $init_path = make_url("includes/init.php");
  $init_size = filesize($init_path);
  $file = file_get_contents($init_path, $init_size);

  // \h (horizontal white space) is used instead of \s (any white space)
  // otherwise replacement could affect more than one line

  // addcslashes will escape double quotes
  // NOTE: can't escape backslash

  $dbhost = $_POST["dbhost"];
  $dbhost_chars = '[\w.:]';
  $dbhost_pattern = '/\("DB_HOST", "' . $dbhost_chars . '*"\)/';
  $dbhost_replacement = '("DB_HOST", "' . addcslashes($dbhost, '"') . '")';
  $file = preg_replace($dbhost_pattern, $dbhost_replacement, $file);

  $dbuser = $_POST["dbuser"];
  $dbuser_chars = '[\w\h\@#&*+-.\/\\\|]';
  $dbuser_pattern = '/\("DB_USER", "' . $dbuser_chars . '*"\)/';
  $dbuser_replacement = '("DB_USER", "' . addcslashes($dbuser, '"') . '")';
  $file = preg_replace($dbuser_pattern, $dbuser_replacement, $file);

  $dbpass = $_POST["dbpass"];
  $dbpass_chars = '[\w\h\'"!@#$%&*()+-.,;:?\/\\\|]';
  $dbpass_pattern = '/\("DB_PASS", "' . $dbpass_chars . '*"\)/';
  $dbpass_replacement = '("DB_PASS", "' . addcslashes($dbpass, '"') . '")';
  $file = preg_replace($dbpass_pattern, $dbpass_replacement, $file);

  $dbname = $_POST["dbname"];
  $dbname_chars = '[\w\h\"!@#&*+-.\/\\\|]';
  $dbname_pattern = '/\("DB_NAME", "' . $dbname_chars . '*"\)/';
  $dbname_replacement = '("DB_NAME", "' . addcslashes($dbname, '"') . '")';
  $file = preg_replace($dbname_pattern, $dbname_replacement, $file);


  $name = $_POST["name"];
  $name_chars = '[\w\h\'"!@#$%&*()+-.,;:?\/\\\|]';
  $name_pattern = '/\("PROJECT_NAME", "' . $name_chars . '*"\)/';
  $name_replacement = '("PROJECT_NAME", "' . addcslashes($name, '"') . '")';
  $file = preg_replace($name_pattern, $name_replacement, $file);

  // $path = $_POST["path"];
  // $path_chars = '[\w\h-.\/\\\]';
  // $path_pattern = '/\("PROJECT_PATH", "' . $path_chars . '*"\)/';
  // $path_replacement = '("PROJECT_PATH", "' . addcslashes($path, '"') . '")';
  // $file = preg_replace($path_pattern, $path_replacement, $file);


  $email = $_POST["email"];
  $email_chars = '[\w.@]';
  $email_pattern = '/\("PROJECT_EMAIL", "' . $email_chars . '*"\)/';
  $email_replacement = '("PROJECT_EMAIL", "' . addcslashes($email, '"') . '")';
  $file = preg_replace($email_pattern, $email_replacement, $file);

  file_put_contents($init_path, $file);

}


function get_abspath_postrequest() {

  $path = $_POST["path"];

  if (substr($path, 0, 1) === "/" || substr($path, 0, 1) === "\\") {
    $path = substr($path, 1);
  }

  $absolutePath = $_SERVER["DOCUMENT_ROOT"] . "/" . $path;

  return $absolutePath;
}


function validate_variables_postrequest() {

  $errors = [];

  if (empty($_POST["dbhost"])) {
    $errors[] = "Database host can't be left blank";
  }

  if (empty($_POST["dbuser"])) {
    $errors[] = "Database user can't be left blank";
  }

  if (empty($_POST["dbname"])) {
    $errors[] = "Database name can't be left blank";
  }
  
  if (empty($_POST["name"])) {
    $errors[] = "Site name can't be left blank";
  }
  
    if (!empty($_POST["name"]) && !filter_input(INPUT_POST, "name", FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/[\w\h\'\"!@#$%&*()+-.,;:?\/\\\|]*/"]])) {
      $errors[] = "Invalid character(s) at site name field.";
    }
  
  if (!file_exists(get_abspath_postrequest())) {
    $errors[] = "The specified path doesn't exist in your server";
  }
  
  if (!filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email";
  }

  if (empty($_POST["username"])) {
    $errors[] = "Username can't be left blank";
  }
  
  if (empty($_POST["password"])) {
    $errors[] = "Password can't be left blank";
  }

  return empty($errors) ? ["success"] : ["error", $errors];
}


function install_cms_db() {

  try {
    mysqli_connect($_POST["dbhost"], $_POST["dbuser"], $_POST["dbpass"], $_POST["dbname"]);

  } catch (mysqli_sql_exception $e) {
    return ["error", [$e->getMessage()]];
  }

  $validation = validate_variables_postrequest();

  if ($validation[0] === "error") {
    return ["error", $validation[1]];
  }

  create_tables_db();

  isset($_POST["lorem"]) && populate_tables_db();

  $user_insertion = insert_user_db();
  
  if ($user_insertion[0] === "error") {

    empty_database_db();

    return ["error", $user_insertion[1]];
  }
  
  edit_constants_initfile();

  return ["success"];
}
