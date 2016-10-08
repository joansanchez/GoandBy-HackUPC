<?php
session_start();
require("connection.php");
$search = $_GET['s'];
$sql = "SELECT * FROM productos WHERE nom OR etiquetes LIKE '%$search%' AND stock != '0'";
$result = mysql_query($sql);

?>

<!DOCTYPE html>
<html>
<head>
	<title>G&B! Results</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="all">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">



	<!-- Latest compiled and minified JavaScript -->
	<meta charset="UTF-8">
</head>
<body>
  <?php

    while($row = mysql_fetch_assoc($result)) {
          $id_tienda=$row['tienda_id'];
$sql = "SELECT * FROM tiendas WHERE id = '$id_tienda'";
$result2 = mysql_query($sql);
$resultado = mysql_fetch_array($result2);
$direccion = "https://maps.google.es/maps/dir//" . $resultado['direccion_calle']. "," . $resultado['direccion_ciudad'];
$direccion = str_replace(' ', '%20', $direccion);
      ?>
<a href=<?php echo $direccion; ?> style="text-decoration:none"> 
  
<div class="center">
<div class="panel panel-default">

  <div class="panel-body">
  <div class="row">
    <div class="col-md-9"><span class="nproducte"><?php echo $row['nom'];?></span></div>
    <div class="col-md-3"><span class="pproducte"><?php echo $row['preu'];?>€</span></div>
  </div>
    <span><?php echo $row['descripcio'];?></span></br>
    <span class="aproducte">
<?php
echo $resultado['direccion_ciudad'];
?>
    </span></br>
    
  </div>
 
</div>
</div>
 <?php
    }
    ?>
</a>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>