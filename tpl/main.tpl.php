<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>IMGhost</title>
    <link rel="stylesheet" href="{{@BASE}}/media/css/style.css" type="text/css" />
    
    <script type="text/javascript" src="{{@BASE}}/media/js/jquery.js"></script>
    <script txpe="text/javascript">
        jQuery(document).ready(function() {
			$('input[type=file]').each(function(){
				var uploadbutton = '<input type="button" class="button_button" value="Upload" />';
				$(this).wrap('<div class="fileinputs"></div>');
				$(this).addClass('file').css('opacity', 0);
				$(this).parent().append($('<div class="fakefile" />').append($('<input type="text" />').attr('id',$(this).attr('id')+'__fake')));			

				$(this).bind('change', function() {
					var path = $(this).val();
					var filename = path.split("\\");
					var strlen = filename.length;
					$('#'+$(this).attr('id')+'__fake').val(filename[strlen-1]);
				});
				
				$(this).bind('mouseout', function() {
					var filename = $(this).val().split("\\");
					var strlen = filename.length;
					$('#'+$(this).attr('id')+'__fake').val(filename[strlen-1]);
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

<div class="footer">
    <ul>
        <li><a href="{{@BASE}}/login">Login</a></li>
        <li><a href="{{@BASE}}/register">Register</a></li>
    </ul>
</div>

</body>
</html>
