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
<div class='container'>
<div class="table-responsive">
<table class="table table-hover">
<?php foreach($LesCategories as $Unecategorie):
echo '<tr>
  <td>'.anchor('Visiteur/AfficheProduitcatego/'.$Unecategorie['NOCATEGORIE'],$Unecategorie['LIBELLE']).'</td>'; 
endforeach?>
</tbody>
</table>
</div>
</body>
</html>