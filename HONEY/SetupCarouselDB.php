<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "sophia";

  $conn = new mysqli($servername, $username, $password);
  if ($conn->connect_error) {
    die("<div>MySQL連線失敗：" . $conn->connect_error . "</div>");
  }
  else {
    echo "<div>MySQL連線成功</p>";
  }

  $sql = "DROP DATABASE IF EXISTS " . $dbname . ";";
  echo "<div>".$sql."</div>";
  $conn->query($sql);

  $sql = "create database if not exists " . $dbname . ";";
  echo "<div>".$sql."</div>";
  $conn->query($sql);
  $conn->close();

  $conn = new mysqli($servername, $username, $password, $dbname);
  $sql = "CREATE TABLE carousel (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    imgFileName VARCHAR(255) NOT NULL,
    imgDescription VARCHAR(255) NOT NULL
    )";
  if ($conn->query($sql) === TRUE) {
    echo "<p>建立carousel表格成功</p>";
  } else {
    die("<div>建立TABLE失敗：" . $conn->error . "</div>");
  }

  $sql = "INSERT INTO carousel (imgFileName, imgDescription) VALUES ('pic_01.jpg', '位在台中第一中學附近的商圈，滿滿的美食也吸引外地遊客慕名而來。');";
  $sql .= "INSERT INTO carousel (imgFileName, imgDescription) VALUES ('pic_02.jpg', '逢甲夜市鄰近逢甲大學，蘊含著許多人潮排隊美食。');";
  $sql .= "INSERT INTO carousel (imgFileName, imgDescription) VALUES ('pic_03.jpg', '比起逢甲夜市與一中商圈聲勢也是越來越浩大。');";
  if ($conn->multi_query($sql) === TRUE) {
    echo "<p>New records created successfully</p>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }  
?>

<?php include "disconnectDB.php"; ?>