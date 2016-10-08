<?php
session_start();
require("connection.php");
if($_SESSION['logged']=="1"){
  header("Location: desktop.php");
}
if($_GET['post']=="register"){
  $name = $_POST['sname'];
  $email = $_POST['mail'];
  $password = $_POST['pass'];
  $password2 = $_POST['pass2'];
  $address = $_POST['adress'];
  $city = $_POST['city'];
  $phone  = $_POST['phone'];
  if ($password !== $password2){
    $_SESSION['msg'] = "Password doesn't match. Register again.";
    header("Location: login.php");
    exit;
  }
  if ($password == "" || $address == "" || $name == "" || $email == "" || $city == ""){
    $_SESSION['msg'] = "There are empty boxes.";
    header("Location: login.php");
    exit;
  }
  $md5passwd = md5($password);
  $b_email = mysql_query("SELECT tienda_email FROM tiendas WHERE tienda_email='$email'");
  if($variable=@mysql_fetch_array($b_email)){
     $_SESSION['msg'] = "The email is already in use.";
    header("Location: login.php");
    exit;
  }
  $sql = "INSERT INTO tiendas (nombre_tienda, direccion_calle, direccion_ciudad, tienda_email, tienda_password) values ('$name', '$address', '$city', '$email', '$md5passwd')";
  mysql_query($sql);
  $_SESSION['msg'] = "Register completed!";
  header("Location: login.php");
}else if ($_GET['post']=="login"){
  $email = $_POST['email'];
  $password = $_POST['password'];
	$buscar = mysql_query("SELECT * FROM tiendas WHERE tienda_email='$email'") or die( "Error en query: $sql, el error  es: " . mysql_error() );  
  $resultado = mysql_fetch_array($buscar);
  $password2 = $resultado['tienda_password'];
  if(md5($password)==$password2){
    echo "Bien!";
    $_SESSION['logged'] = "1";
    $_SESSION['id'] = $resultado['id'];
    header("Location: desktop.php");
  }else{
    $_SESSION['msg'] = "Invalid user or password!";
    header("Location: login.php");
  }
  exit;
}else{
?>
<html>
<head>
	<title>G&B! Sellers login</title>
	<link rel="stylesheet" href="login.css" type="text/css" media="all">
	<meta charset="UTF-8">
</head>
<body>
<div class="login-page">
  <div class="form">
    <form class="register-form" id="form2" name="form2" method="post" action="login.php?post=register">
      <input type="text" name="sname" id="sname" placeholder="Your name or your shop name"/>
      <input type="email" name="mail" id="mail" placeholder="Email address"/>
      <input type="password" name="pass" id="pass" placeholder="Password"/>
      <input type="password" name="pass2" id="pass2" placeholder="Confirm password"/>
      <input type="text" name="adress" id="adress" placeholder="Street, Number"/>
      <input type="text" name="city" id="city" placeholder="City"/>
	  <input type="text" name="phone" id="phone" placeholder="Contact phone"/>
      <button>create account</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form  id="form1" name="form1" class="login-form" method="post" action="login.php?post=login">
      <input type="email" name="email" id="email" placeholder="Email"/>
      <input type="password" name="password" id="password" placeholder="Password"/>
      <b class="wrongpass"><?php echo $_SESSION['msg']; $_SESSION['msg']="";?></b>
      <br>
      <button>login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script>
	$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
</script>
</body>
</html>
<?php
}
?>