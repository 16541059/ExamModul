<?php
session_start();
include '../teacher/connect.php';

if(isset($_POST["examid"])){
    $_SESSION["examid"]=$_POST["examid"];
}


$questionSql = $conn->prepare("SELECT * FROM questionTable WHERE examId  = :examid ORDER BY question DESC ");
$questionSql->bindParam(":examid",  $_SESSION["examid"] );
$questionSql->execute();
$questionSort = $questionSql->fetchAll();
shuffle($questionSort);
$_SESSION["quest"]=$questionSort;


$examSql = $conn->prepare("SELECT * FROM examTable WHERE examId  = :examid  ");
$examSql->bindParam(":examid",  $_SESSION["examid"] );
$examSql->execute();
$examSort = $examSql->fetchAll();
$_SESSION["point"]= $examSort[0]["maxMark"]/count($questionSort);


?>

