<?php
session_start();
if($_SESSION['logged'] !== "1"){
	header("Location: login.php");
}
require("connection.php");
if($_GET['post']=="submit"){
  $nom = $_POST['pname'];
  $tienda_id = $_SESSION['id'];
  $nom = $_POST['pname'];
  $descripcio = $_POST['descr'];
  $etiquetes = $_POST['tags'];
  $stock = $_POST['stock'];
  $preu = $_POST['price'];
  $sql = "INSERT INTO productos (nom, descripcio, etiquetes, stock, tienda_id, preu) values ('$nom', '$descripcio', '$etiquetes', '$stock', '$tienda_id', '$preu')";
  mysql_query($sql) or die( "Error en query: $sql, el error  es: " . mysql_error() );
  header("Location: desktop.php");
}
  ?>

<<!DOCTYPE html>
<html>
<head>
	<title>G&B! New product</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="all">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">



	<!-- Latest compiled and minified JavaScript -->
	<meta charset="UTF-8">
</head>
<body>
	<form name="form1" id="form1" class="register-form" method="post" action="product.php?post=submit">
      <input type="text" id="pname" name="pname" placeholder="Name of the product"/>
      <input type="text" id="descr" name="descr" placeholder="Description of the product (100 char)"/>
      <input type="text" id="tags" name="tags" placeholder="Tags (splitted by comma)"/>
      <input type="number" id="stock" name="stock" placeholder="Initial stock"/>
      <input type="number" id="price" name="price" placeholder="Price"/>
        
      <button>Submit product</button>
    </form>
</body>
</html>