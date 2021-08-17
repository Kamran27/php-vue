<?php
$conn= new mysqli("localhost","root","","theses");
if(!$conn){
    echo "Error! Db Not Found"; 
}

if (isset($_SERVER['HTTP_ORIGIN'])) {
	// Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
	// you want to allow, and if so:
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 1000');
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
			// may also be using PUT, PATCH, HEAD etc
			header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
	}

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
			header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
	}
	exit(0);
}

$res = array('error' => false);
$action='';

if (isset($_GET['action'])) {
	
	$action=$_GET['action'];
}
if($action == 'login'){
    $username = (isset($_POST['username'])) ? $_POST['username'] : '';
    $password = (isset($_POST['password'])) ? $_POST['password'] : '';
    $sql="Select * from admindb where username='$username' AND password='$password'";
    $result=$conn->query($sql);
    $num=mysqli_num_rows($result);
    if($num > 0){
        $res['message']="Login Successfuly";
    }
    else{
        $res['error']=true;
        $res['message']="Your Login Username or Password is invalid";
    }
}

if($action == 'getThesisInfo'){
	$sql="SELECT * FROM `thesesdb`";
	$result=$conn->query($sql);
	$num=mysqli_num_rows($result);
	$thesisData=array();
	if($num >0){
		while($row=$result->fetch_assoc()){
			array_push($thesisData,$row);
		}
		$res['error']=false;
        $res['thesis_Data']=$thesisData;

	}else{
		$res['error']=false;
        $res['message']="No Data Found!";
	}
	
}

if($action == 'addTheses'){
	$titel = (isset($_POST['titel'])) ? $_POST['titel'] : '';
    $publisher = (isset($_POST['publisher'])) ? $_POST['publisher'] : '';
    $year = (isset($_POST['year'])) ? $_POST['year'] : '';
    $proglang = (isset($_POST['proglang'])) ? $_POST['proglang'] : '';
	 
	$sql="INSERT INTO `thesesdb`(`id`, `titel`, `publisher`, `year`, `proglang`) VALUES(NULL,'$titel','$publisher','$year','$proglang')";
	$result=$conn->query($sql);
	if($result===true){
		$res['error']=false;
        $res['message']="Thesis Added Successfully";
	}else{
		$res['error']=true;
        $res['message']="Somthing Went Wrong";
	}

}


if($action == 'updateThesis'){
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $titel = (isset($_POST['titel'])) ? $_POST['titel'] : '';
    $publisher = (isset($_POST['publisher'])) ? $_POST['publisher'] : '';
    $year = (isset($_POST['year'])) ? $_POST['year'] : '';
    $proglang = (isset($_POST['proglang'])) ? $_POST['proglang'] : '';

    $sql = $conn->query("UPDATE thesesdb SET titel='$titel', publisher='$publisher', year='$year', proglang='$proglang' WHERE id='$id'");
   
    if($sql){
        $result['message'] = "updated successfully";
    } else {
        $result['error'] = true;
        $result['message'] = "Failed to update";
    }
}

if($action == 'deleteThesis'){
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';

    $sql = $conn->query("DELETE FROM thesesdb WHERE id='$id'");
   
    if($sql){
        $result['message'] = "deleted successfully";
    } else {
        $result['error'] = true;
        $result['message'] = "Failed to delete";
    }
}




$conn -> close();
header("Content-type: application/json");
echo json_encode($res);
die();
 ?>