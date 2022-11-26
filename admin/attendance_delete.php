<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM attendance WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Asistencia Eliminada';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Elige una Asistencia';
	}

	header('location: attendance.php');
	
?>