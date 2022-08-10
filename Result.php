<?php
include('db.php');
include('session.php');
	$query = mysql_query("select * from tbl_students, card where tbl_students.sid ='$sid' and card.cid='$cid'")or die('error connecting...');
	$row = mysql_fetch_array($query);
	$count =$row['CardCount'];
	$termused =$row['TermUsed'];
	$CardStatus =$row['CardStatus'];
	$CardUsedby =$row['CardUsedby'];
	$csid = $row['cid'];
	$regno = $_SESSION['ExamNumber'];
	$termy = $_SESSION['Term'];
 
if($count >= 5 ){unset($_SESSION['ExamNumber']); header("location: index.php?msg=This Card has been disabled because the maximum number of usage has been exceeded!");
	}
if($termused != $termy ){unset($_SESSION['ExamNumber']); header("location: index.php?msg=Sorry, this card has been used to check $termused Term result, and thereby is not more valid for this term");
	}
if($CardUsedby != $regno and $CardStatus == 'Used'){
		
		mysql_query("update card set CardCount=CardCount-1 where cid = '$csid'");
		header("location: index.php?msg=Sorry this card has already been used by another user, kindly purchase new card and try again!");
	
unset($_SESSION['ExamNumber']);		
}


 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RESULT PORTAL.:</title>
