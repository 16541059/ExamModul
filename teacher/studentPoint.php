<?php include "../teacher/connect.php"?>
<?php if(isset($_POST["examid"]) ){

    $pointSql = $conn->prepare("SELECT * FROM studentPoint WHERE examId = :examId ");
    $pointSql->bindParam(":examId",$_POST["examid"]);
    $pointSql->execute();
    $pointSort = $pointSql->fetchAll();
}
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
    <title>Aldığı Notlar</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <span style="width: 100%;font-size: 20px" class="badge badge-warning"><?php echo "Sınav Kodu: ".$pointSort[0]["examId"]." "?></span>
            <?php if(empty($pointSort)):?>
            <h1 style="color:white" class="text-center">Kayıt Edilmiş Not Bulunmamaktadır</h1>

           <?php else: ?>
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Öğrenci Numarası</th>
                    <th scope="col">Öğrenci Adı</th>
                    <th scope="col">Aldığı Not</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pointSort as $row): ?>
                <tr>
                    <th scope="row"><?php echo  $i+=1?></th>
                    <td><?php echo $row["studentNo"] ?></td>
                    <td><?php echo $row["studentName"]?></td>
                    <td><?php echo $row["studentPoint"]?></td>
                </tr>
              <?php endforeach;?>

                </tbody>
            </table>

            <?php endif;?>
        </div>
    </div>
</div>
</body>
</html>