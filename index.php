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
                    <button  class="btn btn-success "><i class="fas fa-plus"></i> SINAV EKLE</button>
                </div>

            </div>
        </div>


            <div class="row questionBar">
                <div class="col-md-4">
                    <h6>SORULAR</h6>

                </div>
                <div class="col-md-8">
                    <div class="d-flex justify-content-end ">
                        <button id="myBtn"  class="btn btn-success "><i class="fas fa-plus"></i> SORU EKLE</button>
                    </div>

                 </div>
            </div>


        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content" style="background-color: silver">
                <span class="close">&times;</span>
                <select id="examSelect" class="form-control select-css">
                	<option value="multipleChoice">Çoktan Seçmeli</option>
                	<option value="trueFalse">Doğru/Yanlış</option>
                	<option value="gapFilling">Boşluk Doldurma</option>
                	<option value="openCloze">Açık Uçlu</option>
                </select>
                <div class="d-flex justify-content-end" style="margin-top: 10px">
                    <button id="addExam" class=" btn btn-success"><i class="fas fa-plus"></i> EKLE</button>
                </div>
            </div>

        </div>


    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>-->
<script src="ckeditor/ckeditor.js"></script>

<script>
    var modal=$("#myModal");
    var btn=$("#myBtn");
    var close=$(".close");
    btn.click(function () {
        //modal.css("display","block");
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

    $("#addExam").click(function () {
     var examSelectVal=   $("#examSelect").val();
        switch(examSelectVal) {
            case "multipleChoice":
                $(location).attr('href', '<?php echo base_url()?>/php/multipleChoice.php');
                break;
            case "trueFalse":
                $(location).attr('href', '<?php echo base_url()?>/php/trueFalse.php');
                break;
            case "gapFilling":
                $(location).attr('href', '<?php echo base_url()?>/php/gapFilling.php');
                break;
            case"openCloze":
                $(location).attr('href', '<?php echo base_url()?>/php/openCloze.php');
                break;
            default:
            // code block
        }
    });
</script>
</html>
<?php
function base_url() {
    return 'http://localhost';
}

?>