<?php 

if (!isset($_SESSION['loggedin'])) {
	header('Location: html/index.html');
	exit;
}