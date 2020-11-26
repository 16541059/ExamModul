<?php include 'connect.php'?>
<?php require '../vendor/autoload.php';?>

<?php


$query = $conn->prepare("INSERT INTO examTable SET
examId = ?,
startTime= ?,
endTime= ?,examName= ?,maxMark= ?,maxEntry= ?,maxTime= ?,activation= ?");
$multipleSql = $conn->prepare("INSERT INTO questionTable SET examId=?, question= ?, 	trueQuestion= ?,
falseQuestion1=? ,falseQuestion2= ?,falseQuestion3= ?,falseQuestion4= ? ");
$trueFalseSql = $conn->prepare("INSERT INTO questionTable SET examId=?, question= ?, trueFalse=? ")
?>
<?php
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
    class saveMultiple{
        public $examid;
        public $question;
        public $trueQuestion;
        public $falseQuestion1;
        public $falseQuestion2;
        public $falseQuestion3;
        public $falseQuestion4;
        public function __construct()
        {
            $this->examid=$_POST["examid"];
            $this->question=$_POST["question"];
            $this->trueQuestion=$_POST["trueQuestion"];
            $this->falseQuestion1=$_POST["falseQuestion1"];
            $this->falseQuestion2=$_POST["falseQuestion2"];
            $this->falseQuestion3=$_POST["falseQuestion3"];
            $this->falseQuestion4=$_POST["falseQuestion4"];
        }
        public function test() {
            get_object_vars($this);
        }
    }
    $saveMultipleClass= new saveMultiple();
 try {
        $insert=$multipleSql->execute(array($saveMultipleClass->examid,$saveMultipleClass->question,$saveMultipleClass->trueQuestion,
            $saveMultipleClass->falseQuestion1,$saveMultipleClass->falseQuestion2,$saveMultipleClass->falseQuestion3,$saveMultipleClass->falseQuestion4));
        if($insert){
            header('Location: index.php?radioValue='.$saveMultipleClass->examid);
        }
    }catch (Exception $e){
        echo $e->getMessage();
    }

}

// Add True/False Question
if(isset($_POST["addTrueFalse"])){
    class saveTrueFalse{
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
    echo $saveTrueFalseClass->examid;
    echo $saveTrueFalseClass->question;
    echo $saveTrueFalseClass->trueAnswer;
    try {
        $insert=$trueFalseSql->execute(array($saveTrueFalseClass->examid,$saveTrueFalseClass->question,$saveTrueFalseClass->trueAnswer));
        if($insert){
            header('Location: index.php?radioValue='.$saveTrueFalseClass->examid);
        }
    }catch (Exception $e){
        echo $e->getMessage();
    }

}
?>
