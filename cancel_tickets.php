<?php
ob_start();
include('login.php');
include('signup.php');
ob_end_clean();

$db=mysqli_connect("localhost","avantika","avantika","db1") or doe("cannot connect to the server");
$PNR=$_POST['PNR'];
if(isset($_POST['cancel_tickets'])){
 // mysqli_query($db,"CALL updateValue('$PNR')");
 $PNR=$_POST['PNR'];
          if($sql=mysqli_query($db,"SELECT * from passenger where p_id='$PNR'")){
            while($row=mysqli_fetch_assoc($sql)){
              $PNR=$row['p_id'];
              $USER=$row['u_id'];
              $TICKET=$row['t_id'];
              $SOURCE=$row['source'];
              $DESTINATION=$row['destination'];
			  $TRAIN=$row['t_no'];
			  $TYPE=$row['type'];
			  mysqli_query($db,"update passenger set status='canceled' where p_id='$PNR' ");
			  if($TYPE=='AC_fare'){
				mysqli_query($db,"update train_status set A_seat=A_seat+1 where t_no='$TRAIN' ");
			  }else{
				mysqli_query($db,"update train_status set B_seat=B_seat+1 where t_no='$TRAIN' ");
			  }
			  echo '<script type="text/javascript">alert("canceled");</script>';			
			}
          }else {
            printf("PNR NOT FOUND");
          }
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>cancel tickets</title>
	<script type="text/javascript">
	function validate()	{
		var EmailId=document.getElementById("email");
		var atpos = EmailId.value.indexOf("@");
    	var dotpos = EmailId.value.lastIndexOf(".");
		var pw=document.getElementById("pw");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=EmailId.value.length) 
		{
        	alert("Enter valid email-ID");
			EmailId.focus();
        	return false;
   		}
   		if(pw.value.length< 8)
		{
			alert("Password consists of atleast 8 characters");
			pw.focus();
			return false;
		}
		return true;
	}
</script>
<style type="text/css">
	#loginarea{
		background-color: white;
		width: 30%;
		margin: auto;
		border-radius: 25px;
		border: 2px solid blue;
		margin-top: 100px;
		background-color: rgba(0,0,0,0.2);
	    box-shadow: inset -2px -2px rgba(0,0,0,0.5);
	    padding: 40px;
	    font-family:sans-serif;
		font-size: 20px;
		color: white;
	}
	html { 
		background: url(img/bg4.jpg) no-repeat center center fixed; 
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	#submit	{
		border-radius: 5px;
		background-color: rgba(0,0,0,0);
		padding: 7px 7px 7px 7px;
		box-shadow: inset -1px -1px rgba(0,0,0,0.5);
		font-family:"Comic Sans MS", cursive, sans-serif;
		font-size: 17px;
		margin:auto;
		margin-top: 20px;
  		display:block;
  		color: white;
	}
	#logintext	{
		text-align: center;
	}
	.data	{
		color: white;
	}
	button,a{
    text-decoration:none;
    padding:7px;
    margin:5px;
    background-color:DodgerBlue;
    box-shadow: inset -1px -1px rgba(0,0,0,0.5);
		font-family:"Comic Sans MS", cursive, sans-serif;
		font-size: 17px;
		margin:auto;
		margin-top: 20px;
  		display:block;
      color: white;
	  width:400px;
	  text-align:center;
  }
  a:hover{
   background-color:green;
 }
 button:hover{
  background-color:red;
  cursor:pointer;
 }
</style>
  </head>
  <body>

	<div id="loginarea">
	<form class="" action="cancel_tickets.php" method="post">
	<div id="logintext">Cancel Tickets</div><br/><br/>
	<table>
	  <tr><td><label for="PNR">PNR</label>
    <input type="text" name="PNR" value="" required><br></td></tr>
		<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
		<tr><td><label for="ticket_id">Ticket ID</label>
    <input type="text" name="ticket_id" value="" required><br></td></tr>
		<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
	</table>
	<button type="submit" name="cancel_tickets">SUBMIT</button>
    </form>

    <a href="user_homepage.php">go back</a><br>
    <a href="logout.php">logout</a><br>
  </body>
</html>
