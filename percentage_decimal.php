<?php
	if(isset($_GET)){
		if(isset($_GET['percentage'])){

			//get user input
			$percentage=$_GET['percentage'];

			//filter user input
			$percentage=filter_var($percentage,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

			//substr user input
			$percentage=substr($percentage,0,200);

			//validate user input
			if(is_numeric($percentage)){
				$answer=($percentage / 100);
			} else {
				$answer='Invalid input. Please try again.';
			}
		} else {
			$percentage='';
			$answer='';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Percentage/Decimal Converting</title>
</head>
<body>
<h1>Mathematical Functions in PHP</h1>
<h2>Percentage/Decimal Converting</h2>
<form action="percentage_decimal.php" method="get">
	<input type="text" name="percentage" value="<?php echo $percentage; ?>" />% = <?php echo $answer; ?><br/><br/>
	<input type="submit" value="Convert Percentage" /><br/><br/>
</form>
<a href="index.html" />Index Page</a>
</body>
</html>