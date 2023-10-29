<?php
require_once('logic/config.php');


if(isset($_POST)){
    if(!empty($_POST['name']) AND !empty($_FILES['image'] 
        AND !isset($_FILES['name']['error']))){
            

            // voir les extensions de fichier permis.
            $allowed=[
                "jpg"=>'image/jpeg',
                "jpeg"=>'image/jpeg',
                "png"=>'image/png'
            ];

            $name=strip_tags($_POST['name']);
            $filename=strip_tags($_FILES['image']['name']);
            $filetype=strip_tags($_FILES['image']['type']);
            $filesize=strip_tags($_FILES['image']['size']);
            $file_tmp_name=strip_tags($_FILES['image']['tmp_name']);
            $file_folder = 'uploads/'.$filename;

            $sql="SELECT*FROM users WHERE name=?";
            $checkUserExist=$dbb->prepare($sql);
            $checkUserExist->execute(array($name));

            // verifier si l'utilisateur existe.
            if(!$checkUserExist->rowCount()>0){
            // Si l'user n'existe pas deja.
                // récupere l'extension de l'image envoyer.
                $extension=strtolower(pathinfo($filename,PATHINFO_EXTENSION));

                // verifier si l'extension est permie.
                if(!array_key_exists($extension,$allowed) || !in_array($filetype,$allowed)){
                    echo('format de fichier incorrect');
                }
                if($filesize>2000000){
                   echo('fichier trop volumineux'); 
                }
                
                $sql="INSERT INTO users(name, image)VALUES(?,?)";
                    $insert=$dbb->prepare($sql);
                    $insert->execute(array($name, $filename));
                    var_dump("Enregistrement réussi !");
                
                if(!move_uploaded_file($file_tmp_name, $file_folder)){
                    echo("Erreur: lors de l'Enregistrement");
                }

                $userphotos=$dbb->prepare('SELECT*FROM users WHERE name=?');
                $userphotos->execute(array($name));
                $userInfos=$userphotos->fetch();

                $username=($userInfos['name']);
                $userpic=($userInfos['image']);

                $_SESSION['auth']=[
                    'id'=>$userInfos['id'],
                    'name'=>$username,
                ];

                header('location: view.php');


            }else{
                $error_msg=('Vous etes déja enregistrer !');
            }
    }else{
        $error_msg=('Veuillez completer tous les champs');
    }
}
?>