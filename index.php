<?php
session_start();
include('db.php');
if(isset($_POST['submit']))
		{
$hash=sha1(mt_rand(0, 500000000000));
        $term = mysql_real_escape_string($_POST['Term']);
		$examno = mysql_real_escape_string($_POST['ExamNumber']);
		$examsession = mysql_real_escape_string($_POST['Session']);

		$CardPin = mysql_real_escape_string($_POST['CardPin']);
				$CardSerial = mysql_real_escape_string($_POST['CardSerial']);
		$page="Result.php?rHasH=$hash";
		/* user */
			$query = "select * from card, tbl_students where card.CardPin='$CardPin' and card.CardSerial = '$CardSerial'  and tbl_students.ExamNumber='$examno' and tbl_students.Term='$term' and tbl_students.Session='$examsession'";
			$result = mysql_query($query)or die(mysql_error());
			$row = mysql_fetch_array($result);
			$num_row = mysql_num_rows($result);
		if( $num_row > 0 ) { 
		$_SESSION['id']=$row['sid'];
	
		$_SESSION['rid']=$row['sid'];
		$_SESSION['Term']=$row['Term'];
		$csid=$_SESSION['cid']=$row['cid'];
		$regno=$_SESSION['ExamNumber']=$row['ExamNumber'];
		$id=$row['ExamNumber'];
		$count =$row['CardCount'];
	  $CardStatus =$row['CardStatus'];
	  $CardUsedby =$row['CardUsedby'];
		if($CardUsedby == "" and $CardStatus == "Valid"){
		mysql_query("update card set CardCount=CardCount+1, TermUsed='$term', CardUsedby='$id', CardStatus='Used' where cid = '$csid'");
		header("location: $page");	
		}
		else{
		if($CardUsedby = $regno)
		mysql_query("update card set CardCount=CardCount+1 where cid = '$csid'"); header("location: $page");
		}}
		else
		{ 
		$errormsg='Invalid Registration Number And/Or Card Pin and Serial Number. Please Check And Try Again!';
		
				}
		}
		
	


?>
<!DOCTYPE html>
<html class="dxFirefox dxWindowsPlatform dxBrowserVersion-43"><head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>RESULT CHECKING PORTAL</title>
    <meta name="description" content="RESULT CHECKING PORTAL, OLA, Tech, Result, Web Result, Result Portal, Result Website, Olatech, Olawebtech, Technologies, Web Company, Web Development, Limited, Web Limited">
    <link rel="shortcut icon" href="img/favicon.ico" />
    <link href="Login_files/bece.css" rel="stylesheet">
    <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script> 
    <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
    body {
    background: #F1F1F1 none repeat scroll 0% 0%;
    min-width: 0px;
    color: #444;
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
    font-size: 13px;
    line-height: 1.4em;
}
    </style>
</head>

<body oncontextmenu="return false">
<script language=JavaScript>


var message="Function Disabled!";


function clickIE4(){
if (event.button==2){

return false;
}
}

function clickNS4(e){
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
return false;
}
}
}

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}

document.oncontextmenu=new Function("return false")

</script>
       
      
      
             
    

<?php $token=$_SESSION['token']=md5(uniqid(mt_rand(), true)); ?>
<form action="" method="post"> 
<input type="hidden" name="token" value="<?php echo $token; ?>"  >  <div style="width:900px; font-family:Tahoma; font-size:12px">
        <div style="">
          <h1>
          <a href="https://wordpress.org/"> <img border="0" alt="Logo" src="img/r_logo.png" width="100" height="100"></a>
        </h1>
        <div style="width:350px; height:400px; float:left; padding:5px">
           <div style="width:350px; height:300px; margin-left:50px; padding-top:30px; font-family:Tahoma; float:left">
                   
         
                   </div>                   
            </div>
        </div>

          <div style="width: 240px; height: auto; float: right; margin-top: 30px; border-width: 1px; border-style: solid; border-color: #ddd; padding: 30px; margin-right: 100px; background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.13);">
                   <span style="font-family:Tahoma; font-size:12px; color:red">
                   <div class="validation-summary-errors"><span></span>
<?php global $errormsg; echo $errormsg; ?> <?php  $msg=$_GET['msg']; echo $msg; ?> </div></span><br>

                   
                    <div class="controls">
                        <strong>
                        <label for="ExamNumber">Examination Number</label>
                    </strong></div>
                    
            <span id="sprytextfield1">
                        <input name="ExamNumber" type="text" class="ola" id="sprytextfield1"  value="" maxlength="15" data-val="true" data-val-required=""> <br>
<span class="textfieldRequiredMsg">The Examination Number field is required.</span></span>
<div class="controls">
                      <strong>
                       <label for="ExamNumber">Examination Session</label>
                   </strong></div>
<select required class="ola" name="Session">
  <option value="">NON-SELECT </option>
<?php
$result11= mysql_query("select * from resultyear")or die(mysql_error());
		while(   
$display11=mysql_fetch_array($result11))	
	echo 
     '<option value="'.$display11['year'].'">'.$display11['year'].'</option>'; 

?>
  
</select><br>
                    
            <div class="editor-label">
                       <strong>
                       <label for="ExamNumber">Examination Term</label>
                   </strong></div>
<select required class="ola" name="Term">
  <option value="">NON-SELECT </option>
  <option value="1ST">1ST</option>
      <option value="2ND">2ND</option>
      <option value="3RD">3RD</option>
       
</select><br>
    
            <div class="editor-label">
                       
                        <strong>
                        <label for="CardPin">Card Pin Number</label>
                    </strong></div>
                                         <span id="sprytextfield2">
                        <input name="CardPin" type="password" class="ola"  id="CardPin" maxlength="14"><br>
                        <span class="textfieldRequiredMsg">The Card Pin field is required.</span></span>

                    
                     <div class="editor-label">
                        <strong>
                        <label for="CardSerial">Card Serial Number</label>
                    </strong></div>
                    <div class="editor-field">
                                         <span id="sprytextfield3">
                        <input name="CardSerial" type="text" class="ola" id="CardSerial" value="" maxlength="14" data-val="true" data-val-required=""><br>
                                                <span class="textfieldRequiredMsg">The Card Serial field is required.</span></span>

                    </div> <br>           
                    <input name="submit" type="submit" id="submit" value="Check Result">

                    <p id="links">
      <a href="http://localhost/wordpress/">
    ← Back to BONUS SCHOOLS </a></p> 
          </div>
                
		    
        </div>       
  	
    </div> 
  </form>

      </div>
      

          </b>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5a3dc291f4461b0b4ef8a4bd/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body></html>