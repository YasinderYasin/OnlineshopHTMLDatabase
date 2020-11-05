<?php /** SQL:

https://www.php-einfach.de/experte/php-codebeispiele/loginscript/
        CREATE TABLE `users` ( 
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(255) NOT NULL ,
  `passwort` VARCHAR(255) NOT NULL ,
  `vorname` VARCHAR(255) NOT NULL DEFAULT '' ,
  `nachname` VARCHAR(255) NOT NULL DEFAULT '' ,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`), UNIQUE (`email`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
         */
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', 'password');
 
if(isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();
        
    //Überprüfung des Passworts - verification of the password
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }
    
}
?>
<!DOCTYPE html> 
<html> 
<head>
  <title>Login</title>    
</head> 
<body>
 
<?php 
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>
 
<form action="?login=1" method="post">
E-Mail:<br>
<input type="email" size="40" maxlength="250" name="email"><br><br>
 
Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="passwort"><br>
 
<input type="submit" value="Abschicken">
</form> 
<!DOCTYPE html> 

<html>

		<head> 
			<meta charset = "UTF-8" /> 
			<title> Webshop K&K Home </title> 
			<link rel = "stylesheet" href = "webshop_login_style2.css" type = "text/css" />
		</head>
		
			
				<center> <div class="topnav">
					<a href = "webshop_home2.html">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href = "webshop2.html">Shop</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href = "webshop_kontakt2.html">Kontakt</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a class = "active" href="webshop_login2.html">Login</a>&nbsp;
					<input type="text" placeholder="Suche..." >
				</div> </center>
			
		<body>
			 <div class="login-wrap">
			  <div class="login-html">
				<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Einloggen</label>
				<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Registrieren</label>
				<div class="login-form">
				  <form class="sign-in-htm" action="login.php" method="GET">
					<div class="group">
					  <center><label for="user" class="label">Benutzername</label></center>
					  <input id="username" name="username" type="text" class="input">
					</div>
					<div class="group">
					  <center><label for="pass" class="label">Passwort</label></center>
					  <input id="password" name="password" type="password" class="input" data-type="password">
					</div>
					<div class="group">
					  <input id="check" type="checkbox" class="check" checked>
					  <label for="check"><span class="icon"></span>&nbsp;&nbsp;Eingeloggt bleiben</label>
					</div>
					<div class="group">
					  <input type="submit" class="button" value="Sign In">
					</div>
					<div class="hr"></div>
					<div class="foot-lnk">
					  <a href="#forgot">Passwort vergessen?</a>
					</div>
				  </form>
				  <form class="sign-up-htm" action="login.php" method="POST">
					<div class="group">
					  <center><label for="user" class="label">Benutzername</label></center>
					  <input id="username" name="username" type="text" class="input">
					</div>
					<div class="group">
					  <center><label for="pass" class="label">Passwort</label></center>
					  <input id="password" name="password" type="password" class="input" data-type="password">
					</div>
					<div class="group">
					  <center><label for="pass" class="label">Passwort bestätigen</label></center>
					  <input id="pass" type="password" class="input" data-type="password">
					</div>
					<div class="group">
					  <input type="submit" class="button" value="Sign Up">
					</div>
					<div class="hr"></div>
					<div class="foot-lnk">
					  <label for="tab-1">Bereits regestriert?</a>
					</div>
				  </form>
				</div>
			  </div>
			</div>
  
		</body>

</html>
