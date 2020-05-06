<!DOCTYPE html>
<html>
<head></head>
<style>
body {
  background-color: Black;
}

h1 {
  color: white;
  text-align: center;
}

h3 {
  color: white;
  text-align: center;
}

p {
  color: white;
  text-align: center;
  font-family: verdana;
  font-size: 20px;
}
a {
  color: white;
  text-align: center;
  font-family: verdana;
  font-size: 20px;
}
</style>
<title>ICFO DAYS RESULT</title>
</head>
<body>
<center>
<BR/>
<H3>
<?php 
 
if (isset($_POST["days"]))
{
	$now = date_create(date("Y-m-d"));
	$your_date = date_create($_POST["days"]);
	$datediff = date_diff($now,$your_date);
	echo $datediff->format("%R%a days");
}
?>
</H3>
<p><input type="button" onclick="window.location.href='/date'" value="CALCULATE OTHER DATE"/>
<input type="button" onclick="window.location.href='/'" value="HOME"/></p>
</center>
</body>
</html>

