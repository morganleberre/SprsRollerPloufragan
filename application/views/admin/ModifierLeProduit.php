<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class='container'>
<div class='form-group'>
    <?php
    echo form_open('Admin/ModifierUnProduit/'.$LeProduit['NOPRODUIT']);
    
    echo form_label('Nom du produit','LblLibelle');

    echo form_input(array('name'=>'txtLibelle','required'=>'required','value'=>"".$LeProduit['LIBELLE']."",'pattern'=>'[a-zA-Z0-9\s]+','title'=>'le nom du produit doit commencer par une lettre','class'=>'form-control'));
    
    echo form_label('Détail du produit','Lbldetail');

    echo form_textarea(array('name'=>'txtDetail','value'=>"".$LeProduit['DETAIL']."",'required'=>'required','pattern'=>'[a-zA-Z0-9]+','title'=>'le Detail du produit doit commence par une lettre','class'=>'form-control'));
    
    echo form_label('PrixHT', 'LblPrixht');

    echo form_input(array('name'=>'txtPrixHT','value'=>"".$LeProduit['PRIXHT']."",'required'=>'required','pattern'=>'.{0,}','title'=>'Le Prix ht doit etre uniquement composer de chiffre','class'=>'form-control')).'<BR>';
    
    echo form_label('NomImage', 'Lblimage');

    echo form_input(array('name'=>'txtImage','type'=>'file'));

    echo form_label('Quantité Enstock', 'LblQuantitestock');
    
    echo form_input(array('name'=>'txtQuantiteenstock', 'value'=>"".$LeProduit['QUANTITEENSTOCK']."",'required'=>'required','pattern'=>'.{0,}','title'=>'la quantité en stock doit etre uniquement composer de chiffre','class'=>'form-control'));
  
    echo form_label('DateAjout', 'LblDateajoute').'<BR>';

    echo form_input(array('name'=>'txtDateAjout', 'value'=>"".$LeProduit['DATEAJOUT']."",'required'=>'required','type'=>'date','class'=>'clearBtn')).'<BR>';
    
    echo form_label('Disponibilité', 'LblDisponibilité').'<BR>';

    $liste=array(
        '1'=> 'VRAI',
        '0'=> 'FAUX'
           );
    echo form_dropdown('txtDispo',$liste, 'default',array('required'=>'required','class'=>'form-control')).'<BR>';

    echo form_label('LesCategorie', 'LblCategorie');
 echo "<select name='txtNoCategorie' class='form-control' id='id' required>";
    foreach ($LesCategorie as $uneCategorie) {
        echo "<option value='". $uneCategorie['NOCATEGORIE'] . "'>" . $uneCategorie['LIBELLE'] . "</option>";
    }
echo "</select><br/>";

    echo form_submit('BtnModifier', ' modifier Le Produit',array('class'=>"btn btn-primary"));

    echo form_close();    
    ?>
</div> 
</div>   
</body>
</html>