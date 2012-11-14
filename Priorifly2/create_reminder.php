<?php
    session_start();
	include 'top_boilerplate.html';
?>

<div data-role="page" id="create_page">
	<div data-role="header" class="home_header">
		<h1>Create Reminder</h1>
	</div><!-- /header -->

	<div data-role="content">
<?php
    $var = $_SESSION['user_id'];
    $test = $_SESSION['test'];
    //echo "<p>TEST: ".$test."</p>";
    //echo "<p>Session ID: ".$var."</p>";
    ?>

		<form action="pfReminderSubmit.php" method="post" id="create_form" class="validate">
			<div data-role="fieldcontain" id="create_title">
    			<label for="title">Name</label>
   				<input type="text" name="name" class="required" value=""  />
			</div>
            <div data-role="fieldcontain">
                <label for="textarea">Description</label>
                <textarea name="description" id="textarea"></textarea>
            </div>
			<a href="#cancelpage" data-role="button" data-rel="dialog" id="login_show_btn">Cancel</a><div data-role="popup" id="cancelpopup"></div>
			<input type="submit" value="Save" id="save_btn">	
		</form>
		
		
	</div><!-- /content -->
	
	<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
	</div>

<script type="text/javascript">

$('#create_page').live('pageinit',function(event) {
                       
                       $("#create_form").submit(function() {
                                                
                                                // get a collection of all empty fields
                                                var emptyFields = $(":input.required").filter(function() {
                                                                                              
                                                                                              // $.trim to prevent whitespace-only values being counted as 'filled'
                                                                                              return !$.trim(this.value).length;
                                                                                              });
                                                
                                                // if there are one or more empty fields
                                                if(emptyFields.length) {
                                                
                                                // do stuff; return false prevents submission
                                                emptyFields.css("border", "1px solid red");
                                                alert("You must fill all fields!");
                                                return false;
                                                }
                                                });
                       
                       });
</script>

</div>

<div data-role="page" id="cancelpage" data-title="Are you sure you want to cancel?">
<div data-role="header" class="home_header">
<h1>Cancel</h1>
</div><!-- /header -->
<h3>Are you sure you want to leave this page? Any changes you have made to this page will not be saved.</h3>
<div data-role="content">
<a href="reminders.php" data-role="button">Leave</a>
<a href="#create_page" data-role="button">Stay on this page</a>

<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
</div>
</div>
<?php
	include 'bottom_boilerplate.html';
    ?>