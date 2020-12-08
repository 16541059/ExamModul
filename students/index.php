<?php session_start()?>
<?php include '../teacher/connect.php';?>

<?php
if(isset($_GET["examid"])){
    $_SESSION["examid"]= $_GET["examid"];
}
if(isset($_POST["examid"])){
    $_SESSION["examid"]= $_POST["examid"];
}


    $questionSql = $conn->prepare("SELECT * FROM questionTable WHERE examId  = :examid ORDER BY question DESC ");
    $questionSql->bindParam(":examid",  $_SESSION["examid"] );
    $questionSql->execute();
    $questionSort = $questionSql->fetchAll();
?>
<?php
$i=0;
if(isset($_POST["next"])){

    $_SESSION["question"]= $_SESSION["question"]+ $_POST["next"];
    $i= $_SESSION["question"];

}
if(isset($_POST["previous"])){
    if($_SESSION["question"]>0){
        $_SESSION["question"]= $_SESSION["question"]- $_POST["previous"];
        $i= $_SESSION["question"];
    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="../air-datepicker-master/dist/css/datepicker.min.css">
    <link rel="stylesheet" href="../teacher/index.css">
</head>
<body>
<div class="container mb-5">
    <div class="row">
        <div class="card" style="width:98%">
            <div class="card-header">
                Soru <?php echo $i+1?>
            </div>
            <div class="card-body">
                <?php if(isset($questionSort[$i]["trueQuestion"])): ?>
                <h3>Soru: <?php echo $questionSort[ $i ]["question"]?></h3>

                <div class="col-md-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="<?php echo $questionSort[ $i ]["trueQuestion"]?>" >
                        <label class="form-check-label" for="exampleRadios1">
                            A: <?php echo $questionSort[ $i ]["trueQuestion"]?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="<?php echo $questionSort[ $i ]["falseQuestion1"]?>" >
                        <label class="form-check-label" for="exampleRadios2">
                            B: <?php echo $questionSort[ $i ]["falseQuestion1"]?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="<?php echo $questionSort[ $i ]["falseQuestion2"]?>" >
                        <label class="form-check-label" for="exampleRadios3">
                            C: <?php echo $questionSort[ $i ]["falseQuestion2"]?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="<?php echo $questionSort[ $i ]["falseQuestion3"]?>" >
                        <label class="form-check-label" for="exampleRadios4">

                            D: <?php echo $questionSort[ $i ]["falseQuestion3"]?>
                        </label>
                    </div>
                        <div class="form-check" >
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios5" value="<?php echo $questionSort[ $i ]["falseQuestion4"]?>" >
                            <label class="form-check-label" for="exampleRadios5">
                                 E: <?php echo $questionSort[ $i ]["falseQuestion4"]?>
                            </label>
                        </div>
                </div>
                <?php endif;?>

                    <?php if(isset($questionSort[$i]["trueFalse"])):?>
                        <h3>Soru: <?php echo $questionSort[ $i ]["question"]?></h3>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value=1 >
                            <label class="form-check-label" for="exampleRadios1">

                                <span>Doğru</span>
                            </label>
                        </div>
                        <div class="form-check" >
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value=0 >
                            <label class="form-check-label" for="exampleRadios2">
                               <span>Yanlış</span>
                            </label>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($questionSort[$i]["answer"])):?>
                        <h3>Soru: <?php echo $questionSort[ $i ]["question"]?></h3>
                        <hr>
                        <br>
                        <br>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Cevap:</span>
                            </div>
                            <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    <?php endif;?>
                    <?php if(!isset($questionSort[$i]["answer"]) and !isset($questionSort[$i]["trueQuestion"]) and !isset($questionSort[$i]["trueFalse"])): ?>
                        <h3>Soru: <?php echo $questionSort[ $i ]["question"]?></h3>
                        <hr>
                        <br>
                        <br>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Cevap:</span>
                            </div>
                            <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    <?php endif; ?>

                </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
    <div class="col-md-2">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <form action="index.php" method="POST">
                    <input hidden value=1  name="previous" type="text">
                    <input type="text" hidden name="examid" value="<?php echo $_SESSION["examid"]?>">
                    <li class="page-item" ><button class="page-link" type="submit"> Önceki Soru <i  class="fas fa-arrow-left"></i> </button></li>
                </form>

            </ul>
        </nav>
    </div>
    <div class="col-md-8"></div>
    <div class="col-md-2">
        <div class="">
        <nav aria-label="Page navigation example">
            <ul class="pagination center">
                <?php if($i<count($questionSort)-1):?>
                <form action="index.php" method="POST">
                    <input hidden value=1 name="next" type="text">
                    <input type="text" hidden name="examid" value="<?php echo $_SESSION["examid"]?>">
                    <li class="page-item" ><button class="page-link" type="submit"> Sonraki Soru <i class="fas fa-arrow-right "></i> </button></li>
                </form>
                <?php else:?>
                    <form action="exams.php" method="POST">
                        <li class="page-item" ><button name="finishExam" class="page-link" type="submit"> Sınavı Bitir <i class="fas fa-arrow-right "></i> </button></li>
                    </form>

                <?php endif; ?>

            </ul>
        </nav>
        </div>
    </div>
    </div>
</div>
<?php echo count($questionSort)?>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script>

/*    shuffleElements( $('.form-check') );
    function shuffleElements($elements) {
        var i, index1, index2, temp_val;

        var count = $elements.length;
        var $parent = $elements.parent();
        var shuffled_array = [];


        // populate array of indexes
        for (i = 0; i < count; i++) {
            shuffled_array.push(i);
        }

        // shuffle indexes
        for (i = 0; i < count; i++) {
            index1 = (Math.random() * count) | 0;
            index2 = (Math.random() * count) | 0;

            temp_val = shuffled_array[index1];
            shuffled_array[index1] = shuffled_array[index2];
            shuffled_array[index2] = temp_val;
        }

        // apply random order to elements
        $elements.detach();
        for (i = 0; i < count; i++) {
            $parent.append( $elements.eq(shuffled_array[i]) );
        }
    }*/
$(".form-check-input")
    .change(function(){
        if( $(this).is(":checked") ){
            var val = $(this).val();
            console.log(val);
        }
    });


</script>

<style>
.center{
    position: relative;
    margin: auto;
}
</style>
</html>
