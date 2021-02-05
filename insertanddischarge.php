

<?php



$status1="new";
$status2="Admitted";

 $mysqli=new mysqli("localhost","root","","medicalcollege");
 if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }







function get_bed_no($beddept,$gender1)
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
				
            
            
                if($gender1=='female')
                {
                                $avialebel_bed_no = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20);
                }
                else{
                    $avialebel_bed_no = array( 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40);
                }
            
            
            
            }
			//for Panchakarma
			if($ipddepartment=="Panchakarma"){
                    if($gender1=='female')
                    {
			                    	$avialebel_bed_no = array( 1, 2, 3, 4, 5);
                    }
                    else{
                        $avialebel_bed_no = array( 6, 7, 8, 9, 10);
                    }

            
            }
			//for Shalyatantra
			if($ipddepartment=="Shalyatantra"){
                if($gender1=="female")
                {
                $avialebel_bed_no = array( 1, 2, 3, 4, 5, 6, 7);
                }
                else{
                $avialebel_bed_no = array(8,9,10, 11, 12, 13, 14, 15);
                }  
            }
			//for Shalakyatantra
			if($ipddepartment=="Shalakyatantra"){
                if($gender1=='female')
                {
                $avialebel_bed_no = array( 1, 2, 3, 4, 5);
                }
                {
                $avialebel_bed_no = array(6, 7, 8, 9, 10);
                }
            
            }
			//for Striroga
			if($ipddepartment=="Striroga"){
				$avialebel_bed_no = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);
			}
			//for Kaumarbharitya
			if($ipddepartment=="Kaumarbharitya"){
                if($gender1=='female')
                {
                $avialebel_bed_no = array( 1, 2, 3, 4, 5);
                
                }
                else{$avialebel_bed_no = array(6, 7, 8, 9, 10);}
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

        $gender=$row[5]; //to pass gender
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
                
                
           
            $bedno=get_bed_no($dept,$gender);//pass gender and dept name
            echo $bedno;
            $conf="."; 



        if($bedno>=1)
        {
            echo "date 2".$row[4];
                                if($newipdnumber==1)
                                {
                                        $sql="insert into ipdgenralinfoold values(null,'$row[1]','1018','$row[2]','$row[3]','$row[7]','$dept','$dept','$row[4]','$row[5]','$wordno','$bedno','$status1','$status2','$row[9]','$row[8]','$date22','$date11',' ',' ','$conf')";
                                }
                                else{
                                    $sql="insert into ipdgenralinfoold values(null,'$row[1]','$newipdnumber','$row[2]','$row[3]','$row[7]','$dept','$dept','$row[4]','$row[5]','$wordno','$bedno','$status1','$status2','$row[9]','$row[8]','$date22','$date11',' ',' ','$conf')";

                                }
                                
                                
                                
                                
                                    if($mysqli->query($sql))
                                        {
                                            echo"data inserted";
                                            $sqlbed="INSERT INTO `tvd_bed_avialbel_chk`( `Ipdnumber`,`bed_no`, `department`, `status`) VALUES ('$newipdnumber','$bedno','$dept',1)";
                                                $res=$mysqli->query($sqlbed);
                                                
                                        }
                                        else{
                                            echo"sorry not inserted";
                                        }
        }
        
        else{
            continue;
        }



    }
}
else{
    echo "somthing went wrong";
}
}




function checkday($admited,$current)
{
   
   
   
    $date11=date_create($admited);
    $date22=date_create($current);
    $diff=date_diff($date11,$date22);
    echo " ".$current;
    echo " ".$admited;
    $di=$diff->format("%R%a days");
    echo $di;
    echo "come".$current." oklk".$admited;
   
    return $di;
}
function randomdicharge($n)
{   global $mysqli,$date2,$date1,$status;
    

    $sql="select Ipdnumber,admittedate2,admindate from ipdgenralinfoold where `pstatus2` = 'Admitted' AND `pdate` = '$date2' order by rand()";
    echo $date1."random chane".$date2;
 
    $result=$mysqli->query($sql);
    
    while(($row=$result->fetch_Array(MYSQLI_NUM)) && $n>=1)
    {    
        echo $row[1]."dateee";
        
        $diff=checkday($row[1],$date2);
    
       
                if($diff>=6)
                    {    echo "<script>sequance dicharge<script>";
                        $sql="UPDATE `ipdgenralinfoold` SET `pstatus2`='discharge',`disdate`='$date2',`disdate2`='$date1' WHERE `Ipdnumber`='$row[0]' and pdate='$date2'";
                        if($result2=$mysqli->query($sql))
                        {
                                echo "update in ipd";
                                echo "<script>sequance dicharge no<script>";
                        }
                        else{
                            echo"<h1>wrong</h1>";
                        }
                        
                        $sql="update tvd_bed_avialbel_chk set status='0' where Ipdnumber='$row[0]'";
                        if($res=$mysqli->query($sql))
                        {
                            echo "update in table bed";
                        }
                        else{
                            echo"wrong in table bed";
                        }
                        $n-=1;
                    }
            
        
        }         
   
}





