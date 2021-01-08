<?php include '../teacher/connect.php';?>
 <?php
$query = $conn->prepare("INSERT INTO answerTable SET
studentNo = ?,
studentName=?,
examId= ?,
questionIndex= ?,studentAnswer= ?");
?>

<?php
$name="Ali Yıldırım";
$no=16541056;
if(isset($_POST["radioValue"])){

    class addMultiple{
        public $studentNo;
        public  $studentName;
        public $examId;
        public $questionIndex;
        public $studentAnswer;


        public function __construct()
        {
         global $no;
         global $name;
            $this->studentNo= $no;
            $this->studentName=$name;
            $this->examId=$_POST["examId"];
            $this->questionIndex=$_POST["index"];
            $this->studentAnswer = $_POST["radioValue"];



        }
    }

    $addMultiple = new addMultiple();


    try {
        $insert=$query->execute(array($addMultiple->studentNo,$addMultiple->studentName,$addMultiple->examId,$addMultiple->questionIndex,
            $addMultiple->studentAnswer));

    }catch (Exception $e){
        echo $e->getMessage();
    }

}
// Add Gapfilling
if(isset($_POST["openValue"])){

 class openValue{
  public $studentNo;
  public  $studentName;
  public $examId;
  public $questionIndex;
  public $studentAnswer;

  public function __construct()
  {
   global $no;
   global $name;
   $this->studentNo=$no;
   $this->studentName=$name;
   $this->examId=$_POST["examId"];
   $this->questionIndex=$_POST["index"];
   $this->studentAnswer = $_POST["openValue"];



  }
 }

 $addGap = new openValue();

 echo $addGap->examId;

 try {
  $insert=$query->execute(array($addGap->studentNo,$addGap->studentName,$addGap->examId,$addGap->questionIndex,
      $addGap->studentAnswer));

 }catch (Exception $e){
  echo $e->getMessage();
 }

}
if(isset($_POST["gapValue"])){

 class addGap{
  public $studentNo;
  public  $studentName;
  public $examId;
  public $questionIndex;
  public $studentAnswer;

  public function __construct()
  {
   global $no;
   global $name;
   $this->studentNo=$no;
   $this->studentName=$name;
   $this->examId=$_POST["examId"];
   $this->questionIndex=$_POST["index"];
   $this->studentAnswer = $_POST["gapValue"];



  }
 }

 $addGap = new addGap();

 echo $addGap->examId;

 try {
  $insert=$query->execute(array($addGap->studentNo,$addGap->studentName,$addGap->examId,$addGap->questionIndex,
      $addGap->studentAnswer));

 }catch (Exception $e){
  echo $e->getMessage();
 }

}
