<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM deductions WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Retención eliminada';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Selecciona la retención a eliminar ';
	}

	header('location: deduction.php');
	
?>