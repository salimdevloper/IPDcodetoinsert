<?php
function checkday($admited,$current)
{
   
   
   
    $date11=date_create($admited);
    $date22=date_create($current);
    $diff=date_diff($date11,$date22);
    echo " ".$current;
    echo " ".$admited;
    $di=$diff->format("%R%a days");
    echo $di;
    echo "come";
   
    return $di;
}
function randomdicharge($n)
{   global $mysqli,$date2,$date,$status;
   

    $sql="select Ipdnumber,admittedate2,admindate from ipdgenralinfoold where `pstatus2` = 'Admitted' AND `pdate2` = '$date2' order by rand()";
    $result=$mysqli->query($sql);
    
    while(($row=$result->fetch_Array(MYSQLI_NUM)) && $n>=1)
    {  

        $diff=checkday($row[1],$date);
    
        
                if($diff>=6)
                    { echo "Random discharge".$n;
                        $sql="UPDATE `ipdgenralinfoold` SET `pstatus2`='discharge',`disdate`='$date',`disdate2`='$date2' WHERE `Ipdnumber`='$row[0]' and pdate='$date'";
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
                        $n-=1;
                    }
            
        
        }         
   
}









    
    function discharge($n,$method)
    { 
        
        global $date,$date2,$mysqli,$status;
        echo $date2,$n;
        //$sql="select Ipdnumber from ipdgenralinfoold where pdate='".$date."' and status2='Admitted' top 5 ";
      
      
      if($method)
      {
        $sql="SELECT  `Ipdnumber`,admittedate2,admindate  FROM `ipdgenralinfoold` WHERE `pstatus2` = 'Admitted' AND `pdate2` = '$date2' LIMIT $n";
      }
      else{
        randomdicharge($n);
        return 0;
      }
     
       
       
        if($result=$mysqli->query($sql))
        {
            echo "come in if";
            while($row=$result->fetch_array(MYSQLI_NUM))
            {
                echo "come in while ".$row[0];

               

                                        $sql="UPDATE `ipdgenralinfoold` SET `pstatus2`='discharge',`disdate`='$date',`disdate2`='$date2' WHERE `Ipdnumber`='$row[0]' and pdate='$date'";
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
        return 0;
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
      $res=discharge($n,1);
        $res=discharge($n,0); 
 
  }


?>