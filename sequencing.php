<?php
	if(isset($_GET)){
		if((isset($_GET['a']))&&(isset($_GET['b']))){

			//get user input
			$a=$_GET['a'];
			$b=$_GET['b'];
	
			//filter user input
			$a=filter_var($a,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
			$b=filter_var($b,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

			//substr user input
			$a=substr($a,0,200);
			$b=substr($b,0,200);

			//validate user input
			if((is_numeric($a))&&(is_numeric($b))){
				$delta=$b-$a;
				$c=$b+$delta;
				$d=$c+$delta;
				$e=$d+$delta;
				$answer='<strong>Full Sequence: </strong>'.$a.', '.$b.', '.$c.', '.$d.', '.$e.'<br/><br/>';
			} else {
				$answer='Invalid input. Please try again.<br/><br/>';
			}
		} else {
			$a='';
			$b='';
			$answer='';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Simple Numbering Sequencing in PHP</title>
</head>
<body>
<h1>Mathematical Functions in PHP</h1>
<h2>Simple Numbering Sequencing in PHP</h2>
<form action="sequencing.php" method="get">
	1st Number: <input type="text" name="a" value="<?php echo $a; ?>" /> 2nd Number: <input type="text" name="b" value="<?php echo $b; ?>" /><br/><br/>
	<?php echo $answer; ?>
	<input type="submit" value="Sequence Numbers" /><br/><br/>
</form>
<a href="index.html" />Index Page</a>
</body>
</html>