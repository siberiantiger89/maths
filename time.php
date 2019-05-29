<?php
	if(isset($_GET)){
		if((isset($_GET['a']))&&(isset($_GET['b']))&&(isset($_GET['c']))){

			//get user input
			$a=$_GET['a'];
			$b=$_GET['b'];
			$c=$_GET['c'];
			$d=$_GET['d'];

			//filter user input
			$a=filter_var($a,FILTER_SANITIZE_STRING);
			$b=filter_var($b,FILTER_SANITIZE_STRING);
			$c=filter_var($c,FILTER_SANITIZE_NUMBER_INT);
			$d=filter_var($d,FILTER_SANITIZE_NUMBER_INT);

			//substr user input
			$a=substr($a,0,5);
			$b=substr($b,0,2);
			$c=substr($c,0,200);
			$d=substr($d,0,200);

			//validate user input
			if((preg_match("/^(?:1[012]|0[0-9]):[0-5][0-9]$/",$a))&&(($b==='am')||($b==='pm'))&&(is_numeric($c))&&(is_numeric($d))){
				$time_array=explode(':',$a);
				$time_array[0]=$time_array[0]+$c;
				$time_array[1]=$time_array[1]+$d;
				if($time_array[1]>=60){
					$time_array[0]=$time_array[0]+floor($time_array[1]/60);
					$time_array[1]=$time_array[1]%60;
				}
				if((($time_array[0]/12)%2)===1){
					if($b==='am'){
						$period='pm';
					} else {
						$period='am';
					}
				} else {
					$period=$b;
				}
				$time_array[0]=(($time_array[0])%12);
				if($time_array[0]===0){
					$time_array[0]=12;
				}
				$answer=str_pad(($time_array[0]),2,0,STR_PAD_LEFT).':'.str_pad(($time_array[1]),2,0,STR_PAD_LEFT).' '.$period;
			} else {
				$answer='Invalid input. Please try again.';
			}
		} else {
			$a='';
			$b='';
			$c='';
			$d='';
			$answer='';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Simple Time Calculating in PHP</title>
</head>
<body>
<h1>Mathematical Functions in PHP</h1>
<h2>Simple Time Calculating in PHP</h2>
<form action="time.php" method="get">
	<strong>Time: </strong><input type="text" name="a" value="<?php echo $a; ?>" /> <select name="b"><option value="am" <?php if($b==='am'){echo 'selected';}?>>am</option><option value="pm" <?php if($b==='pm'){echo 'selected';}?>>pm</option></select> + <input type="text" name="c" value="<?php echo $c; ?>" /> hours <input type="text" name="d" value="<?php echo $d; ?>" /> minutes = <?php echo $answer; ?><br/><br/>
	<input type="submit" value="Calculate Time" /><br/><br/>
</form>
<a href="index.html" />Index Page</a>
</body>
</html>