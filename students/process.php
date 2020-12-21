<?php include '../teacher/connect.php';?>
 <?php
$query = $conn->prepare("INSERT INTO answerTable SET
studentNo = ?,
examId= ?,
questionIndex= ?,studentAnswer= ?,point= ?");
?>

<?php
if(isset($_POST["radioValue"])){

    class addMultiple{
        public $studentNo;
        public $examId;
        public $questionIndex;
        public $studentAnswer;
        public $point;

        public function __construct()
        {
            $this->studentNo=16541059;
            $this->examId=$_POST["examId"];
            $this->questionIndex=$_POST["index"];
            $this->studentAnswer = $_POST["radioValue"];
            $this->point=$_POST["point"];


        }
    }

    $addMultiple = new addMultiple();


    try {
        $insert=$query->execute(array($addMultiple->studentNo,$addMultiple->examId,$addMultiple->questionIndex,
            $addMultiple->studentAnswer,$addMultiple->point));

    }catch (Exception $e){
        echo $e->getMessage();
    }

}
// Add Gapfilling
if(isset($_POST["openValue"])){

 class addGap{
  public $studentNo;
  public $examId;
  public $questionIndex;
  public $studentAnswer;
  public $point;

  public function __construct()
  {
   $this->studentNo=16541059;
   $this->examId=$_POST["examId"];
   $this->questionIndex=$_POST["index"];
   $this->studentAnswer = $_POST["openValue"];
   $this->point=$_POST["point"];


  }
 }

 $addGap = new addGap();

 echo $addGap->examId;

 try {
  $insert=$query->execute(array($addGap->studentNo,$addGap->examId,$addGap->questionIndex,
      $addGap->studentAnswer,$addGap->point));

 }catch (Exception $e){
  echo $e->getMessage();
 }

}
