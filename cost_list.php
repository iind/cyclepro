<?php

include('lock.php');
$cust_name = $db->query("SELECT email FROM contractor ORDER BY email ASC");

$cusId = 0;
if(count($_POST)>0) {
$cust_id = $db->query("SELECT id FROM contractor where email ='" .$_POST['cusName']. "'");
while($row = $cust_id->fetch_assoc()){
$cusId = $row['id'];
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cost listing</title>
	<link rel='stylesheet' type='text/css' href='http://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css' />
    <link rel='stylesheet' type='text/css' href='http://www.trirand.com/blog/jqgrid/themes/ui.jqgrid.css' />
	
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	
	<script type='text/javascript' src='http://www.trirand.com/blog/jqgrid/js/jquery-ui-custom.min.js'></script>        
    <script type='text/javascript' src='http://www.trirand.com/blog/jqgrid/js/i18n/grid.locale-en.js'></script>
    <script type='text/javascript' src='http://www.trirand.com/blog/jqgrid/js/jquery.jqGrid.js'></script>
	
	<script>
	var cId = <?php echo json_encode($cusId); ?>;
	$(document).ready(function () {
		$("#list_records").jqGrid({
			url: "getCostList.php",
			datatype: "json",
			mtype: "GET",
			colNames: ["Id","Contractor Name", "Item Name", "Cost"],
			colModel: [
				{ name: "costId",align:"right"},
				{ name: "custName"},
				{ name: "itemName"},
				{ name: "cost"}
			],
			cmTemplate: {editable: true},
			pager: "#perpage",
			rowNum: 25,
			rowList: [100,200,300,400,500],
			sortname: "costId",
			sortorder: "asc",
			height: 'auto',
			viewrecords: true,
			gridview: true,
			caption: "",
			postData: {
			    cust: cId
			}
		}); 	
	});

	</script>
</head>

<body>
<div align="center">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<table id="custName"><tr>
<tr><td style="padding-right:20px">
	<a href="welcome.php">Home</a>
</td>
<td>
<label>Customer Name</label></td>
<td><?php 

echo "<select id='custId' name='cusName' onmousedown='if(this.options.length>8){this.size=8;}'  onchange='this.size=0;this.form.submit();' onblur='this.size=0;'>";
while($row = $cust_name->fetch_assoc()){
    echo '<option value="'.$row['email'].'">'.$row['email'].'</option>';
}
echo "</select>";
?></td></tr></table>
<table id="list_records"><tr><td></td></tr></table> 
<div id="perpage"></div>
</form>

</div>
</body>
</html>
