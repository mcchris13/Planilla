<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM cashadvance WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Adelanto eliminado ';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Elige el adelanto a eliminar';
	}

	header('location: cashadvance.php');
	
?>