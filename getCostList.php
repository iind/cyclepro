<?php 

include("config.php");
include('lock.php');

$page = $_GET['page']; 
$limit = $_GET['rows']; 
$sidx = $_GET['sidx']; 
$sord = $_GET['sord']; 
$cusId = $_GET['cust'];

if(!$sidx) $sidx =1; 

$result = $db->query("SELECT count(p.id) as count FROM customer c, item i, price p where c.id=p.customer_id and i.id=p.item_id and c.id =$cusId"); 
$row = $result->fetch_array(MYSQL_ASSOC); 

$count = $row['count']; 
if( $count > 0 && $limit > 0) { 
    $total_pages = ceil($count/$limit); 
} else { 
    $total_pages = 0; 
} 
if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit;
if($start <0) $start = 0; 


$SQL = "SELECT cst.id as costId, c.email as conName, i.name as itemName, cst.unit_cost as cost FROM contractor c, item i, cost cst where c.id=cst.contractor_id and i.id=cst.item_id and c.id =$cusId ORDER BY $sidx $sord LIMIT $start , $limit"; 
$result = $db->query( $SQL ) or die("Couldn't execute query.".mysql_error()); 

$i=0;
while($row = $result->fetch_array(MYSQL_ASSOC)) {
	$responce->rows[$i]['id']=$row['costId'];
	$responce->rows[$i]['cell']=array($row['costId'],$row['conName'],$row['itemName'],$row['cost']);
	$i++;
}
echo json_encode($responce);
?>
