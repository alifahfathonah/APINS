<?php
include '../inc/db.php';
session_start();
if(!isset($_SESSION['userid'])){
	header('location:login.html');
}else{ 
	if(isset($_SESSION['level'])){
		if($_SESSION['level']==11){
			header('location:./operator/');
		}elseif($_SESSION['level']==5){
			header('location:./tu/');
		}elseif($_SESSION['level']==99){
			header('location:./kepsek/');
		}else{
			header('location:./guru/');
		};		
	}else{
		header('location:./siswa/');
	}
}; 
?>