function discharge($n,$method)
    { 
        
        global $date1,$date2,$mysqli,$status;
        echo $date2."second ".$date1;
        //$sql="select Ipdnumber from ipdgenralinfoold where pdate='".$date."' and status2='Admitted' top 5 ";
      
      
      if($method)
      {
        $sql="SELECT  `Ipdnumber`,`admittedate2`,`admindate`  FROM `ipdgenralinfoold` WHERE `pstatus2` = 'Admitted' and `pdate`='$date2'   LIMIT $n";
      }
      else{
        randomdicharge($n);
        return 0;
      }
     
       
       
                    if($result=$mysqli->query($sql))
                    {
                                        echo "<script>sequance dicharge<script>";
                                        while($row=$result->fetch_array(MYSQLI_NUM))
                                        {   

                                            $diff=checkday($row[1],$date2);
    
       
                                            if($diff>=6)
                                                { 
                                            
                                            
                                                            echo "come in while ".$row[0];
                                                            $sql="UPDATE `ipdgenralinfoold` SET `pstatus2`='discharge',`disdate`='$date2',`disdate2`='$date1' WHERE `Ipdnumber`='$row[0]' and `pdate`='$date2' ";
                                                            if($result2=$mysqli->query($sql))
                                                            {
                                                                    echo "update in ipd";
                                                            }
                                                            else{
                                                                echo"<h1>wrong</h1>";
                                                            }
                                                            
                                                            $sql="update tvd_bed_avialbel_chk set status='0' where Ipdnumber='$row[0]'";
                                                            if($res=$mysqli->query($sql))
                                                            {
                                                                echo "update in table bed";
                                                            }
                                                            else{
                                                                echo"wrong in table bed";
                                                            }
                                                 }
                                        }
                    }
                    else{
                        echo "not going";
                    }
        return 0;
    }

















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
    $status="discharge";
    $discharge=$_POST['discharge'];










if(isset($_POST['btnsubmit']))
{
    
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
  

    $res=discharge($discharge,0);
    echo "<h1>call 2322funtion</h1>";
    $res=discharge($discharge,1);


    $oodate=$date2;
    $odate=$date1;
    $ipdnumber10=0;
    $ipdnumber11=0;
    $mysqli= new mysqli("localhost","root","","medicalcollege");
    $sql="SELECT `Srno`
    FROM `ipdgenralinfoold`
    WHERE `pdate` = '$oodate'";
    $result=$mysqli->query($sql);
     
        $row=$result->fetch_row();
        $ipdnumber11=$row[0];
        echo "sr no".$ipdnumber11;
    while($row=$result->fetch_row())
    {
        $ipdnumber10=$row[0];
    }
    echo "sr no".$ipdnumber10;
    
    
    
      
    
    
    
    
        //echo ".";
        $date = strtotime("+1 day", strtotime($oodate));
    $oodate=date('Y-m-d',$date);
    $date = strtotime("+1 day", strtotime($odate));
    $odate=date('Y-m-d',$date);
        $datecon=new DateTime($oodate);
        //$update=date_format($datecon,'d-m-Y');
         $oodate=date_format($datecon,'j-n-Y');
        
        //echo "$oodate";
        //echo $odate;
        
    
    
        $sql="select *From ipdgenralinfoold where srno between '".$ipdnumber11 ."' and '".$ipdnumber10 ."' and pstatus2='Admitted'";
        //$sql="SELECT * FROM `ipdgenralinfoold` where `Srno` between $ipdnumber11 and  $ipdnumber10 and pstatus2 ='Admitted' ";
    
    //$sql="select *From ipdgenralinfoold";
            //echo $sql;
            $res=$mysqli->query($sql);
            
    
           
        
    
        
            while( $row=$res->fetch_assoc())
            {
        
               
          $A= $row['Opdnumber']; 
          $B= $row['Ipdnumber']; 
          $C= $row['pname']; 
          $D= $row['padd']; 
          $E= $row['pdept']; 
          $F= $row['pipddept']; 
          $G= $row['pdoct']; 
          $H= $row['page']; 
          $I= $row['psex']; 
          $J= $row['pword']; 
          $K= $row['pbad']; 
         $L= 'old'; 
          $M= $row['pstatus2'] ;
          $N= $oodate ;
          $O= $odate ;
         $P= $row['admindate']; 
          $Q= $row['admittedate2']; 
         $R= $row['conf'];
        
        
        //echo " $A $B $C $D $E $F $G  $H $I $J $K $L $M $N $O .... <br><br><br>" ;	
        
        
        $sql="INSERT INTO ipdgenralinfoold VALUES ('NULL','$A','$B' , '$C' , '$D' , '$E' , '$F' , '$G' , '$H' , '$I' , '$J' , '$K' , '$L' , '$M' , '$N' , '$O' ,'$P' ,'$Q' , '' , '','$R' )";
        //echo $sql ; 
        if($mysqli->query($sql))
        {
            echo "<script>alert('IPD Registered Successfully!');</script>";
        }
        else
        {
        echo "<script>alert('Database Error occured\n please contact system admin!');</script>";
    
        }
    }







}



?>
