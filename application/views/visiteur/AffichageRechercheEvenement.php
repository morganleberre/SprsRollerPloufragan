<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo css_url('Table')?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr>
 <th> Nom evenement </th>
 <th> Image de L'evenement </th>
 <th> date Evenement </th>
</tr>
</thead>
<tbody>
<?php foreach ($RechercheEvenement as $unEvenement) :
echo'<tr>
    <td>'. $unEvenement->NOMEVENEMENT.'</td>
     <td>'.anchor('Visiteur/DetailEvenement/'.$unEvenement->NOEVENEMENT,'<img width="50%" class="img-thumbnail" src="'.img_url($unEvenement->NOMIMAGE).'">').'</td>
     <td>'.$unEvenement->DATEEVENEMENT.'</td>
     </tr>';
 endforeach ?>
</tbody>
</table>
</div>
<p> pour voir l'article cliquez sur Image </p>
<p><?php echo $LiensPagination?></p>
</div>
</body>
</html>