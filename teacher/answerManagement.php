<?php include "../teacher/connect.php"?>
<?php if(isset($_POST["studentNo"]) ){

    $answerSql = $conn->prepare("SELECT * FROM questionTable JOIN answerTable ON questionTable.index = answerTable.questionIndex
WHERE answerTable.studentNo = :studentNo AND answerTable.examId=:examId ");
    $answerSql->bindParam(":studentNo",$_POST["studentNo"]);
    $answerSql->bindParam(":examId",$_POST["examId"]);
    $answerSql->execute();
    $answerSort = $answerSql->fetchAll();

    $questionSql = $conn->prepare("SELECT * FROM questionTable WHERE examId=:examId ");
    $questionSql->bindParam(":examId",$_POST["examId"]);
    $questionSql->execute();
    $questionSort = $questionSql->fetchAll();

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
    <title>Cevaplar</title>
</head>
<body>

<div class="container">
    <div class="row questionBar">
        <div class="col-md-4">
            <h6>SINAV BİLGİLERİ</h6>

        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-end ">
<!--                <button id="examAddModal"  class="btn btn-success "><i class="fas fa-plus"></i> SINAV EKLE</button>-->
            </div>

        </div>

    </div>
    <div class="list-group" style="margin-right: 20px;">
        <li id="examid"  class="list-group-item list-group-item-action list-group-item-info" value="<?php echo $_POST["examId"]?>" >Sınav Kodu: <?php echo $_POST["examId"]?>  </li>
        <li  class="list-group-item list-group-item-action list-group-item-info">Sınav'da <?php echo count($questionSort)?>  soru mevcuttur </li>
        <li  class="list-group-item list-group-item-action list-group-item-info">Öğrenci <?php echo count($answerSort)?>  adet soruya cevap vermiştir</li>

    </div>

    <div class="row">
        <div class="col-md-12">

            <span style="width: 100%" class="badge badge-warning"><?php echo $answerSort[0]["studentNo"]." ".$answerSort[0]["studentName"].""?></span>
            <input class="name" type="text" hidden value="<?php echo $answerSort[0]["studentName"] ?>">
            <table class="table table-dark">
                <thead>
                <tr>

                    <th scope="col">Soru</th>
                    <th scope="col">Doğru Devap</th>
                    <th scope="col">Öğrencinin Verdiği Cevap</th>
                    <th scope="col">Puan</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($answerSort as $row):?>
                    <tr>


                        <td>
                            <img class="aw-zoom" src="<?php echo $row["image"]?>" width="20%" alt="">
                            <?php echo $row["question"]?>
                        </td>

                        <td class="trueAns">

                         <?php if (isset($row["trueFalse"])): ?>

                        <?php if ($row["trueFalse"]==0): ?>

                                <?php echo "Yanlış" ?>
                            <?php endif;?>
                            <?php if ($row["trueFalse"]==1): ?>
                                 <?php echo "Doğru" ?>
                             <?php endif;?>
                        <?php endif;?>
                         <?php echo $row["trueQuestion"]?>
                        </td>
                        <td class="studentAns" >

                            <?php if (isset($row["studentAnswer"])): ?>
                                <?php if($row["studentAnswer"]=="1") :?>
                                    <?php echo "Doğru"?>
                                <?php elseif ($row["studentAnswer"]=="0") :?>
                                    <?php echo "Yanlış"?>
                                <?php else: ?>
                                    <?php echo $row["studentAnswer"]?>
                                <?php endif;?>
                            <?php endif; ?>
                        </td >
                        <td class="point" >
                            <input class="input" type="text">
                        </td>

                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-9">
                    <button id="addPoint" value="<?php echo $answerSort[0]["studentNo"] ?>"  class="btn btn-success "><i class="fas fa-plus"></i> Notu Kaydet</button>
                </div>
                <div class="col-md-3">

                    <span style="font-size: 20px" id="point"  class="badge badge-pill badge-primary ">Toplam puan: <span class="sum"></span> </span>

                </div>
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

    $(document).ready(function () {
        var toplam=[];
        var is= $("tbody tr").each(function (){
            var i=+ 1;
            return  i;
        })
        $("tr").each(function(){
            var trueAns= $(this).find(".trueAns").text();
            var studentAns= $(this).find(".studentAns").text();
            var point= $(this).find(".point").text();
            trueAns=   $.trim(trueAns);
            studentAns=  $.trim(studentAns);
            point=  $.trim(point);
            if (studentAns==trueAns){
                $(this).find(".point input").val((100/<?php echo count($questionSort)?>).toFixed(2));
            }
            else {
                $(this).find(".point input").val(0);
            }

        });
        $(":input").change(function () {
            sumfunc();
        });

       function sumfunc() {
           var sum = 0;
           $("input[class *= 'input']").each(function(){
               sum += +$(this).val();
           });
           $(".sum").text(sum);
       }
        sumfunc();
       $("#addPoint").click(function () {
           let no= $(this).attr("value");
           let point= $(".sum").text();
           let name= $(".name").attr("value");
           let examid = $("#examid").attr("value");
           point =$.trim(point);
           examid = $.trim(examid);
           $.ajax({
               type:"POST",
               url:"process.php",
               data:{'point':point,'no':no,'name':name,'pointExamId':examid },
               success:function (data, textStatus, xhr){
                   console.log(xhr.status);
                   alert("Not Kaydedildi");
                   console.log('%c success', 'background: black; color: green');


               },
               error:function (){

                   console.log('%c error', 'background: black; color: red');
               }
           });
       });


    });



</script>


<style>
    .aw-zoom
    {
        position: relative;
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        -moz-transform: scale(1);
        transition: all .3s ease-in;
        -moz-transition: all .3s ease-in;
        -webkit-transition: all .3s ease-in;
        -ms-transition: all .3s ease-in;
    }

    .aw-zoom:hover
    {
        z-index:2;
        -webkit-transform: scale(5);
        -ms-transform: scale(5);
        -moz-transform: scale(5);
        transform: scale(5);
    }
</style>
</html>