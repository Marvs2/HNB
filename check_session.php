<?php
if (isset($_SESSION["password"]) !== true){
	header("location: login_form.php");
 }

 ?>