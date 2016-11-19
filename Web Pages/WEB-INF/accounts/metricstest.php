<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Krajee JQuery Plugins - &copy; Kartik</title>
    <link rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../accounts/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="../accounts/js/star-rating.js" type="text/javascript"></script>
<body>



<form>
    <input id="rating" value="4" type="number" class="rating" min=0 max=5 step=0.2 data-size="lg">
    <hr>
  
 
 
<hr>
<script>
    jQuery(document).ready(function () {
        $("#rating").rating({
            starCaptions: function(val) {
                if (val < 3) {
                    return val;
                } else {
                    return 'high';
                }
            },
        
            hoverOnClear: false
        });
        
 
 
        
        
 
        

        $('#rating').rating('update',3);
        
     
    });
</script>
</div>  
</body>
</html>
