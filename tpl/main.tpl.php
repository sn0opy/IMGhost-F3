<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>IMGhost</title>
    <link rel="stylesheet" href="{{@BASE}}/media/css/style.css" type="text/css" media="screen" />

    <script type="text/javascript" src="{{@BASE}}/media/js/jquery.js"></script>
    <script txpe="text/javascript">
        jQuery(document).ready(function() {
            $('input[type=file]').each(function(){

              var uploadbuttonlabeltext = $(this).attr('title'); //get title attribut for languagesettings
              if(uploadbuttonlabeltext == ''){
                var uploadbuttonlabeltext = 'BLARGH';
              }

              var uploadbutton = '<input type="button" class="button_button" value="'+uploadbuttonlabeltext+'" />';
               $(this).wrap('<div class="fileinputs"></div>');
                $(this).addClass('file').css('opacity', 0); //set to invisible
                $(this).parent().append($('<div class="fakefile" />').append($('<input type="text" />').attr('id',$(this).attr('id')+'__fake')));

                $(this).bind('change', function() {
                  $('#'+$(this).attr('id')+'__fake').val($(this).val());;
                });
                $(this).bind('mouseout', function() {
                  $('#'+$(this).attr('id')+'__fake').val($(this).val());;
                });
              });

            });
    </script>
</head>
<body>

<div class="topBar">
    <div class="header">
        <h1><a href="{{@BASE}}/">IMG<em>host</em><sup>F3</sup></a></h1>
    </div>
</div>

<div class="container">

<include href="{{@template}}" />

</div>
<!-- made with toothPaste by Sascha Ohms -->
</body>
</html>
