

<?php



$status1="new";
$status2="Admitted";

 $mysqli=new mysqli("localhost","root","","medicalcollege");
 if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }







function get_bed_no($beddept)
{
global $mysqli;
//require_once("_config.php");

mysql_query('SET character_set_results=utf8');
mysql_query('SET names=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_results=utf8');
mysql_query('SET collation_connection=utf8_general_ci');


//$bedno = "";
             $ipddepartment=$beddept;
             $avialebel_bed_no='';
            $storeArray = Array();
            /*
	 		$qry = mysql_query("SELECT `bed_no` FROM `tvd_bed_avialbel_chk` WHERE `status` = 1 and `department`='".$ipddepartment."'");
             
			while ($row = mysql_fetch_array($qry, MYSQL_ASSOC)) {
			    $storeArray[] =  $row['bed_no'];  
            }*/
            $sql="SELECT `bed_no` FROM `tvd_bed_avialbel_chk` WHERE `status` = 1 and `department`='".$ipddepartment."'";
            $result=$mysqli->query($sql);
            while($bedrow=$result->fetch_array(MYSQLI_ASSOC))
            {
                $storeArray[] =  $bedrow['bed_no'];
            }



			//for Kayachikitasa
			if($ipddepartment=="Kayachikitasa"){
				$avialebel_bed_no = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40);
			}
			//for Panchakarma
			if($ipddepartment=="Panchakarma"){
				$avialebel_bed_no = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
			}
			//for Shalyatantra
			if($ipddepartment=="Shalyatantra"){
				$avialebel_bed_no = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);
			}
			//for Shalakyatantra
			if($ipddepartment=="Shalakyatantra"){
				$avialebel_bed_no = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
			}
			//for Striroga
			if($ipddepartment=="Striroga"){
				$avialebel_bed_no = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);
			}
			//for Kaumarbharitya
			if($ipddepartment=="Kaumarbharitya"){
				$avialebel_bed_no = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
			}
			
			//print_r($storeArray);

			$result=array_diff($avialebel_bed_no,$storeArray);
			

			//$random_keys=array_rand($result,1);
			$random_keys=array_rand(array_flip($result));
			


	return $random_keys;

        }

















function insert($n,$date11,$date22,$wordno,$dept)
{
    global $mysqli,$status1,$status2;
   
    
    $sql="select * from opd where opdate='".$date11."' and opdept='".$dept."' ORDER BY RAND() LIMIT $n ";  

    if($dept=="Casulity")
    {
        $dept="Kayachikitasa";
    }
    if($dept=="Swasthvritta")
    {
        $dept="Kayachikitasa";
    } 



if($result=$mysqli -> query($sql))
{
    echo "come in if";
    
    while($row=$result->fetch_array(MYSQLI_NUM))
    {
        echo "come in while";
        $ipdnum="";
        $oldipdnum="";
      
            $sql="SELECT max(Ipdnumber)as no FROM `ipdgenralinfoold` WHERE `pstatus1`='new'";
            $resultipd=$mysqli ->query($sql);
           
                $rowipd=$resultipd->fetch_row();
                $oldipdnum=$rowipd[0];
                $newstring = substr($oldipdnum, 0, -3);
                $yearstring = substr($oldipdnum, -3);
                $ipdnumber=$newstring+1; 
                $newipdnumber = $ipdnumber."".$yearstring;
                echo $newipdnumber;
                
                
           
            $bedno=get_bed_no($dept);
            echo $bedno;
            $conf="."; 




            echo "date 2".$row[4];
        $sql="insert into ipdgenralinfoold values(null,'$row[1]','$newipdnumber','$row[2]','$row[3]','$row[7]','$dept','$dept','$row[4]','$row[5]','$wordno','$bedno','$status1','$status2','$row[9]','$row[8]','$date22','$date11',' ',' ','$conf')";
            if($mysqli->query($sql))
            {
                echo"data inserted";
            }
            else{
                echo"sorry not inserted";
            }
            
    }
}
else{
    echo "somthing went wrong";
}
}



if(isset($_POST['btnsubmit']))
{
    $date1=$_POST['odate'];
    $date2=$_POST['oodate'];
    $kachi=$_POST['kaychikista'];
    $kumar=$_POST['kumarbhartiya'];
    $shayl=$_POST['shalyantra'];
    $shaykyan=$_POST['shaylakyntra'];
    $sri=$_POST['srironga'];
    $panchkarma=$_POST['panchakarma'];
    $casulity=$_POST['casulity'];
    $Swasthvritta=$_POST['Swasthvritta'];
    echo $date1."  ".$date2."  ".$kachi."  ".$kumar."  ".$shayl." ".$shaykyan." ".$sri." ".$panchkarma;





    if($kachi>0)
    {
        echo"call funtion";
        insert($kachi,$date1,$date2,"Word No.1","Kayachikitasa");
    }
    if($casulity>0)
    {
        insert($casulity,$date1,$date2,"Word No.1","Casulity");
    }
    if($Swasthvritta>0)
    {
        insert($casulity,$date1,$date2,"Word No.1","Swasthvritta");
    }

    if($panchkarma>0)
    {         echo"call funtion2";

        insert($panchkarma,$date1,$date2,"Word No.2","Panchakarma");

    }
    if($shayl>0)
    {           echo"call funtion3";

        insert($shayl,$date1,$date2,"Word No.3","Shalyatantra");

    }
    if($shaykyan>0)
    {           echo"call funtion4";

        insert($shaykyan,$date1,$date2,"Word No.4","Shalakyatantra");

    }
    if($sri>0)
    {           echo"call funtion5";

        insert($sri,$date1,$date2,"Word No.5","Striroga");
    }
    if($kumar>0)
    {           echo"call funtion6";

        insert($kumar,$date1,$date2,"Word No.6","Kaumarbharitya");
    }
  
    
   
   













}




?>
