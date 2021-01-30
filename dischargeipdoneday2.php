<?php
    
    function discharge($n,$method)
    { 
        
        global $date,$date2,$mysqli,$status;
        echo $date2,$n;
        //$sql="select Ipdnumber from ipdgenralinfoold where pdate='".$date."' and status2='Admitted' top 5 ";
      
      
      if($method)
      {
        $sql="SELECT  `Ipdnumber`  FROM `ipdgenralinfoold` WHERE `pstatus2` = 'Admitted' AND `pdate2` = '$date2' LIMIT $n";
      }
     
       
       
        if($result=$mysqli->query($sql))
        {
            echo "come in if";
            while($row=$result->fetch_array(MYSQLI_NUM))
            {
                echo "come in while ".$row[0];
                $sql="UPDATE `ipdgenralinfoold` SET `pstatus2`='discharge',`disdate`='$date',`disdate2`='$date2' WHERE `Ipdnumber`='$row[0]'";
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
        else{
            echo "not going";
        }
    }



    $date=$_POST['oodate'];
    $date2=$_POST['odate'];
    $n=$_POST['number'];
    $status="discharge";
    $mysqli=new mysqli("localhost","root","","medicalcollege");
    if ($mysqli -> connect_errno) {
      echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
      exit();
    }
    else{
   echo"connection established";
   discharge($n,1);
   ;




    
    
 
 
  }


?>