<link rel="shortcut icon" href="img/favicon.ico" />
<link rel="stylesheet" type="text/css" media="print" href="SpryAssets/page.css">
<link rel="stylesheet" type="text/css" media="screen" href="SpryAssets/print.css">
<link rel="stylesheet" type="text/css" href="main.css">
<style>
.result{width:800px;margin:0 auto;border-right:1px solid #333;border-left:1px solid #333;border-bottom:1px solid #333; font-family:Arial, Helvetica, sans-serif;}
.logo{height:120px;width:800px;margin:0 auto;}
.title{
	padding: 8px;
	font-size: 15px;
	color: #fff;
	background-color: #51A351;
	font-weight: bold;
}
.disclaimer{padding:20px; border-bottom:1px solid #093;}
.detailpanel{width:750px; border-collapse:collapse;margin:0 auto; font-size:13px; font-weight:bold; color:#000000; }
.detail .short input{height:20px;width:200px;border:#999 1px solid; color:#777; }
.detail .long input{height:20px;width:550px;border:#999 1px solid; color:#777;}
p{ font-size:13px; text-align:center;}
.detail{padding-bottom:20px;padding-top:20px;}
.scores{
	padding-bottom: 20px;
	color: #C61;
}
.resultpanel{width:650px; border-collapse:collapse;margin:0 auto; font-size:13px; font-weight:bold; border:1px solid #063; background:url(images/re.jpg) repeat; }
.resultpanel tr{height:24px;}
.resultpanel th{ text-align:center;padding:8px; border-left:1px solid #096;border-bottom:1px #063 solid; color:#063;font-size:13px;}
.resultpanel td{
	text-align: center;
	padding: 6px;
	border-left: 1px solid #51A351;
	border-right: 1px solid #51A351;
	border-bottom: 1px solid #51A351;
	text-align: center;
	color: #000000;
}
.resultpanel .sub{ text-align:left;}
.resultpanel .even{color:#666;}
.resultpanel .head{
	background-color: #FCFCFC;
}
.panel p{text-align:left;font-size:11px; text-align:left;}
.foot{color:#093; padding:10px;font-size:11px;}
.control{width:800px;margin:0 auto; font:12px Arial, Helvetica, sans-serif;color:#666;}
.control a{color:#666;}
.control a:hover{color:#000;}
</style>
 <style type="text/css"> 
 
    #printable { display: block; } 
 
    @media print 
    { 
        #non-printable { display: none; } 
        #printable { display: block; } 
    } 
    a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
 </style>

</head>

<body link="#999999" vlink="#999999" alink="#999999">
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
<form>
<div>

</div>

<div>

</div>
<div id="non-printable">
<table width="84%" >
<tr>
  <td width="189">&nbsp;</td>
  <td width="517">&nbsp;</td>
  <td width="99"><a href="javascript:print();"><img src="img/print.jpg" /></a> <a href="javascript:print();" class="">Print</a></td>
<td width="78"><a href="logout.php"><img src="img/logout.jpg" /></a> <a href="logout.php">Logout</a></td>
</tr>
</table>
</div>

	<div id="printable" style=" background-blend-mode: lighten; background-repeat: no-repeat; background-position: center;background-image: url(img/reg.png) !important">
<div class="logo"><table width="100%">
	<td><img src="img/regg.jpg" width="90" height="88" /> </td>
	<td style="text-align: center;"><h1 style="font-size: 30px;">PECKHAM INTERNATIONAL SCHOOLS </h1> <br> <p style="font-size: 20px; margin-top: -30px; ">No. 12 Aba School Road, Aba, Abia State </p> </td>
	<td><img src="passports/<?php echo $row['passport'];?>" height="70" width="70">
 </td>
</table>
    
</div>

<div class="result">
<br />
	<p></p>
<div class="title"><strong>Examination Result Details: <?php echo strtoupper($row['Surname']).', '.$row['Firstname'].' '.$row['Othernames'];?></strong></div>
<div class="scores">
                  &nbsp;
                       <table class="resultpanel" style="margin-top:-40px; width:100%;">
                      <tr valign="middle" class="head">
                      	<th class="t_head" style="text-align:left; margin-top:5px; padding-left:5px;" width="13%">Surname</th>
                      	<th class="t_head" style="text-align:left; padding-left:5px;" width="20%">Other Names </th>
                      	<th class="t_head" style="text-align:left; padding-left:5px;" width="10%">Exam Number </th>
                      	<th class="t_head" style="text-align:left; padding-left:5px;" width="1%">Gender</th>
                      	<th class="t_head" style="text-align:left; padding-left:5px;" width="1%">Class</th>
                      	<th class="t_head" style="text-align:left; padding-left:5px;" width="1%">Total <br>in Class</th>
                      	<th class="t_head" style="text-align:left; padding-left:5px;" width="2%">Term/Session</th>
                      	<th class="t_head" style="text-align:left; padding-left:5px;" width="2%">Number of Times<br>School Opened</th>
                      	<th class="t_head" style="text-align:left; padding-left:5px;" width="2%">Number of Times<br>Present</th>

                      </tr>
                      	<td align="center" class="sub" width="10%">	<?php echo $row['Surname'] ;?></td>
                      	<td align="center" class="sub" width="10%">	<?php echo $row['Firstname'].' '.$row[
                      		'Othernames'] ;?></td>
                      	<td align="center" class="sub" width="7%">	<?php echo $row['ExamNumber'] ;?></td>
                      	<td align="center" class="sub" width="5%">	<?php echo $row['Sex'] ;?></td>
                      	<td align="center" class="sub" width="5%">	<?php echo $row['Class'] ;?></td>
                      	<td align="center" class="sub" width="7%">	<?php echo $row['NumberInClass'] ;?></td>	
                      	<td align="center" class="sub" width="8%">	<?php echo $row['Term'].' / '.$row[
                      		'Session'] ;?></td>
                      	<td align="center" class="sub" width="5%">	<?php echo $row['TimesOpen'] ;?></td>
                      	<td align="center" class="sub" width="5%">	<?php echo $row['TimesPresent'] ;?></td>

<div class="detail">
    <table class="resultpanel" style="margin-top: 0px; width:100%;">
                      <tr valign="middle" class="head">
    <br>    
   <th class="t_head" style="text-align:left; margin-top:5px; padding-left:5px;" width="20%">Total Marks Obtained</th>
   <td align="left"><?php echo $row['TotalMarkObtained']; ?></td>
    <th class="t_head" style="text-align:left; margin-top:5px; padding-left:5px;" width="10%">Average</th>
    <td><?php echo $row['Average']; ?></td>
     <th class="t_head" style="text-align:left; margin-top:5px; padding-left:5px;" width="13%">Position In Class</th>
 </td><?php $grade20=$row['Position']; ?></td>


          
        	
          

                                                                  <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade20=='1'){
																	 echo '1st';
											
																	 }
																	 
																		 else if($grade20=='1'){
																		 echo '1st';
																		 } else if($grade20=='2'){
																		 echo '2nd';
																		 }
																		 else if($grade20=='3'){
																		 echo '3rd';
																		 }
																		 else if($grade20=='4'){
																		 echo '4th';
																		 }
																		 else if($grade20=='5'){
																		 echo '5th';
																		 }
																		 else if($grade20=='6'){
																		 echo '6th';
																		 }
																		 else if($grade20=='7'){
																		 echo '7th';
																		 }
																		 else if($grade20=='8'){
																		 echo '8th';
																		 }
																		 else if($grade20=='9'){
																		 echo '9th';
																		 }
																		 else if($grade20=='10'){
																		 echo '10th';
																		 }
																		 else if($grade20=='11'){
																		 echo '11th';
																		 }
																		 else if($grade20=='12'){
																		 echo '12th';
																		 }
																		 else if($grade20=='13'){
																		 echo '13th';
																		 }
																		 else if($grade20=='14'){
																		 echo '14th';
																		 }
																		 else if($grade20=='15'){
																		 echo '15th';
																		 }
																		 else if($grade20=='16'){
																		 echo '16th';
																		 }
																		 else if($grade20=='17'){
																		 echo '17th';
																		 }
																		 else if($grade20=='18'){
																		 echo '18th';
																		 }
																		 else if($grade20=='19'){
																		 echo '19th';
																		 }
																		 else if($grade20=='20'){
																		 echo '20th';
																		 }
																		 else if($grade20=='21'){
																		 echo '21st';
																		 }
																		 else if($grade20=='22'){
																		 echo '22nd';
																		 }
																		 else if($grade20=='23'){
																		 echo '23rd';
																		 }
																		 else if($grade20=='24'){
																		 echo '24th';
																		 }
																		 else if($grade20=='25'){
																		 echo '25th';
																		 }
																		 else if($grade20=='26'){
																		 echo '26th';
																		 }
																		 else if($grade20=='27'){
																		 echo '27th';
																		 }
																		 else if($grade20=='28'){
																		 echo '28th';
																		 }
																		 else if($grade20=='29'){
																		 echo '29th';
																		 }
																		 else if($grade20=='30'){
																		 echo '30th';
																		 }
																		 else if($grade20=='31'){
																		 echo '31st';
																		 }
																		 else if($grade20=='32'){
																		 echo '32nd';
																		 }
																		 else if($grade20=='33'){
																		 echo '33rd';
																		 }
																		 else if($grade20=='34'){
																		 echo '34th';
																		 }
																		 else if($grade20=='35'){
																		 echo '35th';
																		 }
																		 else if($grade20=='36'){
																		 echo '36th';
																		 }
																		 else if($grade20=='37'){
																		 echo '37th';
																		 }
																		 else if($grade20=='38'){
																		 echo '38th';
																		 }
																		 else if($grade20=='39'){
																		 echo '39th';
																		 }
																		 else if($grade20=='40'){
																		 echo '40th';
																		 }
																		 else if($grade20=='41'){
																		 echo '41st';
																		 }
																		 else if($grade20=='42'){
																		 echo '42nd';
																		 }
																		 else if($grade20=='43'){
																		 echo '43rd';
																		 }
																		 else if($grade20=='44'){
																		 echo '44th';
																		 }
																		 else if($grade20=='45'){
																		 echo '45th';
																		 }
																		 else if($grade20=='46'){
																		 echo '46th';
																		 }
																		 else if($grade20=='47'){
																		 echo '47th';
																		 }
																		 else if($grade20=='48'){
																		 echo '48th';
																		 }
																		 else if($grade20=='49'){
																		 echo '49th';
																		 }
																		 else if($grade20=='50'){
																		 echo '50th';
																		 }
																		 else if($grade20=='51'){
																		 echo '51st';
																		 }
																		 else if($grade20=='52'){
																		 echo '52nd';
																		 }
																		 else if($grade20=='53'){
																		 echo '53rd';
																		 }
																		 else if($grade20=='54'){
																		 echo '54th';
																		 }
																		 else if($grade20=='55'){
																		 echo '55th';
																		 }
																		 else if($grade20=='56'){
																		 echo '56th';
																		 }
																		 else if($grade20=='57'){
																		 echo '57th';
																		 }
																		 else if($grade20=='58'){
																		 echo '58th';
																		 }
																		 else if($grade20=='59'){
																		 echo '59th';
																		 }
																		 else if($grade20=='60'){
																		 echo '60th';
																		 }
																		 else if($grade20=='61'){
																		 echo '61st';
																		 }
																		 else if($grade20=='62'){
																		 echo '62nd';
																		 }
																		 else if($grade20=='63'){
																		 echo '63rd';
																		 }
																		 else if($grade20=='64'){
																		 echo '64th';
																		 }
																		 else if($grade20=='65'){
																		 echo '65th';
																		 }
																		 else if($grade20=='66'){
																		 echo '66th';
																		 }
																		 else if($grade20=='67'){
																		 echo '67th';
																		 }
																		 else if($grade20=='68'){
																		 echo '68th';
																		 }
																		 else if($grade20=='69'){
																		 echo '69th';
																		 }
																		 else if($grade20=='70'){
																		 echo '70th';
																		 }
																		 else if($grade20=='71'){
																		 echo '71st';
																		 }
																	 else
																		 print 'None';
																 ?> 
                                                              </td>

    </table>
    <td width="22"></td>
    <td width="309">
      <td width="303" height="142">
    <table border="0" cellpadding="3" cellspacing="0" width="99%" class="short">
        <br>

        <tr>
        <td align="left" class="LabelTag" style="width:80%"> <div align="left">Next Term Begins: </div></td>
          <td align="left" width="99%"><input type="text" value="<?php echo $row['NextTermBegins']; ?>" readonly="readonly" class="msInput" /></td>

        </tr>
        
  
    </table>

    </td>        
    </td>
    </tr>
    </table>
   </div>
<div class="scores">
                  &nbsp;
                       <table class="resultpanel" style="margin-top:-39px; width:100%;">
                      <tr valign="middle" class="head">
                      	<th rowspan="2" class="t_head" style="text-align:left; padding-left:10px;" width="25%">Subjects</th>
                      	<th colspan="3" width="90px">Continous Assessment </th>
                      	<th rowspan="2" class="t_head">Exam <br> (70) </th>
                      	<th rowspan="2" class="t_align">Total Score </th>
                        <th rowspan="2" class="t_align" style="text-align: center;" width="10%">Grade</th>
                        <th rowspan="2" class="t_align">Position </th>
                        <th rowspan="2" class="t_align hide-res">Max Score</th>
                        <th rowspan="2" class="t_head" style="text-align:left; padding-left: 10px;" width="30%">Teacher's Name</th>
                         <th rowspan="2" class="t_head" style="text-align:left; padding-left: 10px;" width="30%">Teacher's Remark</th>
                    </tr>
                    <tr>
					<th>1st <br>(10)</th>
					<th>2nd <br>(10)</th>
					<th>3rd <br>(10)</th>
				  </tr>
                  
                  <tr width="100%">
                                                              <?php 
					 
																 if($row['Subject1']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject1'];?>
                                                                  
                                                              </td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca11'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca12'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca13'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam1'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total1'] ;?></td>
                                                              <td align="center" class="sub" width="5%"><?php $grade1=$row['Grade1']; echo $grade1; ?>
                                                                 
                                                             </td>
                                                             <td align="center" class="sub" width="11%"><?php echo $row['Position1'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['maxscore1'] ;?></td>
                                                            <td align="center" class="sub" width="11%"><?php echo $row['teacher1'] ;?></td>
                                                           
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade1=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade1=='A1'){
																		 echo 'Excellent';
																		 } else if($grade1=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade1=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade1=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade1=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade1=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade1=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>      <?php
                                                             }
                                                             
                                                             ?>               </tr>
                 
                  <tr width="100%">
                                                             <?php if($row['Subject2']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject2'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%">	<?php echo $row['Ca21'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca22'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca23'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam2'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total2'] ;?></td>
                                                              <td align="center" class="sub" width="5%"><?php $grade2=$row['Grade2']; echo $grade2; ?>
                                                                 
                                                             </td>
                                                             <td align="center" class="sub" width="11%"><?php echo $row['Position2'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['maxscore2'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['teacher2'] ;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade2=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade2=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade2=='B2'){
																		 echo 'Very Good';
																		 } else if($grade1=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade2=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade2=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade2=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade2=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject3']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject3'];?></td>
                                                              <td align="center" class="sub" width="10%">	<?php echo $row['Ca31'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca32'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca33'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam3'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total3'] ;?></td>
                                                              <td align="center" class="sub" width="5%"><?php $grade3=$row['Grade3']; echo $grade3; ?>
                                                                 
                                                             </td>
                                                             <td align="center" class="sub" width="11%"><?php echo $row['Position3'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['maxscore3'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['teacher3'] ;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade3=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade3=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade3=='B2'){
																		 echo 'Very Good';
																		 } else if($grade3=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade3=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade3=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade3=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade3=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject4']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject4'];?></td>
                                                              <td align="center" class="sub" width="10%">	<?php echo $row['Ca41'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca42'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca43'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam4'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total4'] ;?></td>
                                                              <td align="center" class="sub" width="5%"><?php $grade4=$row['Grade4']; echo $grade4; ?>
                                                                 
                                                             </td>
                                                             <td align="center" class="sub" width="11%"><?php echo $row['Position4'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['maxscore4'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['teacher4'] ;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                     <?php 
																 if($grade4=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade4=='A1'){
																		 echo 'Excellent';
																		 } else if($grade4=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade4=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade4=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade4=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade4=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade4=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?>  
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject5']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject5'];?></td>
                                                              <td align="center" class="sub" width="10%">	<?php echo $row['Ca51'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca52'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca53'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam5'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total5'] ;?></td>
                                                              <td align="center" class="sub" width="5%"><?php $grade5=$row['Grade5']; echo $grade5; ?>
                                                                 
                                                             </td>
                                                             <td align="center" class="sub" width="11%"><?php echo $row['Position5'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['maxscore5'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['teacher5'] ;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade5=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade5=='A1'){
																		 echo 'Excellent';
																		 } else if($grade5=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade5=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade5=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade5=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade5=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade5=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject6']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject6'];?></td>
                                                              <td align="center" class="sub" width="10%">	<?php echo $row['Ca61'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca62'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca63'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam6'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total6'] ;?></td>
                                                              <td align="center" class="sub" width="5%"><?php $grade6=$row['Grade6']; echo $grade6; ?>
                                                                 
                                                             </td>
                                                             <td align="center" class="sub" width="11%"><?php echo $row['Position6'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['maxscore6'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['teacher6'] ;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                   <?php 
																 if($grade6=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade6=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade6=='B2'){
																		 echo 'Very Good';
																		 } else if($grade6=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade6=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade6=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade6=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade6=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject7']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject7'];?></td>
                                                              <td align="center" class="sub" width="10%">	<?php echo $row['Ca71'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca72'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca73'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam7'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total7'] ;?></td>
                                                              <td align="center" class="sub" width="5%"><?php $grade7=$row['Grade7']; echo $grade7; ?>
                                                                 
                                                             </td>
                                                             <td align="center" class="sub" width="11%"><?php echo $row['Position7'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['maxscore7'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['teacher7'] ;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade7=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade7=='A1'){
																		 echo 'Excellent';
																		 } else if($grade7=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade7=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade7=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade7=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade7=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade7=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject8']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject8'];?></td>
                                                              <td align="center" class="sub" width="10%">	<?php echo $row['Ca81'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca82'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca83'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam8'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total8'] ;?></td>
                                                              <td align="center" class="sub" width="5%"><?php $grade8=$row['Grade8']; echo $grade8; ?>
                                                                 
                                                             </td>
                                                             <td align="center" class="sub" width="11%"><?php echo $row['Position8'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['maxscore8'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['teacher8'] ;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php 
																 if($grade8=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade8=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade8=='B2'){
																		 echo 'Very Good';
																		 } else if($grade8=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade8=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade8=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade8=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade8=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                  <tr width="100%">
                                                             <?php if($row['Subject9']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub"><?php echo $row['Subject9'];?></td>
                                                              <td align="center" class="sub" width="10%">	<?php echo $row['Ca91'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca92'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca93'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam9'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total9'] ;?></td>
                                                              <td align="center" class="sub" width="5%"><?php $grade9=$row['Grade9']; echo $grade9; ?>
                                                                 
                                                             </td>
                                                             <td align="center" class="sub" width="11%"><?php echo $row['Position9'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['maxscore9'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['teacher9'] ;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                 <?php 
																 if($grade9=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade9=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade9=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade9=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade9=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade9=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade9=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade9=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  <tr width="100%">
                   <?php if($row['Subject10']==''){
																	 echo '';
											
											 					 }else{
																	 ?>
                    <td align="left" class="sub"><?php echo $row['Subject10'];?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca101'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca102'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca103'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam10'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total10'] ;?></td>
                                                              <td align="center" class="sub" width="5%"><?php $grade10=$row['Grade10']; echo $grade10; ?>
                                                                 
                                                             </td>
                                                             <td align="center" class="sub" width="11%"><?php echo $row['Position10'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['maxscore10'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['teacher10'] ;?></td>
                    <td align="left" class="sub"><?php 
																 if($grade10=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade10=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade10=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade10=='B2'){
																		 echo 'Very Good';
																		 }
																		 else if($grade10=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade10=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade10=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade10=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?></td>
																  <?php
                                                             }
                                                             
                                                             ?>         
                  </tr>
                  
                     
                   <tr width="100%">
                                                             <?php if($row['Subject11']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject11'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%">	<?php echo $row['Ca111'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca112'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca113'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam11'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total11'] ;?></td>
                                                              <td align="center" class="sub" width="5%"><?php $grade11=$row['Grade11']; echo $grade11; ?>
                                                                 
                                                             </td>
                                                             <td align="center" class="sub" width="11%"><?php echo $row['Position11'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['maxscore11'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['teacher11'] ;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade11=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade11=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade11=='B2'){
																		 echo 'Very Good';
																		 } else if($grade1=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade11=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade11=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade11=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade11=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade11=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade11=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade11=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade11=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade11=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade11=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                 
                   <tr width="100%">
                                                             <?php if($row['Subject12']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject12'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%">	<?php echo $row['Ca121'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca122'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca123'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam12'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total12'] ;?></td>
                                                              <td align="center" class="sub" width="5%"><?php $grade12=$row['Grade12']; echo $grade12; ?>
                                                                 
                                                             </td>
                                                             <td align="center" class="sub" width="11%"><?php echo $row['Position12'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['maxscore12'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['teacher12'] ;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade12=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade12=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade12=='B2'){
																		 echo 'Very Good';
																		 } else if($grade12=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade12=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade12=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade12=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade12=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade12=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade12=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade12=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade12=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade12=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade12=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                 
                   <tr width="100%">
                                                             <?php if($row['Subject13']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject13'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%">	<?php echo $row['Ca131'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca132'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca133'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam13'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total13'] ;?></td>
                                                              <td align="center" class="sub" width="5%"><?php $grade13=$row['Grade13']; echo $grade13; ?>
                                                                 
                                                             </td>
                                                             <td align="center" class="sub" width="11%"><?php echo $row['Position13'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['maxscore13'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['teacher13'] ;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade13=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade13=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade13=='B2'){
																		 echo 'Very Good';
																		 } else if($grade13=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade13=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade13=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade13=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade13=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade13=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade13=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade13=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade13=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade13=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade13=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                          
                   <tr width="100%">
                                                             <?php if($row['Subject14']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject14'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%">	<?php echo $row['Ca141'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca142'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca143'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam14'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total14'] ;?></td>
                                                              <td align="center" class="sub" width="5%"><?php $grade14=$row['Grade14']; echo $grade14; ?>
                                                                 
                                                             </td>
                                                             <td align="center" class="sub" width="11%"><?php echo $row['Position14'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['maxscore14'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['teacher14'] ;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade14=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade14=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade14=='B2'){
																		 echo 'Very Good';
																		 } else if($grade14=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade14=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade14=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade14=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade14=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade14=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade14=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade14=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade14=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade14=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade14=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                   
                   
                            
                   <tr width="100%">
                                                             <?php if($row['Subject15']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject15'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%">	<?php echo $row['Ca151'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca152'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca153'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam15'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total15'] ;?></td>
                                                              <td align="center" class="sub" width="5%"><?php $grade15=$row['Grade15']; echo $grade15; ?>
                                                                 
                                                             </td>
                                                             <td align="center" class="sub" width="11%"><?php echo $row['Position15'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['maxscore15'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['teacher15'] ;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade15=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade15=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade15=='B2'){
																		 echo 'Very Good';
																		 } else if($grade15=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade15=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade15=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade15=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade15=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade15=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade15=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade15=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade15=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade15=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade15=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                  
                   <tr width="100%">
                                                             <?php if($row['Subject16']==''){
																	 echo '';
											
																 }else{
																	 ?>
                                                              <td align="left" class="sub" width="33%"><?php echo $row['Subject16'];?>
                                                                  
                                                              </td>
                                                              <td align="center" class="sub" width="10%">	<?php echo $row['Ca161'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca162'] ;?></td>
                    <td align="center" class="sub" width="10%">	<?php echo $row['Ca163'] ;?></td>
                                                              <td align="center" class="sub" width="10%"><?php echo $row['Exam16'] ;?></td>
                                                              <td align="center" class="sub" width="11%"><?php echo $row['Total16'] ;?></td>
                                                              <td align="center" class="sub" width="5%"><?php $grade16=$row['Grade16']; echo $grade16; ?>
                                                                 
                                                             </td>
                                                             <td align="center" class="sub" width="11%"><?php echo $row['Position16'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['maxscore16'] ;?></td>
                                                           <td align="center" class="sub" width="11%"><?php echo $row['teacher16'] ;?></td>
                                                              <td align="left" class="sub" width="25%">
                                                                    <?php
                                                                     if($grade16=='A'){
																	 echo 'Excellent';
											
																	 }
																	 
																		 else if($grade16=='A1'){
																		 echo 'Excellent';
																		 }
																		 else if($grade16=='B2'){
																		 echo 'Very Good';
																		 } else if($grade16=='B'){
																		 echo 'Very Good';
																		 }
																		 else if($grade16=='B3'){
																		 echo 'Good';
																		 }
																		 else if($grade16=='C'){
																		 echo 'Credit';
																		 }
																		 else if($grade16=='C4'){
																		 echo 'Credit';
																		 }
																		 else if($grade16=='C5'){
																		 echo 'Credit';
																		 }
																		 else if($grade16=='C6'){
																		 echo 'Credit';
																		 }
																		 else if($grade16=='D7'){
																		 echo 'Pass';
																		 }
																		 else if($grade16=='D'){
																		 echo 'Pass';
																		 }
																		 else if($grade16=='E'){
																		 echo 'Pass';
																		 }
																		 else if($grade16=='P8'){
																		 echo 'Pass';
																		 }
																		 else if($grade16=='F9'){
																		 echo 'Fail';
																		 }
																		 
																	 else
																		 print 'None';
																 ?> 
                                                              </td>
                                                               <?php
                                                             }
                                                             
                                                             ?>         
                   </tr>
                   
                  
                  
                  </table>
                  
<div class="scores">
                  &nbsp;
                       <table class="resultpanel" style="margin-top: -30px; width:100%;">
                      <tr valign="middle" class="head">
                      	<td class="t_head" style="text-align:left; margin-top:5px; padding-left:5px;" width="20%">Next Term Begins</td>
                      	<td style="text-align: left;"><?php echo $row['NextTermBegins']; ?></td>

              

</div>
	<div class="detail" id="non-printable">
		 <table width="678"  class="detailpanel">
    <tr valign="">
    <td width="676" height="135">
           <table border="0" cellpadding="3" cellspacing="0" width="100%" class="long">
                  <tr>
                      <td align="right" class="LabelTag" width="13%">Card_Pin No:</td>
                      <td width="87%" align="left" style="width: 77%">
                          <input type="text" value="<?php

$pass = $row['CardPin'];
$masked =  str_pad(substr($pass, -4), strlen($cc), '*', STR_PAD_LEFT);
print '********'.$masked;

?>" readonly="readonly" class="msInput" /></td>
                  </tr>
                  <tr>
                      <td align="right" class="LabelTag" width="13%">Card Usage:</td>
                      <td align="left" style="width: 77%">
                          <input type="text" value="You Have logged in <?php echo $count; ?> time(s)" readonly="readonly" class="msInput" /></td>
                  </tr>
                  <tr>
                      <td align="right" width="13%">
                      </td>
                      <td align="left" class="LabelTag" style="width: 77%">
                          * Please note that only the last four (4) characters of the Card PIN is displayed.</td>
                  </tr>
              </table>
     </td>
     </tr>
     </table>

	</div>
	
<div class="disclaimer">
	<table class="resultpanel" style="width:100%;">
		
			<caption> Grading Point</caption>
			<tr>
			<th>A1</th>
			<th>B2</th>
			<th>B3</th>
			<th>C4</th>
			<th>C5</th>
			<th>C6</th>
			<th>D7</th>
			<th>E</th>
			<th>F9</th></tr>
			<tr>
			<td> 80%-100%</td>
			<td> 75%-79%</td>
			<td> 70%-74%</td>
				<td> 60%-69%</td>
					<td> 55%-59%</td>
						<td> 50%-54% <br>(C6)</td>
						<td> 45%-49% <br>(D7)</td>
						<td> 40%-44% <br>(E)</td>
						<td> 0%-39% <br>(F9)</td></tr>
		
		
	</table>
	<br>
<table class="resultpanel" width="100%"><tr valign="middle" width="100%" style="width: 100%">
  <td align="right" class="LabelTag" width="18%">Class Teacher's Remarks:</td>
  <td colspan="3"><p><span class="msInput"><?php echo $row['ClassTeacherRemark'] ;?></span></p></td>
  </tr>
  <tr valign="middle" width="100%" style="width: 100%">
    <td align="right" class="LabelTag" width="18%">Principal's Remarks:</td>
    <td width="50%"><span class="msInput"><?php echo $row['PrincipalRemark'] ;?></span></td>
    <td align="right" class="LabelTag" width="9%">Sign:</td>
    <td width="23%" align=right><img src="img/principalsign.jpg" alt="PRINCIPAL SIGNATURE" /></td>
  </tr>
</table>
	</div>
<div class="foot"><?php 

	$result= mysql_query("select * from site_info")or die(mysql_error());
		if($result){
$display=mysql_fetch_array($result);}	
	echo $display['adminfootername']; ?></div>
</div></div>
</form>
</body>
</html>