<?php include "../teacher/connect.php"?>
<?php if(isset($_POST["examid"]) ){

    $answerSql = $conn->prepare("SELECT DISTINCT studentNo, studentName,examId FROM answerTable WHERE examId  = :examId ");
    $answerSql->bindParam(":examId",$_POST["examid"]);
    $answerSql->execute();
    $studentNoSort = $answerSql->fetchAll();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="../air-datepicker-master/dist/css/datepicker.min.css">
    <link rel="stylesheet" href="../teacher/index.css">
    <title>Sınava Giren öğrenciler</title>
</head>
<body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                        <div class="card" style="width: 100%;">
                            <div class="card-header">
                               Sınava Giren Öğrenciler
                            </div>
                            <ul class="list-group list-group-flush">
                                <form action="answerManagement.php" method="POST">
                                    <div class="row" >
                                <?php foreach ($studentNoSort as $row):?>

                                    <div class="col-md-4 ">
                                        <input type="text" name="examId" value="<?php echo  $row["examId"]?>" hidden>
                                        <button style="width: 100%; border-style: none " type="submit" name="studentNo" value="<?php echo $row["studentNo"]?>"  class="list-group-item btn"><?php echo $row["studentNo"]."   ". $row["studentName"]?></button>
                                    </div>

                                <?php endforeach;?>
                                    </div>
                                </form>
                            </ul>
                        </div>

                </div>
            </div>
        </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

<script>
/* $(".list-group li").click(function () {
     var no = $(this).attr("id");

    $.ajax({
         type:"POST",
         url:"answerManagement.php",
         data:'studentNo='+no,
         success:function (){

             location.href = "answerManagement.php";


         },
         error:function (){
             console.log("error");
         }
     });
 });*/
</script>

<style>
    .list-group button:hover{
           cursor: pointer;
            background: #1d75b3;
            color: white;
    }


</style>
</html>