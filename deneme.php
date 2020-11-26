<?php require 'vendor/autoload.php';?>
<?php use Respect\Validation\Validator as v; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>dd</h1>
<?php
$number = 123;
$deneme= v::numericVal()->validate($number); // true
if($deneme){
    echo "Başarılı";
}
?>
<script>

</script>
</body>
</html>

