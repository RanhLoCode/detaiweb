<?php
include 'database/cnt.php';
?>
<!DOCTYPE html>

<html lang="vi" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="css/reset.css" rel="stylesheet" />
<script src="js/jquery.min.js"></script>

<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" href="bootstrap/bootstrap-datetimepicker.min.css">
<script src="bootstrap/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/myNormal.css">
<?php
if (isset($refs)) {
    foreach($refs as $ref) {
        echo "<link rel='stylesheet' href='$ref'>";
    }
}
?>
<title><?php echo $title;?></title>
</head>

<body>