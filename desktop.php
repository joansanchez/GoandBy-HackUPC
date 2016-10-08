<?php
session_start();
require("connection.php");
$id_tienda = $_SESSION['id'];
$sql = "SELECT * FROM productos WHERE tienda_id = '$id_tienda'";
$result = mysql_query($sql);
$prid2 = $_GET['id'];
if($_GET['cmd']=="increase"){
  $sql2 = "UPDATE productos SET stock = stock + 1 WHERE id = '$prid2'";
  mysql_query($sql2);
  header("Location: desktop.php");
}else if($_GET['cmd']=="decrease"){
  $sql2 = "UPDATE productos SET stock = stock - 1 WHERE id = '$prid2'";
  mysql_query($sql2);
  header("Location: desktop.php");
}if($_GET['cmd']=="exhaust"){
  $sql2 = "UPDATE productos SET stock = 0 WHERE id = '$prid2'";
  mysql_query($sql2);
  header("Location: desktop.php");
}if($_GET['cmd']=="delete"){
  $sql2 = "DELETE FROM productos WHERE id = '$prid2' LIMIT 1";
  mysql_query($sql2);
  header("Location: desktop.php");
}
?>

<<!DOCTYPE html>
<html>
<head>
	<title>G&B! Desktop</title>
	<<link rel="stylesheet" href="style.css" type="text/css" media="all">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">



	<!-- Latest compiled and minified JavaScript -->
	<meta charset="UTF-8">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
  <div class="center"><button class="btn btn-default" onclick="window.location.href='logout.php'" type="button">Log out</button></div>

 <?php
while($row = mysql_fetch_assoc($result)) {
  $id_producto =$row['id'];
  $linkm = "desktop.php?cmd=increase&id=".$id_producto;
  $linkl = "desktop.php?cmd=decrease&id=".$id_producto;
  $link0 = "desktop.php?cmd=exhaust&id=".$id_producto;
  $linkd = "desktop.php?cmd=delete&id=".$id_producto;
 ?>
<div class="center">
<div class="panel panel-default">
  <div class="panel-body">
  <table width="100%">
  	<tr>
  		<td><span class="nproducte"><?php echo $row['nom'];?></span></td>
  		<td class="tright"><span class="pproducte"><?php echo $row['preu'];?> €</span></td>
  		
  	</tr>
  </table>
    <!-- <div class="btn-toolbar" role="toolbar" aria-label="plz work"> -->
    <?php echo $row['stock'];?>
	  		<div class="btn-group" role="group" aria-label="123">
	  			<button class="btn btn-default" onclick="window.location.href='<?php echo $linkm?>'" type="button">+</button>
	  			<button class="btn btn-default" onclick="window.location.href='<?php echo $linkl?>'" type="button">-</button>
  			</div>
  			<button class="btn btn-default" onclick="window.location.href='<?php echo $link0?>'" type="button">Out of stock</button>
        <button class="btn btn-default" onclick="window.location.href='<?php echo $linkd?>'" type="button">X</button>
	<!-- </div> -->
    
  </div>

</div>

</div>
<?php
}
?>
<div class="center"><button class="btn btn-default" onclick="window.location.href='product.php'" type="button">Add product</button></div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
</body>
</html>