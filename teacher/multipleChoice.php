<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Çoktan Seçmeli</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="multipleChoice" class="form-group">
                    <div class="form-group ">
                        <div class="row" style="background-color: #e6e600":color:white;>
                    <div class="col-md-2">
                        <label class="d-flex justify-content-end">SORU TÜRÜ</label>
                    </div>
                    <div class="col-md-10">
                        <input class="form-control" placeholder="5 ŞIKLI ÇOKTAN SEÇMELİ <?php echo $_GET["id"]?>" readonly type="text">
                    </div>
                        </div>
                    </div>
                    <form action="process.php" class="form-group" method="POST" enctype="multipart/form-data">
                        <div class="row" style="background: whitesmoke;height: 80px;" >
                            <div class="col-md-2">
                                <label style="padding-top: 20px"  class="d-flex justify-content-end">Resim</label>
                            </div>
                            <div class="col-md-10">
                                <input type="file" style="padding-top: 20px" name="file"  accept="image/png, image/jpeg" placeholder="Resim seçiniz">
                            </div>
                        </div>
                        <div class="row" style="background-color:#1648EB;color:white;">
                            <div class="col-md-2">
                                <input type="text" name="examid" value="<?php echo $_GET["id"]?>" hidden >
                                <label class="d-flex justify-content-end">SORU</label>
                            </div>
                            <div class="col-md-10">
                             <textarea class="form-control" name="question"></textarea>
                            </div>
                        </div>
                        <div class="row" style="background-color:#0FE424;color:white;">
                            <div class="col-md-2"  >
                                <label class="d-flex justify-content-end">DOĞRU CEVAP</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" name="trueQuestion"></textarea>
                            </div>
                        </div>
                        <div class="row" style="background-color:#b30000;color:white;">
                            <div class="col-md-2">
                                <label class="d-flex justify-content-end">1.YANLIŞ CEVAP</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" name="falseQuestion1"></textarea>
                            </div>
                        </div>
                        <div class="row" style="background-color:#b30000;color:white;">
                            <div class="col-md-2">
                                <label class="d-flex justify-content-end">2.YANLIŞ CEVAP</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" name="falseQuestion2"></textarea>
                            </div>
                        </div>
                        <div class="row" style="background-color:#b30000;color:white;">
                            <div class="col-md-2">
                                <label class="d-flex justify-content-end">3.YANLIŞ CEVAP</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" name="falseQuestion3"></textarea>
                            </div>
                        </div>
                        <div class="row" style="background-color:#b30000;color:white">
                            <div class="col-md-2">
                                <label class="d-flex justify-content-end">4.YANLIŞ CEVAP</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" name="falseQuestion4"></textarea>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 8px;">
                            <div class="col-md-3">
                                <button id="previewBtn" type="button" class="d-flex justify-content-start btn btn-primary"><i class="fas fa-eye"></i> SORU ÖNİZLEME</button>
                            </div>
                            <div class="col-md-2">


                            </div>
                            <div class="col-md-4">
                                <div class="d-flex justify-content-end " style="margin-right: 5px">


                                </div>


                            </div>
                            <div class="col-md-3">
                                <div class="d-flex justify-content-end" style="margin-left: 5px">
                                    <button id="recantBtn" type="reset" class="btn btn-danger"><i class="fas fa-window-close"></i> VAZGEÇ</button>
                                    <button id="saveBtn" name="saveQuestionMultiple" type="submit" class=" btn btn-success ">  <i class="fas fa-plus"></i> KAYDET</button>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</body>




<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>-->
<script src="../jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="../ckeditor/ckeditor.js"></script>

<script>



   var question= CKEDITOR.replace( 'question' );
  var editor=  CKEDITOR.replace( 'trueQuestion' );
    CKEDITOR.replace( 'falseQuestion1' );
    CKEDITOR.replace( 'falseQuestion2' );
    CKEDITOR.replace( 'falseQuestion3' );
    CKEDITOR.replace( 'falseQuestion4' );
    CKEDITOR.config.uiColor = '#b30000';
    CKEDITOR.config.height = '5em';
    CKEDITOR.config.defaultLanguage = 'tr';
    editor.config.uiColor='#0FE424'
    question.config.uiColor="#1648EB"


   CKEDITOR.config.autoParagraph = false;


    $("#previewBtn").click(function (){
      var question=  $("textarea[name=question]").val();
    });





</script>

</html>
