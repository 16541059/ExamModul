<?php include 'connect.php'?>
<?php require '../vendor/autoload.php';?>

<?php


$query = $conn->prepare("INSERT INTO examTable SET
examId = ?,
startTime= ?,
endTime= ?,examName= ?,maxMark= ?,maxEntry= ?,maxTime= ?,activation= ?");

$multipleSql = $conn->prepare("INSERT INTO questionTable SET examId=?, question= ?, 	trueQuestion= ?,
falseQuestion1=? ,falseQuestion2= ?,falseQuestion3= ?,falseQuestion4= ?,image=? ");
$trueFalseSql = $conn->prepare("INSERT INTO questionTable SET examId=?, question= ?, trueFalse=?,image=? ");
$gapFillingSql = $conn->prepare("INSERT INTO questionTable SET examId=?, question= ?, answer=?,image=? ");
$openClozeSql = $conn->prepare("INSERT INTO questionTable SET examId=?, question= ?,image=? ");

?>
<?php

 class main{
     public function addimage(){

         @$tmp_name=$_FILES["file"]["tmp_name"];
         @$name=$_FILES["file"]["name"];
         $benzersizad=uniqid();
         (move_uploaded_file(@$tmp_name,"/var/www/html/php/teacher/image/" . $benzersizad.".png"));
         return "../teacher/image/" . $benzersizad.".png";

     }

}
//Exam Add Part
if(isset($_POST["addExam"])){

class Exam{
public $examCode;
public $examStartTime;
public $examEndTime;
public $examName;
public $examMark;
public $examEntry;
public $examTime;
public $examStatus;
    public function __construct()
    {
        $this->examCode=$_POST["examCode"];
        $this->examStartTime=$_POST["examStartTime"];
        $this->examEndTime=$_POST["examEndTime"];
        $this->examName=$_POST["examName"];
        $this->examMark=$_POST["examMark"];
        $this->examEntry=$_POST["examEntry"];
        $this->examTime=$_POST["examTime"];
        $this->examStatus=$_POST["examStatus"];
    }
}

$ExamClass = new Exam();

    try {
        $insert=$query->execute(array($ExamClass->examCode,$ExamClass->examStartTime,$ExamClass->examEndTime,$ExamClass->examName,$ExamClass->examMark,
            $ExamClass->examEntry,$ExamClass->examTime,$ExamClass->examStatus));
        if($insert){
            header('Location: index.php');
        }

    }catch (Exception $e){
        echo $e->getMessage();
    }



}
if($_POST["id"]){
    $query =$conn->prepare("DELETE FROM examTable WHERE examId= :id");
    $delete=$query->execute(array(
        "id"=>$_POST['id']
    ));

}

//MulitpleChoice Add Question
if(isset($_POST["saveQuestionMultiple"])){
    class saveMultiple extends main {
        public $examid;
        public $question;
        public $trueQuestion;
        public $falseQuestion1;
        public $falseQuestion2;
        public $falseQuestion3;
        public $falseQuestion4;
        public $image;
        public function __construct()
        {
            $this->examid=$_POST["examid"];
            $this->question=$_POST["question"];
            $this->trueQuestion=$_POST["trueQuestion"];
            $this->falseQuestion1=$_POST["falseQuestion1"];
            $this->falseQuestion2=$_POST["falseQuestion2"];
            $this->falseQuestion3=$_POST["falseQuestion3"];
            $this->falseQuestion4=$_POST["falseQuestion4"];
            $this->image=$_FILES["image"]["name"];
        }


    }
    $saveMultipleClass= new saveMultiple();

 try {
        $insert=$multipleSql->execute(array($saveMultipleClass->examid,$saveMultipleClass->question,$saveMultipleClass->trueQuestion,
            $saveMultipleClass->falseQuestion1,$saveMultipleClass->falseQuestion2,$saveMultipleClass->falseQuestion3,$saveMultipleClass->falseQuestion4,$saveMultipleClass->addimage()));
        if($insert){
            header('Location: index.php?radioValue='.$saveMultipleClass->examid);
        }
    }catch (Exception $e){
        echo $e->getMessage();
    }

}

// Add True/False Question
if(isset($_POST["addTrueFalse"])){
    class saveTrueFalse extends main {
        public $examid;
        public $question;
        public $trueAnswer;

        public function __construct()
        {
            $this->examid=$_POST["examid"];
            $this->question=$_POST["question"];
            $this->trueAnswer=$_POST["trueAnswer"];
        }

    }
    $saveTrueFalseClass= new saveTrueFalse();


   try {
        $insert=$trueFalseSql->execute(array($saveTrueFalseClass->examid,$saveTrueFalseClass->question,$saveTrueFalseClass->trueAnswer,$saveTrueFalseClass->addimage()));
        if($insert){
            header('Location: index.php?radioValue='.$saveTrueFalseClass->examid);
        }
    }catch (Exception $e){
        echo $e->getMessage();
    }

}
if(isset($_POST["addGapFilling"])){
    class saveGapFilling extends main {
        public $examid;
        public $question;
        public $answer;

        public function __construct()
        {
            $this->examid=$_POST["examid"];
            $this->question=$_POST["question"];
            $this->answer=$_POST["answer"];
        }

    }
    $saveGapFillingClass= new saveGapFilling();

    try {
        $insert=$gapFillingSql->execute(array($saveGapFillingClass->examid,$saveGapFillingClass->question,$saveGapFillingClass->answer,$saveGapFillingClass->addimage()));
        if($insert){
            header('Location: index.php?radioValue='.$saveGapFillingClass->examid);
        }
    }catch (Exception $e){
        echo $e->getMessage();
    }

}
// add Open Cloze
if(isset($_POST["addOpenCloze"])){
    class saveOpenCloze extends main {
        public $examid;
        public $question;


        public function __construct()
        {
            $this->examid=$_POST["examid"];
            $this->question=$_POST["question"];

        }

    }
    $saveOpenClozeClass= new saveOpenCloze();

    try {
        $insert=$openClozeSql->execute(array($saveOpenClozeClass->examid,$saveOpenClozeClass->question,$saveOpenClozeClass->addimage()));
        if($insert){
            header('Location: index.php?radioValue='.$saveOpenClozeClass->examid);
        }
    }catch (Exception $e){
        echo $e->getMessage();
    }

}

//Remove Question
if(isset($_POST["questionid"])){
    $imgdstry =$conn->prepare("SELECT image FROM questionTable WHERE İndex=:id");
    $imgdstry->execute(array(
        "id"=>$_POST['questionid']
    ));
    $imgdstryid= $imgdstry->fetchAll();
    unlink($imgdstryid[0]["image"]);
    $query =$conn->prepare("DELETE FROM questionTable WHERE İndex= :id");
    $delete=$query->execute(array(
        "id"=>$_POST['questionid']
    ));



}



?>


