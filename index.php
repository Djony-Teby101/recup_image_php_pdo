<?php require_once('logic/sendInfos.php') 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Save image</title>
</head>
<body>
<!-- <span  onclick="this.parentElement.remove();"><?=$error_msg ?></span> -->
<section class="form-container">

<form action="" method="post" enctype="multipart/form-data">
      <h3>Send user image</h3>
      <input type="text" required placeholder="tapez votre nom" class="box" name="name">
      <input type="file" name="image" required class="box" accept="image/jpg, image/png, image/jpeg">
      <input type="submit" value="Envoyez" class="btn" name="submit">
   </form>
</section>
</body>
</html>