<?php

session_start();

require_once "config/config.php";

$update = false;
$db = Database::getInstance();

$id = 0;
$name = '';
$price = '';
$description = '';
$features = '';

if(isset($_POST['save'])){
	$productName = $_POST['name'];
	$price = $_POST['price'];
	$description = $_POST['description'];
	$features = $_POST['features'];

	$db->insert('user1', $productName, $price, $description, $features);

	$_SESSION['message'] = "Запись сохранена!";

	$_SESSION['msg_type'] = "success";

	header("location: index.php");
}

if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	$db->delete($id);

	$_SESSION['message'] = "Запись удалена!";
	$_SESSION['msg_type'] = "danger";

	header("location: index.php");
}

if(isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update = true;
	$line = $db->selectById($id);
	//var_dump($line);
	echo "</br></br>";
	$name = $line['name'];
	$price = $line['price'];
	$description = $line['description'];
	$features = $line['features'];
	//var_dump($name);
}

if(isset($_POST['update'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$price = $_POST['price'];
	$description = $_POST['description'];
	$features = $_POST['features'];

	$db->update($id, $name, $price, $description, $features);

	$_SESSION['message'] = "Запись обновлена!";
	$_SESSION['msg_type'] = "warning";

	header("location: index.php");
}

?>