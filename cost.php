<?php

include('lock.php');

$cust_name = $db->query("SELECT email FROM contractor ORDER BY email ASC");
$item_name = $db->query("SELECT name FROM item ORDER BY Name ASC");

if (! $cust_name) return false;
	
     if(count($_POST)>0) {
		$itId = 0;
		$cusId = 0;
		$cust_id = $db->query("SELECT id FROM contractor where email='" . $_POST["custName"] . "'");
		while($row = $cust_id->fetch_assoc()){
			$cusId = $row['id'];
		}

		$item_id = $db->query("SELECT id FROM item where name='" . $_POST["itemName"] . "'");
		while($row = $item_id->fetch_assoc()){
			$itId = $row['id'];
		}

		$current_id = $db->query("INSERT into cost (contractor_id, item_id, unit_cost, create_ts, update_ts, status) values (" .$cusId. "," .$itId. "," . $_POST["price"] . ", now(), now(), 4)"  );
			
		if(!$current_id) {
			# echo "INSERT failed: (" . $db->errno . ") " . $db->error;
			header("location: welcome.php");
			return false;
		}else{
			$message = "New contractor cost added successfully";
		}
	}

?>
<html>
<head>
<title>Add Price</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
 <script>
	function validate(evt) {
	  var theEvent = evt || window.event;
	  var key = theEvent.keyCode || theEvent.which;
	  key = String.fromCharCode( key );
	  var regex = /[0-9]|\./;
	  if( !regex.test(key) ) {
	    theEvent.returnValue = false;
	    if(theEvent.preventDefault) theEvent.preventDefault();
	  }
	}

 </script>

</head>
<body>
<form name="frmUser" method="post" action="">
<div style="width:500px;">
<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
<table border="0" cellpadding="50" cellspacing="10" width="500" align="center" class="tblSaveForm">
<tr class="tableheader">
<td colspan="2"><label>Add Contractor Cost</label></td>
</tr>
<tr class="spaceUnder">
<td><label>Contractor Email</label></td>
<td><?php 

echo "<select name='custName' onmousedown='if(this.options.length>8){this.size=8;}'  onchange='this.size=0;' onblur='this.size=0;'>";
while($row = $cust_name->fetch_assoc()){
print_r($row);
    echo '<option value="'.$row['email'].'">'.$row['email'].'</option>';
}
echo "</select>";
?>
<td>
</tr>
</tr>	
<tr class="spaceUnder">
<td><label>Item name</label></td>
<td><?php 

echo "<select name='itemName' onmousedown='if(this.options.length>8){this.size=8;}'  onchange='this.size=0;' onblur='this.size=0;'>";
while($row = $item_name->fetch_assoc()){
    echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
}
echo "</select>";
?></td>
</tr>
<tr class="spaceUnder">
<td><label>Unit Cost</label></td>
<td><input type="text" name="price" class="txtField" onkeypress='validate(event)'></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Add Cost" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>
</body></html>
