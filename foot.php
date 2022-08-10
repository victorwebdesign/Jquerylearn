<div id="footer-container">
		<footer class="wrapper" style="overflow:hidden">

<div align="center"><strong> 
<?php 

	$result= mysql_query("select * from site_info")or die(mysql_error());
		if($result){
$display=mysql_fetch_array($result);}	
	echo $display['footername']; ?>
 <br>
All rights reserved.</strong>
            
          </div>

    
		</footer>
	</div>