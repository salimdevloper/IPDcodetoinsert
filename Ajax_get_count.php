<?php
require_once("_config.php");

mysql_query('SET character_set_results=utf8');
mysql_query('SET names=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_results=utf8');
mysql_query('SET collation_connection=utf8_general_ci');




$today = date('Y-m-d');

	 		$ipddepartment=$_POST['department_name'];
	 		$qry = mysql_query("<?php
			 require_once("_config.php");
			 
			 mysql_query('SET character_set_results=utf8');
			 mysql_query('SET names=utf8');
			 mysql_query('SET character_set_client=utf8');
			 mysql_query('SET character_set_connection=utf8');
			 mysql_query('SET character_set_results=utf8');
			 mysql_query('SET collation_connection=utf8_general_ci');
			 
			 
			 
			 
			 $today = date('Y-m-d');
			 
						  $ipddepartment=$_POST['department_name'];
						  $qry = mysql_query("SELECT count(`pname`)as totcnt FROM `ipdgenralinfoold` WHERE `pstatus2` ='Admitted' and `pipddept`='$ipddepartment' and `pdate2`='$today'");
						 
						 $row = mysql_fetch_array($qry);
			 
			 
						 
						 $cnt=$row['totcnt'];
						 
			 
			 
				 echo $cnt;
				 
			 ?>");
			
			$row = mysql_fetch_array($qry);


			
			$cnt=$row['totcnt'];
			


	echo $cnt;
	
?>