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

$examTime = $conn->prepare("SELECT maxTime FROM examTable WHERE examId  = :examid ");
$examTime->bindParam(":examid",  $_SESSION["examid"] );
$examTime->execute();
$time = $examTime->fetchAll();
$_SESSION["time"]=$time;

?>

