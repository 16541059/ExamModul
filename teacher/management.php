<?php include "../teacher/connect.php"?>
<?php   $examSql=$conn->prepare("SELECT DISTINCT examTable.examId,examName FROM examTable JOIN answerTable ON examTable.examId = answerTable.examId");
$examSql->execute();
$examSort= $examSql->fetchAll();
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
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
        <?php foreach ($examSort as $row): ?>
        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header"><?php echo $row["examId"]?></div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row["examName"]?></h5>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="stutakexam.php" method="post">
                                <p class="card-text"> <button class="btn btn-success" name="examid" type="submit" value="<?php echo $row["examId"]?>" >Cevapları Gör</button> </p>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form action="studentPoint.php" method="post">
                                <button class="btn btn-info" name="examid" type="submit" value="<?php echo $row["examId"]?>" >Puanları Gör</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
