<?php

session_start();
require_once("config.php");
require_once('connection.php');

if (isset($_GET['con_id'])) {
    $con_id = $_GET['con_id'];
    $mysql_query = "UPDATE contatos SET con_lida=1 WHERE con_id = $con_id";
    if ($conn->query($mysql_query) === TRUE) {
        $msg = "update success";
        $msgerror = "";
    }
    else {
        $msg =  "update error";
        $msgerror = $conn->error;
    }
    mysqli_close($conn);
} else {
    $msg =  "update error";
    $msgerror =  "O ID não foi informado!";
}
header("Location: administrador.php?msg={$msg}&msgerror={$msgerror}");
