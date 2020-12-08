
<?php
include 'connect.php';
?>
<?php
$examTable = $conn->query("SELECT * FROM examTable", PDO::FETCH_ASSOC);
$radio=strval($_GET["radioValue"]) ;
$questionSql=$conn->prepare("SELECT * FROM questionTable WHERE examId  = :examId");
$questionSql->bindParam(":examId",$radio);
$questionSql->execute();
$questionSort= $questionSql->fetchAll();


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
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">

        <div class="row questionOptionBar">

               <h6>SINAV ÖZELLİKLERİ</h6>

        </div>

        <div class="row questionBar">
            <div class="col-md-4">
                <h6>SINAVLAR</h6>

            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-end ">
                    <button id="examAddModal"  class="btn btn-success "><i class="fas fa-plus"></i> SINAV EKLE</button>
                </div>

            </div>

        </div>
        <div class="row ">
            <div class="col mr-5">
                <table class="table table-borderless table-dark">
                    <thead>
                    <tr>
                        <th scope="col">Seç</th>
                        <th scope="col">Ders Kodu</th>
                        <th scope="col">Başlangıç Zamanı</th>
                        <th scope="col">Bitiş Zamanı</th>
                        <th scope="col">Ders Adı</th>
                        <th scope="col">Maksimun Not</th>
                        <th scope="col">Deneme Sayısı</th>
                        <th scope="col">Sınav Süresi</th>
                        <th scope="col">Sınav Durumu</th>
                        <th scope="col">Seç</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php if($examTable->rowCount()):?>
                 <?php foreach ($examTable as $row ):?>
                    <tr id="exam-<?php echo $row["examId"] ?>">

                        <td><input type="radio" id="radio"  name="examSelecet" value="<?php echo $row["examId"] ?>"  <?php if($_GET['radioValue'] == $row["examId"])  echo ' checked="checked"';?> ></td>
                        <th scope="row"><?php echo $row["examId"]?> </th>
                        <td><?php echo $row["startTime"]?></td>
                        <td><?php echo $row["endTime"]?></td>
                        <td><?php echo $row["examName"]?></td>
                        <td><?php echo $row["maxMark"]?></td>
                        <td><?php echo $row["maxEntry"]?></td>
                        <td><?php echo $row["maxTime"]?></td>
                        <td><?php echo $row["activation"] ?  "Aktif":"Pasif"; ?></td>
                        <td>

                            <button id="editExam" type="submit" class="btn btn-success"><i class="fas fa-bars"></i></button>
                            <button  id="<?php echo $row["examId"] ?>" type="submit" class="btn btn-danger far fa-trash-alt deleteExam "></button>

                        </td>

                    </tr>

                    <?php endforeach;?>
                    <?php endif;?>
                    </tbody>
                </table>

            </div>
        </div>



            <div class="row questionBar">
                <div class="col-md-4">
                    <h6>SORULAR</h6>

                </div>
                <div class="col-md-8">
                    <div class="d-flex justify-content-end ">
                        <button id="addQuestionBtn"  class="btn btn-success "><i class="fas fa-plus"></i> SORU EKLE</button>
                    </div>

                 </div>
            </div>
        <div class="row">
            <div class="col mr-5">
                <?php if($examTable->rowCount()):?>
                <?php foreach ($questionSort as $row ):?>

                        <?php  $i=$i+1;?>
                    <div  class="card text-white bg-dark mb-3">
                        <div id="card-<?php echo $i?>"  class="card-header">
                            Soru <?php echo $i;?> <span id="<?php echo $i?>" class="badge badge-info slidequestion"> <i id="angle-up-<?php echo $i?>" class="fas fa-angle-down"></i></span>
                            <div class="col-md-2 float-right">
                                <button card-header type="submit" class="btn btn-success  fas fa-bars"></button>
                                <button id="<?php echo $row["index"];?>"  card-header style="margin-left: 1em"  type="submit" class="btn btn-danger far fa-trash-alt deletequestion "></button>
                            </div>

                        </div>
                        <div id="exam-<?php echo $i ?>"  class="card-body" style="display: none">
                            <?php if(isset($row["trueQuestion"])): ?>
                                <div style="background-color: grey; margin-bottom:10px;" class="row">
                                    <div class="col-md-1">
                                        <span >Soru:</span>
                                    </div>
                                    <div class="col-md-10">
                                        <span ><?php echo $row["question"]?></span>
                                    </div>
                                </div>
                                <div style="background-color: green; margin-bottom: 10px" class="row">
                                    <div style="background-color: grey" class="col-md-1">
                                        <span >A:</span>
                                    </div>
                                    <div class="col-md-10">
                                        <span ><?php echo $row["trueQuestion"]?></span>
                                    </div>
                                </div>
                                <div style="background-color: red; margin-bottom: 10px" class="row">
                                    <div style="background-color: grey" class="col-md-1">
                                        <span >B:</span>
                                    </div>
                                    <div class="col-md-10">
                                        <span ><?php echo $row["falseQuestion1"]?></span>
                                    </div>
                                </div>
                                <div style="background-color: red; margin-bottom: 10px" class="row">
                                    <div style="background-color: grey" class="col-md-1">
                                        <span >C:</span>
                                    </div>
                                    <div class="col-md-10">
                                        <span ><?php echo $row["falseQuestion2"]?></span>
                                    </div>
                                </div>
                                <div style="background-color: red; margin-bottom: 10px" class="row">
                                    <div style="background-color: grey" class="col-md-1">
                                        <span >D:</span>
                                    </div>
                                    <div class="col-md-10">
                                        <span ><?php echo $row["falseQuestion3"]?></span>
                                    </div>
                                </div>
                                <div style="background-color: red; margin-bottom: 10px" class="row">
                                    <div style="background-color: grey" class="col-md-1">
                                        <span >E:</span>
                                    </div>
                                    <div class="col-md-10">
                                        <span ><?php echo $row["falseQuestion4"]?></span>
                                    </div>
                                </div>

                            <?php endif;?>

                            <?php if(isset($row["trueFalse"])): ?>
                                <div style="background-color: grey; margin-bottom: 10px" class="row">
                                    <div class="col-md-1">
                                        <span >Soru:</span>
                                    </div>
                                    <div class="col-md-10">
                                        <span ><?php echo $row["question"]?></span>
                                    </div>
                                </div>
                                <div style=" background-color:<?php echo $row["trueFalse"] ?  "green": "red"?> ; margin-bottom: 10px" class="row">
                                    <div style="background-color: grey" class="col-md-1">
                                        <span >Cevap:</span>
                                    </div>
                                    <div class="col-md-10">
                                        <span ><?php echo $row["trueFalse"] ?  "Doğru": "Yanlış"?></span>
                                    </div>
                                </div>

                            <?php endif;?>
                            <?php if(isset($row["answer"])): ?>
                                <div style="background-color: grey; margin-bottom: 10px" class="row">
                                    <div class="col-md-1">
                                        <span >Soru:</span>
                                    </div>
                                    <div class="col-md-10">
                                        <span ><?php echo $row["question"]?></span>
                                    </div>
                                </div>
                                <div style=" background-color:green; margin-bottom: 10px" class="row">
                                    <div style="background-color: grey" class="col-md-1">
                                        <span >Cevap:</span>
                                    </div>
                                    <div class="col-md-10">
                                        <span ><?php echo $row["answer"]?></span>
                                    </div>
                                </div>

                            <?php endif;?>
                            <?php if(!isset($row["answer"]) and !isset($row["trueQuestion"]) and !isset($row["trueFalse"])): ?>
                                <div style="background-color: grey; margin-bottom: 10px" class="row">
                                    <div class="col-md-1">
                                        <span >Soru:</span>
                                    </div>
                                    <div class="col-md-10">
                                        <span ><?php echo $row["question"]?></span>
                                    </div>
                                </div>


                            <?php endif;?>


                        </div>
                    </div>

                <?php endforeach;?>
                <?php endif;?>
                <?php $questionId= $_GET['radioValue']?>
            </div>
        </div>



        <!-- The Modal -->
        <div id="questionModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content" style="background-color: silver">
                <span class="close">&times;</span>
                <select id="questionSelect" class="form-control select-css">
                	<option value="multipleChoice">Çoktan Seçmeli</option>
                	<option value="trueFalse">Doğru/Yanlış</option>
                	<option value="gapFilling">Boşluk Doldurma</option>
                	<option value="openCloze">Açık Uçlu</option>
                </select>
                <div class="d-flex justify-content-end" style="margin-top: 10px">
                    <button id="addQuestion" value="<?php echo $questionId?>" class=" btn btn-success"><i class="fas fa-plus"></i> EKLE</button>
                </div>
            </div>
        </div>
        <!-- The Modal -->
        <div id="examModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content" style="background-color: silver">
                <span class="close">&times;</span>
                <form id="examAddForm" action="process.php" method="POST">
                    <div class="form-group">
                        <label for="examIdInput">Ders Kodu</label>
                        <div class="input-container">
                            <i class="fas fa-barcode icon"></i>
                            <input type="input"  class="form-control input-field" name="examCode" id="examIdInput" aria-describedby="inputHelp" required >

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="examIdInput">Başlama Zamanı</label>
                        <div class="input-container">
                            <i class="icon fas fa-calendar-alt "></i>
                        <input type="input" id='timepicker-actions-exmpl' name="examStartTime" class="form-control input-field"  aria-describedby="inputHelp" required >

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="examIdInput">Bitiş Zamanı</label>
                        <div class="input-container">
                            <i class="icon fas fa-calendar-alt "></i>
                            <input type="input" id='timepicker-actions-exmpl2' name="examEndTime" class="form-control input-field"  aria-describedby="inputHelp" required >

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="examIdInput">Ders Adı</label>
                        <div class="input-container">
                            <i class="fas fa-signature icon"></i>
                            <input type="input"  class="form-control input-field" name="examName" aria-describedby="inputHelp" required >

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="examIdInput">Maksimun Not</label>
                        <div class="input-container">
                            <i class="fas fa-marker icon"></i>
                            <input type="number"  class="form-control input-field" name="examMark" aria-describedby="inputHelp" >

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="examIdInput">Deneme Sayısı</label>
                        <div class="input-container">
                            <i class="fas fa-sort-numeric-up-alt icon"></i>
                            <input type="number"  class="form-control input-field" name="examEntry" aria-describedby="inputHelp" min="1" max="5" >

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="examIdInput">Sınav Süresi</label>
                        <div class="input-container">
                            <i class="fas fa-stopwatch icon"></i>
                            <input type="time"  class="form-control input-field" name="examTime" aria-describedby="inputHelp" >

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="examIdInput">Sınav Durumu</label>
                        <div class="input-container">
                            <i class="fas fa-check icon"></i>

                            <input type="radio"  name="examStatus" value="1" checked>
                            <label for="male">Aktif</label><br>
                            <input type="radio"  name="examStatus" value="0">
                            <label for="female">Pasif</label><br>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" name="addExam">Gönder</button>
                </form>

            </div>
        </div>

    </div>

</body>




<script src="../ckeditor/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="../air-datepicker-master/dist/js/datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script type="text/javascript" src="../air-datepicker-master/dist/js/datepicker.min.js"></script>
<script src="../air-datepicker-master/dist/js/i18n/datepicker.tr.js"></script>

<script src="index.js"></script>
</html>
<?php
function base_url() {
    return 'http://localhost';
}

