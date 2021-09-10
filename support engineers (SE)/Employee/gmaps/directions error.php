<?php

session_start();

?>
<html>

<head>

<link rel="stylesheet" type="text/css" href="css/style 1.css" />

<title>directions error</title>

</head>

<body>


<div style="width:100%;height:80;background-color:black;"></div>

<center>
<img class="logo" src="images/logo.jpg" width="200" height="200">

<h1 class="header">Locations</h1>

</br>
</br>

<h3 style="color:red;">Error</h3>

<p style="color:red;"><?php print($_SESSION['startAddrErr']); ?></p>
<p style="color:red;"><?php print($_SESSION['endAddrErr']); ?></p>

<a href="../../Employee/index.php">
<button type="button" style="margin-top: 50;">Back</button>
</a>

<div style="width:100%;height:80;background-color:black;margin-top:500;margin-bottom:0"></div>

</center>

</body>


</html>