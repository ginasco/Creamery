<!DOCTYPE html>
<head runat="server">
<title>Test Zone</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="../Creamery/Web%20Pages/datepicker/css/datepicker.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="../Creamery/Web%20Pages/datepicker/Js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#pickyDate').datepicker({
            format: "dd/mm/yyyy"
        });
    });
</script>

<script type="text/javascript">
$(function(){
        $("#to").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#from").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
            minValue.setDate(minValue.getDate()+1);
            $("#to").datepicker( "option", "minDate", minValue );
        })
    });
</script>


<body>
<div id="testDIV">
    <div class="container">
        <div class="hero-unit">
            <input  type="text" placeholder="click to choose Starting Date"  id="from"/>
			   <input  type="text" placeholder="click to show "  id="to"/>
        </div>
    </div>
</div>


<form action="action_page.php">
  Birthday:
  <input type="date" name="bday">
  <input type="submit">
</form>




<?php
$date = "07/12/2010";
$your_date = date("Y-m-d", strtotime($date));
echo $your_date;
?>
</body>