<?php
	if(isset($_GET)){
		if(isset($_GET['number'])){

			//get user input
			$number=$_GET['number'];
			$number=round($_GET['number'],2);
			$unit_array=array();

			//filter user input
			$number=filter_var($number,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

			//substr user input
			$number=substr($number,0,200);

			//validate user input
			if(is_numeric($number)){

				//get selected units
				if(isset($_GET['unit9'])){
					$unit_array[]='5';
				}
				if(isset($_GET['unit8'])){
					$unit_array[]='2';
				}
				if(isset($_GET['unit7'])){
					$unit_array[]='1';
				}
				if(isset($_GET['unit6'])){
					$unit_array[]='0.50';
				}
				if(isset($_GET['unit5'])){
					$unit_array[]='0.20';
				}
				if(isset($_GET['unit4'])){
					$unit_array[]='0.10';
				}
				if(isset($_GET['unit3'])){
					$unit_array[]='0.05';
				}
				if(isset($_GET['unit2'])){
					$unit_array[]='0.02';
				}
				if(isset($_GET['unit1'])){
					$unit_array[]='0.01';
				}
				if(count($unit_array)!==0){
					$answer='<strong>Units required: </strong>';
					$remainder=$number;
					for($i=0;$i<count($unit_array);++$i){
						$divided_number=$remainder/$unit_array[$i];
						$rounded_number=floor($divided_number);
						$remainder=($divided_number-$rounded_number)*$unit_array[$i];
						$particle='';
						if(count($unit_array)===1){
							$particle='<br/><br/>';
						} else if (count($unit_array)===2){
							if($i<(count($unit_array)-1)){
								$particle=' and ';
							} else {
								$particle='<br/><br/>';
							}
						} else {
							if($i<(count($unit_array)-2)){
								$particle=', ';
							} else if ($i<(count($unit_array)-1)){
								$particle=', and ';
							} else {
								$particle='<br/><br/>';
							}
						}
						if($rounded_number==1){
							$sp='unit';
						} else {
							$sp='units';
						}
						if($unit_array[$i]<1){
							$unit_array[$i]=($unit_array[$i]*100).'p';
						} else {
							$unit_array[$i]='£'.$unit_array[$i];
						}
						$answer.=''.$rounded_number.' '.$sp.' of '.$unit_array[$i].$particle;
					}
					if($remainder<1){
						$remainder=($remainder*100).'p';
					} else {
						$remainder='£'.$remainder;
					}
					$answer.='<strong>Remainder: </strong>'.$remainder.'<br/><br/>';
				} else {
					$answer='Invalid input. Please try again.<br/><br/>';
				}
			} else {
				$answer='Invalid input. Please try again.<br/><br/>';
			}
		} else {
			$number='';
			$answer='';
		}
	}
	if(isset($_GET['unit1'])){
		$unit1_checked=' checked';
	} else {
		$unit1_checked='';
	}
	if(isset($_GET['unit2'])){
		$unit2_checked=' checked';
	} else {
		$unit2_checked='';
	}
	if(isset($_GET['unit3'])){
		$unit3_checked=' checked';
	} else {
		$unit3_checked='';
	}
	if(isset($_GET['unit4'])){
		$unit4_checked=' checked';
	} else {
		$unit4_checked='';
	}
	if(isset($_GET['unit5'])){
		$unit5_checked=' checked';
	} else {
		$unit5_checked='';
	}
	if(isset($_GET['unit6'])){
		$unit6_checked=' checked';
	} else {
		$unit6_checked='';
	}
	if(isset($_GET['unit7'])){
		$unit7_checked=' checked';
	} else {
		$unit7_checked='';
	}
	if(isset($_GET['unit8'])){
		$unit8_checked=' checked';
	} else {
		$unit8_checked='';
	}
	if(isset($_GET['unit9'])){
		$unit9_checked=' checked';
	} else {
		$unit9_checked='';
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Simple Money Calculating in PHP</title>
</head>
<body>
<h1>Mathematical Functions in PHP</h1>
<h2>Simple Money Calculating in PHP</h2>
<form action="money.php" method="get">
	Money:  £<input type="text" name="number" value="<?php echo $number; ?>" /><br/><br/>
	Unit(s): <input type="checkbox" name="unit1" value="0.01"<?php echo $unit1_checked; ?>> 1p
	         <input type="checkbox" name="unit2" value="0.02"<?php echo $unit2_checked; ?>> 2p
	         <input type="checkbox" name="unit3" value="0.05"<?php echo $unit3_checked; ?>> 5p
	         <input type="checkbox" name="unit4" value="0.10"<?php echo $unit4_checked; ?>> 10p
	         <input type="checkbox" name="unit5" value="0.20"<?php echo $unit5_checked; ?>> 20p
	         <input type="checkbox" name="unit6" value="0.50"<?php echo $unit6_checked; ?>> 50p
	         <input type="checkbox" name="unit7" value="1.00"<?php echo $unit7_checked; ?>> £1
	         <input type="checkbox" name="unit8" value="2.00"<?php echo $unit8_checked; ?>> £2
	         <input type="checkbox" name="unit9" value="5.00"<?php echo $unit9_checked; ?>> £5<br/><br/>
	<?php echo $answer; ?>
	<input type="submit" value="Calculate Units" /><br/><br/>
</form>
<a href="index.html" />Index Page</a>
</body>
</html>