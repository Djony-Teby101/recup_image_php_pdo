<?php
   require('logic/config.php');

   if(!isset($_SESSION['auth'])){
    header('location: index.php');
}

   $_SESSION['auth']['name'];
   $getid = $_SESSION['auth']['id'];

$select_profile = $dbb->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$getid]);
$fetch_profile = $select_profile->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<style>
    img{
        border: 2px solid #9e9e9e63;
        border-radius: 40px;
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
</head>
<body>
<img src="uploads/<?= $fetch_profile['image']; ?>" width="300" height="300">
<p><?= $fetch_profile['name'] ?></p>
<button><a href="logic/logout.php?id<?=$getid?>">deconnexion</a></button>
</body>
</html>