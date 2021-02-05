<?php
//set your start and end



function updateddata($n,$update2)
{
    $mysqli= new mysqli("localhost","root","","medicalcollege");
    $sql="select * from opd where opdate='0000-00-00' limit $n";
        $datecon=new DateTime($update2);
       $update=date_format($datecon,'d-m-Y');
       $chupdate=date_format($datecon,'j-n-Y');
      echo $update;
  if($result=$mysqli->query($sql))
    {   
        while($row=$result->fetch_array(MYSQLI_NUM))
        {
            echo $update."update data";
            $sql="UPDATE `opd` SET `opdate`='$update2',`opdate1`='$chupdate' WHERE `opdnumber`='$row[0]'";

            if($res=$mysqli->query($sql))
            {
                echo "updated";
            }
            else{
                echo "not updated";
            }

        }
    }

}


   $start_date='2017-01-01';
    $end_date='2017-01-08';
    
   
    //$date = strtotime("+1 day", strtotime($start_date));
    //$end_date=date('d-m-Y',$date);
    $holidayArray=array('2017-01-04');
    $weakholiday=array('2017-01-03');


    $mysqli= new mysqli("localhost","root","","medicalcollege");
    $sql="select * from opd ";
    $result=$mysqli->query($sql);

                while($start_date!=$end_date)
                { 
                    $datecon=new DateTime($start_date);
                //$update=date_format($datecon,'d-m-Y');
                 $chupdate=date_format($datecon,'j-n-Y');
                $n=0;
                    if(in_array($start_date,$holidayArray))
                    {
                        $date = strtotime("+1 day", strtotime($start_date));
                    $start_date=date('Y-m-d',$date);
                    echo "so weak";
                    continue;
                    }
                    else if(in_array($start_date,$weakholiday))
                        {   $n=rand(10,50);
                            
                            while($n>=1)
                            {
                                $row=$result->fetch_array(MYSQLI_NUM);
                               
                            $sql="UPDATE `opd` SET `opdate`='$start_date',`opdate1`='$chupdate' WHERE `opdnumber`='$row[0]'";

                                      if($res=$mysqli->query($sql))
                                             {
                                                echo "updated";
                                              }
                                        else{
                                            echo "not updated";
                                            }
                                    $n=$n-1;
                            }
                        }
                         else{
                                    $n=rand(130,170);
                                    echo ".strong.";
                                    while($n>=1)
                                    {
                                        $row=$result->fetch_array(MYSQLI_NUM);
                                       
                                    $sql="UPDATE `opd` SET `opdate`='$start_date',`opdate1`='$chupdate' WHERE `opdnumber`='$row[0]'";
        
                                              if($res=$mysqli->query($sql))
                                                     {
                                                        echo "updated";
                                                      }
                                                else{
                                                    echo "not updated";
                                                 }
                                                 $n=$n-1;  
                                    }
                            }
                    
                    $date = strtotime("+1 day", strtotime($start_date));
                    $start_date=date('Y-m-d',$date);
                    

                }
    
?>