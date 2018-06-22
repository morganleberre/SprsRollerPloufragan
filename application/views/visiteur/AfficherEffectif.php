<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo css_url('Accueil')?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<section class="row">
    <?php foreach($LesJoueur as $Unjoueur):
    echo '<div class="col-xs-4 col-sm-3 col-md-2"> 
        <h3>'.$Unjoueur->NOM,$Unjoueur->PRENOM.'</h3>
       <img width="150%" class="img-rounded" person img-responsive" src="'.img_url($Unjoueur->IMAGEJOUEUR).'"> 
       </div>';
    endforeach?>
</section>
</body>
</html>