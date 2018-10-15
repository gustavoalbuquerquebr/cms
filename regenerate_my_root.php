<?php

  $file = str_replace("\\", "/", __FILE__);
  $root = $_SERVER["DOCUMENT_ROOT"];
  $my_root = str_replace($root, "", $file);
  $my_root = str_replace("regenerate_my_root.php", "", $my_root);

  $htaccess_path = ".htaccess";
  $htaccess_size = filesize($htaccess_path);
  $htaccess = file_get_contents($htaccess_path, $htaccess_size);

  $htaccess_chars = '[\w\h\'"!@#$%&*()+-.,;:?\/\\\|]';
  $htaccess_pattern = '/SetEnv HTTP_MY_ROOT "' . $htaccess_chars . '*"/';
  $htaccess_replacement = 'SetEnv HTTP_MY_ROOT "' . $my_root . '"';
  $htaccess = preg_replace($htaccess_pattern, $htaccess_replacement, $htaccess);

  file_put_contents($htaccess_path, $htaccess);

  header("Location: install.php");