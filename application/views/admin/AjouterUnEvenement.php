<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class='container'>
    <div class='form-group'>
  <?php
   echo form_open('url', '', $hidden);
 
   echo form_label('Nomevenement','lblnomevenement');
   
   echo form_input(array('name'=>'txtNomEvenement','class'=>'form-control','value'=>'','pattern'=>'[a-zA-Z0-9]+','title'=>'le nom de L evenement doit commencer par une lettre'));

   echo form_label('detailevenement','lbldetailevenement');

   echo form_textarea(array('name'=>'txtDetail', 'value'=>'', 'class'=>'form-control','pattern'=>'[a-zA-Z0-9]+','title'=>'le Detail de L evenement doit commencer par une lettre'));
    
   echo  form_label('Image', 'lblNomimage');

   echo form_input(array('type'=>'file','name'=>'txtImage', 'value'=>''));

   echo  form_label('Image', 'lblNomimage');

   echo form_input(array('name', 'value', $attributes));
   

   
   
   ?>
    </div>
    </div>
</body>
</html>