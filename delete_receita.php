<?php

session_start();
require_once("config.php");
require_once('connection.php');

if (isset($_GET['tran_id'])) {
    $tran_id = $_GET['tran_id'];
    $mysql_query = "DELETE FROM transacao WHERE tran_id=$tran_id";
    if ($conn->query($mysql_query) === TRUE) {
        $msg = "delete success";
        $msgerror = "";
    }
    else {
        $msg =  "delete error";
        $msgerror = $conn->error;
    }
    mysqli_close($conn);
} else {
    $msg =  "delete error";
    $msgerror =  "O ID não foi informado!";
}
header("Location: receitas.php?msg={$msg}&msgerror={$msgerror}");