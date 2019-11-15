<!DOCTYPE html>
<html>
<head>
	<title>PHP CRUD</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php require_once 'process.php'; ?> 
<?php

	if(isset($_SESSION['message'])):
?>
<div class="alert alert-<?=$_SESSION['msg_type']?>">
	<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);   
	?>
</div>
<?php endif ?>

<div class="container">
     <div class="row justify-content-center">
        	<table class="table">
        		<thead>
        			<tr>
        				<!-- <td>Номер</td> -->
        				<td>Название</td>
        				<td>Цена,$</td>
        				<td>Описание</td>
        				<td>Характеристики</td>
        			</tr>
        		</thead>

<?php 
    include_once "config/config.php";
    ?>

    <?php
    	$db = Database::getInstance();
    	$product = $db->select();
    	//echo "</br></br>";
    	// var_dump($user);
    	foreach ($product as $value) {
    		?>
    		<tr>
	            <!-- <td><?=$value['id']?></td> -->
	            <td><?=$value['name']?></td>
	            <td><?=$value['price']?></td>
	            <td><?=$value['description']?></td>
	            <td><?=$value['features']?></td>
	            <td>
	            	<div class="btn">
	            	<a href="index.php?edit=<?php echo $value['id']?>"
	            		class="btn btn-info">Редактировать</a>
	            	</div>
	            	<div class="btn">
	            	<a href="process.php?delete=<?php echo $value['id']?>"
	            	class="btn btn-danger">Удалить</a>
	            </div>
	            </td>
        	</tr>
        <br>

        <?php
    	}

    ?>

        	</table>
        </div>

    
    <div class="row justify-content-center">
		<form action="process.php" method="POST">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<div class="form-group">
			<label>Наименование товара</label>
			<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Введите название товара">
			</div>
			<div class="form-group">
			<label>Цена товара</label>
			<input type="text" name="price" class="form-control" value="<?php echo $price; ?>" placeholder="Введите цену товара">
			</div>
			<div class="form-group">
			<label>Описание товара</label>
			<input type="text" name="description" class="form-control" value="<?php echo $description; ?>" placeholder="Введите описание товара">
			</div>
			<div class="form-group">
			<label>Характеристики товара</label>
			<input type="text" name="features" class="form-control" value="<?php echo $features; ?>" placeholder="Введите характеристики товара">
			</div>
			<div class="form-group">
				<?php
				if($update == true):
				?>
					<button type="submit" class="btn btn-info" name="update">Обновить</button>
				<?php else: ?>
					<button type="submit" class="btn btn-primary" name="save">Сохранить</button>
				<?php endif; ?>
			</div>
		</form>
	</div>
</div>
</body>
</html>








<?php
include_once "config/config.php";

	?>

	<!--<li>
		<a href="#"><?php echo $result->ProductName ?> </a>

	</li>-->
	<?php
// }

?>