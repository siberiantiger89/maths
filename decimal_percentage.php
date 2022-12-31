<?php
	if(isset($_GET)){
		if(isset($_GET['decimal'])){

			//get user input
			$decimal=$_GET['decimal'];

			//filter user input
			$decimal=filter_var($decimal,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

			//substr user input
			$decimal=substr($decimal,0,200);

			//validate user input
			if(is_numeric($decimal)){
				$answer=($decimal * 100).'%';
			} else {
				$answer='Invalid input. Please try again.';
			}
		} else {
			$decimal='';
			$answer='';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Decimal/Percentage Converting</title>
</head>
<body>
<h1>Mathematical Functions in PHP</h1>
<h2>Decimal/Percentage Converting</h2>
<form action="decimal_percentage.php" method="get">
	<input type="text" name="decimal" value="<?php echo $decimal; ?>" /> = <?php echo $answer; ?><br/><br/>
	<input type="submit" value="Convert Decimal" /><br/><br/>
</form>
<a href="index.html" />Index Page</a>
</body>
</html>