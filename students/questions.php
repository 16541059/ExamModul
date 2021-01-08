<?php session_start()?>
<?php include '../teacher/connect.php';?>

<?php
$questionSort= $_SESSION["quest"];
?>
<?php

if(isset($_POST["next"])){

        $_SESSION["question"]= $_SESSION["question"]+ $_POST["next"];

}

$time=$_SESSION["time"] ;
$i= $_SESSION["question"]-1;



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
        <div class="col-md-11">


        <div class="card" style="width:98%">
            <div class="card-header">
                Soru <?php echo $i+1?>

            </div>
            <div class="card-body" >

                <?php if(isset($questionSort[$i]["trueQuestion"])): ?>

                    <img  style="max-width:100%" src="<?php echo $questionSort[ $i ]["image"]?>" alt="">
                    <h3>Soru: <?php echo $questionSort[ $i ]["question"]?></h3>


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

                <?php endif;?>

                <?php if(isset($questionSort[$i]["trueFalse"])):?>
                    <img  style="max-width:100%" src="<?php echo $questionSort[ $i ]["image"]?>" alt="">
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
                    <img  style="max-width:100%" src="<?php echo $questionSort[ $i ]["image"]?>" alt="">
                    <h3>Soru: <?php echo $questionSort[ $i ]["question"]?></h3>
                    <hr>
                    <br>
                    <br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Cevap:</span>
                        </div>
                        <input type="text" class="form-control" name="gapFilling" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                <?php endif;?>
                <?php if(!isset($questionSort[$i]["answer"]) and !isset($questionSort[$i]["trueQuestion"]) and !isset($questionSort[$i]["trueFalse"])): ?>
                    <img  style="max-width:100%" src="<?php echo $questionSort[ $i ]["image"]?>" alt="">
                    <br>
                    <h3>Soru: <?php echo $questionSort[ $i ]["question"]?></h3>
                    <hr>
                    <br>
                    <br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Cevap:</span>
                        </div>
                        <input type="text" name="openCloze" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                <?php endif; ?>
            </div>

        </div>
        </div>
        <div class="col-md-1">
            <input type="text" hidden name="examId" value="<?php echo $_SESSION["examid"]?>">

            <input name="time" value="<?php echo  $time[0]["maxTime"] ?>" hidden placeholder="<?php echo  $time[0]["maxTime"] ?>">
            <form name="counter">
                <label style="color:white;"  for="chandresh">Kalan Süre</label>
                <input type="text" readonly size="8" name="chandresh" id="counter">
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-2">
            <nav aria-label="Page navigation example">
                <ul class="pagination">


                        <input type="text" hidden name="examid" value="<?php echo $_SESSION["examid"]?>">
                        <li class="page-item" ><button id="previousBtn" class="page-link" type="submit"> Önceki Soru <i  class="fas fa-arrow-left"></i> </button></li>


                </ul>
            </nav>
        </div>
        <div class="col-md-7"></div>
        <div class="col-md-2">
            <div class="">
                <nav aria-label="Page navigation example">
                    <ul class="pagination center">
                        <?php if($i <count($questionSort)):?>
                                <li class="page-item" ><button id="nextButton" value="<?php echo $questionSort[$i]["index"]?>" class="page-link" type="submit"> Sonraki Soru <i class="fas fa-arrow-right "></i> </button></li>
                        <?php else:?>
                            <form action="index.php" method="POST">
                                <li class="page-item" ><button name="finishExam"  class="page-link" type="submit"> Sınavı Bitir <i class="fas fa-arrow-right "></i> </button></li>

                            </form>
                        <?php endif; ?>
                    </ul>
                </nav>
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
    console.log($("input[name='time']").val());
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    var cnt = $("input[name='time']").val();
    function counter(){
        if(getCookie("cnt") > 0){
            cnt = getCookie("cnt");
        }
        cnt -= 1;
        document.cookie = "cnt="+ cnt;
        jQuery("#counter").val(getCookie("cnt")+" dk");


        if(cnt>0){
            setTimeout(counter,60000);
        }
        else{
            document.cookie ="cnt="+0;
            $("input[name='time']").val(0);
            $.ajax({
                type:"POST",
                url:"index.php",
                data:{'finishExam':1},
                success:function (msg){

                    console.log('%c success', 'background: black; color: green');
                },
                error:function (){

                    console.log('%c error', 'background: black; color: red');
                }
            });


        }

    }

    counter();



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
            }
        });


    $("#nextButton").click(function (e){
        var radioValue = $("input[type='radio']:checked").val();
        var examId= $("input[name='examId']").val();
        var index= $("button[id='nextButton']").val();
        var gapValue= $("input[name='gapFilling']").val();
        var openValue= $("input[name='openCloze']").val();

       if(radioValue){
           $.ajax({
               type:"POST",
               url:"process.php",
               data:{'radioValue':radioValue,'examId':examId,'index':index},
               success:function (){

                   console.log('%c success', 'background: black; color: green');


               },
               error:function (){
                   console.log('%c error', 'background: black; color: red');


               }
           });

       }

      if(gapValue){
            $.ajax({
                type:"POST",
                url:"process.php",
                data:{'gapValue':gapValue,'examId':examId,'index':index},
                success:function (msg){

                    console.log('%c success', 'background: black; color: green');


                },
                error:function (){
                    console.log('%c error', 'background: black; color: red');
                }
            });
        }
        if(openValue){
            $.ajax({
                type:"POST",
                url:"process.php",
                data:{'openValue':openValue,'examId':examId,'index':index},
                success:function (msg){

                    console.log('%c success', 'background: black; color: green');


                },
                error:function (){
                    console.log('%c error', 'background: black; color: red');
                }
            });
        }

        $.ajax({
            type:"POST",
            url:"questions.php",
            data:{'next':1},
            success:function (msg){

                console.log('%c success', 'background: black; color: green');
                location.reload();



            },
            error:function (msg){
                console.log('%c error', 'background: black; color: red');


            }
        });
    });

    $("#previousBtn").click(function () {
        $.ajax({
            type:"POST",
            url:"questions.php",
            data:{'next':-1},
            success:function (msg){

                console.log('%c success', 'background: black; color: green');
                location.reload();



            },
            error:function (msg){
                console.log('%c error', 'background: black; color: red');


            }
        });
    });
</script>
