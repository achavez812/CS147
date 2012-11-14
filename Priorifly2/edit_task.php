<?php
	session_start();
    include 'top_boilerplate.html';
    ?>

<div data-role="page" id="create_page">
<div data-role="header" class="home_header">
<h1>Edit Task</h1>
</div><!-- /header -->

<div data-role="content">


<?php
    $var = $_SESSION['user_id'];
    $test = $_SESSION['test'];
    $Task_ID = $_GET['task_id'];
    
    include("pfConfig.php");
    $query = sprintf("SELECT * FROM Tasks WHERE Task_ID = '$Task_ID'");
    $result = mysql_query($query);
    $task = mysql_fetch_assoc($result);
    
    $name = $task["Name"];
    $description = $task["Notes"];
    $datetimeobj = new DateTime($task["Deadline"]);
    $deadline = date_format($datetimeobj, 'F d\, g:ia');
    //$deadline = 'Nov 10, 2012 7:40 AM';
    //$deadline = '2012-11-08 23:59:59';
    $rank = $task["Rank"];
    $progress = $task["Progress"];
    $time = $task["Total_Time"];
    ?>

<a href="#deletepage" data-role="button" data-rel="dialog" data-icon="delete" id="deletepopup">Delete</a><div data-role="popup" id="deletepopup"></div>


<form action="pfEditTaskSubmit.php" method="post" id="create_form" class="validate">
<div data-role="fieldcontain" id="create_title">
<label for="title">Name</label>
<?php echo "<input type='text' name='name' class='required' value='".$name."'/>";?>
</div>
<div data-role="fieldcontain">
<label for="textarea">Description</label>
<?php echo "<textarea name='description' id='textarea'>".$description."</textarea>";?>
</div>
<div data-role="fieldcontain">
<label for="datetime">Deadline</label>
<?php echo "<input type='text' name='deadline' class='required' id='deadline' value='".$deadline."'>";?>
</div>
<div data-role="fieldcontain">
<label for="rank">Rank</label>
<?php echo "<input type='range' name='rank' class='required' id='rank' value='".$rank."' min='0' max='10' data-highlight='true' />";?>
<span class="slider_left">0</span>
<span class="slider_right">10</span>
</div>
<div data-role="fieldcontain">
<label for="progress">Progress</label>
<?php echo "<input type='range' name='progress' class='required' id='progress' value='".$progress."' min='0' max='100' data-highlight='true' />";?>
<span class="slider_left">0%</span>
<span class="slider_right">100%</span>
</div>
<div data-role="fieldcontain">
<label for="number">Time Estimate in Hours</label>
<?php echo "<input type='number' name='hours' class='required' id='number' value='".$time."'>";?>
</div>
<div data-role="fieldcontain">
<?php echo "<input type='hidden' name='task_id' value='".$Task_ID."'";?>
</div>


<a href="#cancelpage" data-role="button" data-rel="dialog" id="login_show_btn">Cancel</a><div data-role="popup" id="cancelpopup"></div>
<input type="submit" value="Save" id="save_btn">
</form>


</div><!-- /content -->

<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
</div>


<script type="text/javascript">

$('#create_page').live('pageinit',function(event) {
                       $(document).ready(function(){
                       $('#deadline').click(function() {
                                            $('#deadline').clone().attr('type', 'datetime').insertAfter('#deadline').prev().remove();
                                            });
                                         });
                       
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
                                               if(number.value  <= 0) {
                                             	alert("Not a valid time estimate!");
                                                return false;
                                                }
                                          });
                       
                       });
</script>
</div>
</div>

<div data-role="page" id="cancelpage" data-title="Are you sure you want to cancel?">
<div data-role="header" class="home_header">
<h1>Cancel</h1>
</div><!-- /header -->
<h3>Are you sure you want to leave this page? Any changes you have made to this page will not be saved.</h3>
<div data-role="content">
<a href="tasks.php" data-role="button">Leave</a>
<a href="#create_page" data-role="button">Stay on this page</a></div>
<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
</div></div>

<div data-role="page" id="deletepage" data-title="delete">
<div data-role="header" class="home_header">
<h1>Delete</h1>
</div><!-- /header -->
<h3>Are you sure you want to delete this task?</h3>
<div data-role="content">
<form action="pfRemoveTaskSubmit.php" method="post" id="delete_form">
<div data-role="fieldcontain">
<?php echo "<input type='hidden' name='task_id' value='".$Task_ID."'";?>
</div>
<input type="submit" value="Delete" id="delete_btn">
</form>
<a href="#create_page" data-role="button">Do Not Delete</a></div>

<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
</div></div>

<?php
	include 'bottom_boilerplate.html';
    ?>