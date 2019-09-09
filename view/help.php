<?php include 'components/header.php'; ?>
<script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script>
<body>
	<div id="main">
		<h1>Add or Remove text boxes with jQuery</h1>
		<div class="my-form">
			<form role="form" action="" method="post">
				<p class="text-box">
					<label for="box1">Box <span class="box-number">1</span></label>
           <input type="text" name="boxes[]" value="" id="box1" />
            <a class="add-box" href="#">Add More</a>
				</p>
				<p>
					<button type="submit" name="upload" >Submit</button>
				</p>
			</form>
      <?php 
      if(isset($_POST['upload']))
      {
        global $database;
        $sql  = array();

        foreach ($data as $row) {
          $sql[] = '("' .mysql_real_escape_string($row['boxes']). '")';
        }


        // $esc_val = array_map('mysql_real_escape_string', array_values($n));
        // $val = implode(", ", $esc_val);

        $database->exec("INSERT INTO sample (s_name) VALUES ('".implode(',', $sql)."')");
        echo implode(',',$n);
      }
      ?>
		</div>
	</div>
	<script type="text/javascript">
jQuery(document).ready(function($){
    $('.my-form .add-box').click(function(){
        var n = $('.text-box').length + 1;
        if( 5 < n ) {
            alert('Stop it!');
            return false;
        }
        var box_html = $('<p class="text-box"><label for="box' + n
                + '">Box <span class="box-number">' + n +
                '</span></label> <input type="text" name="boxes[]" value="" id="box' + n + '" /> <a href="#" class="remove-box">Remove</a></p>');
        box_html.hide();
        $('.my-form p.text-box:last').after(box_html);
        box_html.fadeIn('slow');
        return false;
    });
    $('.my-form').on('click', '.remove-box', function(){
        $(this).parent().css( 'background-color', '#FF6C6C' );
        $(this).parent().fadeOut("slow", function() {
            $(this).remove();
            $('.box-number').each(function(index){
                $(this).text( index + 1 );
            });
        });
        return false;
    });
});
</script>
</body>
</html>

<html>
<head>
<title>jQuery add / remove textbox example</title>

<script type="text/javascript" src="jquery-1.3.2.min.js"></script>

<style type="text/css">
div {
	padding: 8px;
}
</style>

</head>

<body>

	<h1>jQuery add / remove textbox example</h1>

	<script type="text/javascript">

$(document).ready(function(){

    var counter = 2;

    $("#addButton").click(function () {

	if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
	}

	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);

	newTextBoxDiv.after().html('<label>Textbox #'+ counter + ' : </label>' +
	      '<input type="text" name="textbox' + counter +
	      '" id="textbox' + counter + '" value="" >');

	newTextBoxDiv.appendTo("#TextBoxesGroup");


	counter++;
     });

     $("#removeButton").click(function () {
	if(counter==1){
          alert("No more textbox to remove");
          return false;
       }

	counter--;

        $("#TextBoxDiv" + counter).remove();

     });

     $("#getButtonValue").click(function () {

	var msg = '';
	for(i=1; i<counter; i++){
   	  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
	}
    	  alert(msg);
     });
  });
</script>


</head>
<body>

	<div id='TextBoxesGroup'>
		<div id="TextBoxDiv1">
			<label>Textbox #1 : </label><input type='textbox' id='textbox1'>

		</div>
	</div>
	<input type='button' value='Add Button' id='addButton'>
	<input type='button' value='Remove Button' id='removeButton'>
	<input type='button' value='Get TextBox Value' id='getButtonValue'>
</body>
</html>
