<?php
	if(isset($_POST['submit'])){

		//get user input
		$unordered_numbers=$_POST['unordered_numbers'];

		//filter user input
		$unordered_numbers=filter_var($unordered_numbers,FILTER_SANITIZE_STRING);

		//substr user input
		$unordered_numbers=substr($unordered_numbers,0,200);

		//validate user input
		if(!preg_match('/[^0-9., \n\r]/i',$unordered_numbers)){
			$numbers_array=preg_split("/[\s,]+/",$unordered_numbers);
			$numbers_array_count=count($numbers_array);
			if(($_POST['order'])==='asc'){
				sort($numbers_array);
			} else if (($_POST['order'])==='dsc'){
				rsort($numbers_array);
			}
			$ordered_numbers='';
			for($i=0;$i<$numbers_array_count;++$i){
				$ordered_numbers.=$numbers_array[$i];
				if($i!==($numbers_array_count-1)){
					$ordered_numbers.="\n";
				}
			}
		} else {
			$ordered_numbers='Invalid input. Please try again.';
		}
		if(($_POST['order'])==='asc'){
			$asc_checked='checked';
			$dsc_checked='';
		} else if (($_POST['order'])==='dsc'){
			$asc_checked='';
			$dsc_checked='checked';
		}
	} else {
		$unordered_numbers='';
		$ordered_numbers='';
		$asc_checked='checked';
		$dsc_checked='';
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Simple Numbering Ordering in PHP</title>
<style type="text/css">
#container {
	width:437px;
}
.row {
	margin-bottom:20px;
	float:left;
	width:437px;
}
.header {
	float:left;
	font-weight:bold;
	width:170px;
}
.column {
	float:left;
	width:170px;
}
</style>
<script type="text/javascript">
	function orderedListReadOnly(){
		document.getElementById("ordered_numbers").readOnly=true;
	}
</script>
</head>
<body onload="orderedListReadOnly()">
<h1>Mathematical Functions in PHP</h1>
<h2>Simple Numbering Ordering in PHP</h2>
<div id="container">
	<form action="ordering.php" method="post">
	<div class="row">
		<div class="header">Input:</div>
		<div class="header">Output:</div>
	</div>
	<div class="row">
		<div class="column">
			<textarea name="unordered_numbers" id="unordered_numbers" cols="17" rows="12" maxlength="200"><?php echo $unordered_numbers; ?></textarea>
		</div>
		<div class="column">
			<textarea name="ordered_numbers" id="ordered_numbers" cols="17" rows="12" maxlength="200"><?php echo $ordered_numbers; ?></textarea>
		</div>
	</div>
	<div class="row">
		<div class="column">
			Ascending Order: <input type="radio" name="order" id="order" value="asc" <?php echo $asc_checked; ?>/>
		</div>
		<div class="column">
			Descending Order: <input type="radio" name="order" id="order" value="dsc" <?php echo $dsc_checked; ?>/>
		</div>
	</div>
	<div class="row">
		<strong>Note:</strong> Numbers can be separated by commas, spaces, and new lines.
	</div>
	<div class="row">
		<div class="header">
			<input type="submit" name="submit" id="submit" value="Order Numbers" />
		</div>
	</div>
	</form>
	<div class="row">
		<a href="index.html" />Index Page</a>
	</div>
</div>
</body>
</html>