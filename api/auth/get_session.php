<?php
session_start();

$loggedin = $_GET['loggedin'];

echo json_encode($_SESSION);