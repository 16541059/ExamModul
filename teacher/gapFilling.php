<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boşluk Doldurma</title>

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
                            <input class="form-control" placeholder="BOŞLUK DOLDURMA <?php echo $_GET["id"]?>" readonly type="text">
                        </div>
                    </div>

                </div>
                <form method="POST" action="process.php" class="form-group " enctype="multipart/form-data">
                    <div class="row" style="background: whitesmoke;height: 80px;" >
                        <div class="col-md-2">
                            <label style="padding-top: 20px"  class="d-flex justify-content-end">Resim</label>
                        </div>
                        <div class="col-md-10">
                            <input type="file" style="padding-top: 20px" name="file"  accept="image/png, image/jpeg" placeholder="Resim seçiniz">
                        </div>
                    </div>
                    <div  class="row" style="background-color:#0fe424;color:white;">
                        <div class="col-md-2">
                            <label class="d-flex justify-content-end">SORU</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="examid" value="<?php echo $_GET["id"]?>" hidden >
                            <textarea class="form-control" name="question"></textarea>
                        </div>
                    </div>
                    <div  class="row" style="background-color:darkblue;color:white;margin-bottom: 15px;margin-top: 15px;">
                        <div class="col-md-2">
                            <label class="d-flex justify-content-end">CEVAP</label>
                        </div>
                        <div class="col-md-10" >
                            <input class="form-control" name="answer" placeholder=""  type="text">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 8px;">
                        <div class="col-md-3">
                            <button id="previewBtn" class="d-flex justify-content-start btn btn-primary"><i  class="fas fa-eye"></i> SORU ÖNİZLEME</button>
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
                                <button id="saveBtn" class=" btn btn-success " name="addGapFilling" >   <i class="fas fa-plus"></i> KAYDET</button>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="questionModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content" style="background-color: silver">
        <span class="close">&times;</span>
        <p class="A"></p>
        <div class="d-flex justify-content-end" style="margin-top: 10px">

        </div>
    </div>
</div>
</body>




<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>-->
<script src="../ckeditor/ckeditor.js"></script>

<script>


    var question= CKEDITOR.replace( 'question' );

    CKEDITOR.config.height = '10em';
    CKEDITOR.config.defaultLanguage = 'tr';
    question.config.uiColor="#0fe424";
    CKEDITOR.config.autoParagraph = false;

    var modal=$("#questionModal");
    var btn=$("#previewBtn");
    var close=$(".close");

    btn.click(function (e) {
        //modal.css("display","block");
        e.preventDefault();

        $(".A").html("<p>"+"Soru: "+CKEDITOR.instances['question'].getData()+"</p>"+
            "<p>"+ "Cevap: " +"<input type='text' class='form-control' /> " +"</p>");
        modal.show( "fast" );

    });
    close.click(function (){

        //    modal.css("display","none");
        modal.hide( "fast" );


    });
    $(window).click(function (e){

        if (e.target == modal[0]) {
            //   modal.css("display","none");
            modal.hide( "fast" );
        }
    });

    $("#recantBtn").click(function () {
        let data ="";

        CKEDITOR.instances['question'].getData(data);
        CKEDITOR.instances['answer'].setData(data);
        $(location).attr('href', '/php/teacher/index.php');
    });

</script>
