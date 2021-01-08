<?php
session_start();
include '../teacher/connect.php';
$examSql=$conn->prepare("SELECT * FROM examTable  ");
$examSql->execute();
$examSort= $examSql->fetchAll();

if(isset($_POST["finishExam"])){
    unset($_SESSION['id']);
}

$date = date("Y-m-d H:i:s");


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
    <title>Sınavlar</title>
</head>
<body>
<div class="container">
    <div class="row">
        <?php foreach ($examSort as $row):?>
            <?php
            $questionSql = $conn->prepare("SELECT COUNT(examId) FROM questionTable WHERE examId  = :examId ");
            $questionSql->bindParam(":examId",$row["examId"]);
            $questionSql->execute();
            $questionSort = $questionSql->fetchAll();
            ?>
        <?php if($row["activation"]): ?>
            <div class="col-sm-4" >
                <div class="card text-white bg-secondary mb-3" style="width: 100%;">
                    <div class="card-header"> <?php echo $row["examId"]."-".$row["examName"]?></div>
                    <div class="card-body">
                        <ul>
                            <li>
                                Toplan sınav süresi <?php echo $row["maxTime"]?>
                            </li>
                            <li>
                                Her öğrenci <?php echo  $row["maxEntry"] ?> deneme hakkına sahiptir
                            </li>
                            <li>
                                Yanlış cevap, doğru cevaplarınızı etkilemeyecektir.
                            </li>
                            <li>
                                Sınav  <?php echo $questionSort[0][0]?> sorudan mevcuttur
                            </li>

                        </ul>

                        <?php if($row["startTime"]<$date and $date<$row["endTime"]): ?>
                        <button value="<?php echo $_SESSION["id"]= $row["examId"] ?> "  name="examid" class="btn btn-success goExam">Sınava Git</button>
                        <?php else:?>
                            <button   name="examid" class="btn btn-danger " <?php echo ($row["startTime"]<$date and $date<$row["endTime"])?"":"disabled" ?> ><i class="fas fa-lock"></i></button>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        <?php endif;?>

        <?php  endforeach;?>
        <?php
        if(isset($_POST["finishExam"])){
            unset($_SESSION['id']);
            unset($_SESSION["question"]);
            unset($_SESSION["quest"]);
            unset($_COOKIE["cnt"]);

        }

        ?>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
</html>
<script>

    $(".goExam").click(function () {
        var questionid = $(this).attr("value");
        $.ajax({
            type:"POST",
            url:"questionRandom.php",
            data:'examid='+questionid,
            success:function (msg){

                location.href = "questions.php";


            },
            error:function (){
                console.log("error");
            }
        });
        $.ajax({
            type:"POST",
            url:"questions.php",
            data:{'next':1},
            success:function (msg){

                console.log('%c success', 'background: black; color: green');



            },
            error:function (){

                console.log('%c error', 'background: black; color: red');

            }
        });

    });


</script>