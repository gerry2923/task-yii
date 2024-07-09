<?php
  $servername = "localhost";
  $username = "root";
  $password = "admin123";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=taskforce_db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully" . PHP_EOL ;
    echo PHP_EOL;
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }



// return [
//     'class' => 'yii\db\Connection',
//     'dsn' => 'mysql:host=localhost;dbname=taskforce',
//     'username' => 'root',
//     'password' => 'admin123',
//     'charset' => 'utf8',

//     // Schema cache options (for production environment)
//     //'enableSchemaCache' => true,
//     //'schemaCacheDuration' => 60,
//     //'schemaCache' => 'cache',
// ];
