
<?php

$oula = "<script>alert('oula')</script>yooo";

$mhh = "lucas@gmail.com<script>alert(document.cookie)</script>";



$htmlspecialchars = filter_input(INPUT_POST,$oula,FILTER_SANITIZE_SPECIAL_CHARS);
$a = htmlspecialchars($mhh);

print_r($htmlspecialchars);
echo "<br>";
print_r($a);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>