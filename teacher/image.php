<?php
include 'connect.php' ; ?>
<?php
$multipleSql = $conn->prepare("INSERT INTO questionTable SET examId=?, question= ?, 	trueQuestion= ?,
falseQuestion1=? ,falseQuestion2= ?,falseQuestion3= ?,falseQuestion4= ? "); ?>
<?php
$a=array();
$b=array();
$A_option=array();
$B_option=array();
$C_option=array();
$D_option=array();
$E_option=array();
$indexone =array();
$indextwo=array();
$questionList= array();

@$tmp_name=$_FILES["file"]["tmp_name"];
@$name=$_FILES["file"]["name"];

/*$file_pdf=@$name;
$file_text=uniqid().".txt";
$command = "/usr/bin/pdftotext -layout  $file_pdf $file_text";
exec($command);
@$name=$file_text;*/

$dosya = fopen(@$name,'r+');
$dosya2=fopen(@$name,'r+');
$dosya3=fopen(@$name,'r+');
$dosya4=fopen(@$name,'r+');
$dosya5=fopen(@$name,'r+');
$dosya6=fopen(@$name,'r+');

function Soru(){
   // $cevap = fopen('../teacher/sorular.txt','r+');
    global $a;
    global $dosya;
    while($oku = fgetc($dosya)) {
            array_push($a,$oku);
    }
    return $a;
    fclose($dosya);
}

 function A(){
  //  $cevap = fopen('../teacher/sorular.txt','r+');
    global $A_option;
    global  $dosya2;
    while($oku = fgets($dosya2)) {
        if (strstr($oku, "A")) {
           array_push($A_option,$oku);
        }
    }

     return $A_option;
     fclose($dosya2);
}
function B(){
   // $cevap = fopen('../teacher/sorular.txt','r+');
    global $dosya3;
    global $B_option;
    while($oku = fgets($dosya3)) {
        if (strstr($oku, "B")) {
            array_push($B_option,$oku);

        }
    }
    return $B_option;
    fclose($dosya3);
}
function C(){
    //$cevap = fopen('../teacher/sorular.txt','r+');
    global $C_option;
    global  $dosya4;
    while($oku = fgets($dosya4)) {
        if (strstr($oku, "C")) {
            array_push($C_option,$oku);
        }
    }
    return $C_option;
    fclose($dosya4);
}

function D(){
   // $cevap = fopen('../teacher/sorular.txt','r+');
    global $dosya5;
    global $D_option;
    while($oku = fgets($dosya5)) {
        if (strstr($oku, "D")) {
            array_push($D_option,$oku);
        }
    }
    return $D_option;
    fclose($dosya5);
}
function E(){
 //   $cevap = fopen('../teacher/sorular.txt','r+');
    global $E_option;
    global $dosya6;
    while($oku = fgets($dosya6)) {
        if (strstr($oku, "E")) {
            array_push($E_option,$oku);
        }
    }
    return $E_option;
    fclose($dosya6);
}

soru();

function question(){
    global  $a;
    global $indexone;
    global  $indextwo;
   global  $questionList;
    foreach ($a as $key=> $value){
        if(strstr($value,":")){
            array_push($indexone,$key);

        }
        if(strstr($value,"?")){
            array_push($indextwo,$key);

        }
    }
    $countries = array_combine($indexone, $indextwo);
    foreach ($countries as $index1=>$index2){


        $soru=  implode((array_slice ($a, $index1+1,$index2-$index1)))."<br>" ;
       array_push($questionList,$soru);
    }
    return $questionList;
}


//print_r(question()) ;


$questionArray=question();
$A=A();
$B=B();
$C=C();
$D=D();
$E=E();

for($i=0;$i<count($questionArray);$i++){
    $examId="475";
    echo $questionArray[$i]."<br>";
    echo $A[$i]."<br>";
    echo $B[$i]."<br>";
    echo $C[$i]."<br>";
    echo $D[$i]."<br>";
    echo $E[$i]."<br> <br>";
  /*  try {
        $insert=$multipleSql->execute(array($examId,$questionArray[$i],$A[$i],$B[$i],$C[$i],$D[$i],$E[$i]));
        if($insert){
            header('Location: index.php?radioValue=475');
        }
    }catch (Exception $e){
        echo $e->getMessage();
    }*/

}
