<?php
include('config.php');
@extract($_REQUEST);
if(!empty($_POST['action_type'])){
	$action_type = $conn->real_escape_string($_POST['action_type']);
	switch($action_type){
		case "remove":
		if(!empty($_POST['id'])){
			$id = $conn->real_escape_string($_POST['id']);
			$sql = "DELETE FROM product WHERE id = '$id'";
			if($conn->query($sql)){
				echo "Product Has Been Deleted Successfully !";
			}else{
				echo "Something Went Wrong !";
			}
		}
		break;
		
		case "get_detail":
		if(!empty($_POST['bar_code'])){
			$bar_code = $conn->real_escape_string($_POST['bar_code']);
			$sql = $conn->query("SELECT * FROM product WHERE bar_code = '$bar_code'");
			$numRow = $sql->num_rows;
			if($numRow > 0){
				$row = $sql->fetch_array();
					
		// $query2="SELECT fld_brand_name FROM brand WHERE fld_brand_id='$brand'";
		// $r=mysqli_query($conn,$query2);
		// $row2=mysqli_fetch_array($r);
			
	
				$detail = array('type'=>'Success','bar_code'=>$row['bar_code'],'name'=>$row['name'],'fld_size_id'=>$row['fld_size_id'],'mrp'=>$row['mrp'],'sale_price'=>$row['sale_price'],'av_quantity'=>$row['unit']);
				echo json_encode($detail);
		

				// 	if($row['unit']<10):
				// {
					
				// }
			}else{
				$detail = array('type'=>'Error');
				echo json_encode($detail);
			}
		}
		break;

		
	}
}
?>