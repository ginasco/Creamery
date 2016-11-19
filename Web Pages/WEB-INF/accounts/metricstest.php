<!-- default styles -->
   <link rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../accounts/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
   
<script src="../../imports/libs/jquery/js/jquery.min.js"></script>

<body>


<form>
    
    <input id="star1" value="0" type="number" class="rating" min=0 max=5 step=0.5 data-size="sm">
    <hr>
    
 
</form>
<hr>
<script>
    jQuery(document).ready(function () {
        $("#input-21f").rating({
            starCaptions: function(val) {
                if (val < 3) {
                    return val;
                } else {
                    return 'high';
                }
            },
            starCaptionClasses: function(val) {
                if (val < 3) {
                    return 'label label-danger';
                } else {
                    return 'label label-success';
                }
            },
            hoverOnClear: false
        });
        
        $('#rating-input').rating({
              min: 0,
              max: 5,
              step: 1,
              size: 'lg',
              showClear: false
           });
           
        $('#btn-rating-input').on('click', function() {
            $('#rating-input').rating('refresh', {
                showClear:true, 
                disabled: !$('#rating-input').attr('disabled')
            });
        });
        
        
        $('.btn-danger').on('click', function() {
            $("#kartik").rating('destroy');
        });
        
        $('.btn-success').on('click', function() {
            $("#kartik").rating('create');
        });
        
        $('#rating-input').on('rating.change', function() {
            alert($('#rating-input').val());
        });
        
        
        $('.rb-rating').rating({'showCaption':true, 'stars':'3', 'min':'0', 'max':'3', 'step':'1', 'size':'xs', 'starCaptions': {0:'status:nix', 1:'status:wackelt', 2:'status:geht', 3:'status:laeuft'}});
    });
</script>
 
    <script src="../accounts/js/star-rating.js" type="text/javascript"></script>
</div>  
</body>
</html>
