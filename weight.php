<?php
	if(isset($_GET)){
		if(isset($_GET['a'])){

			//get user input
			$a=$_GET['a'];

			//filter user input
			$a=filter_var($a,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

			//substr user input
			$a=substr($a,0,200);

			//validate user input
			if(is_numeric($a)){
				$answer='<strong>Weight (kilograms): </strong>'.($a/1000).'<br/><br/>';
			} else {
				$answer='Invalid input. Please try again.<br/><br/>';
			}
		} else {
			$a='';
			$answer='';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Simple Weight Calculating in PHP</title>
</head>
<body>
<h1>Mathematical Functions in PHP</h1>
<h2>Simple Weight Calculating in PHP</h2>
<form action="weight.php" method="get">
	<strong>Weight (grams): </strong><input type="text" name="a" value="<?php echo $a; ?>" /><br/><br/>
	<?php echo $answer; ?>
	<input type="submit" value="Calculate Weight" /><br/><br/>
</form>
<a href="index.html" />Index Page</a>
</body>
</html>