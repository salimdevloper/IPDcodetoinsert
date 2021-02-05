<?php 
$mydate=$_POST['mydate'];
$mysqli=new mysqli("localhost","root","","medicalcollege");
if ($mysqli -> connect_errno) {
   echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
   exit();
 }
 $sql="SELECT `pipddept` , COUNT( `pipddept` ) , `pstatus2`
 FROM `ipdgenralinfoold`
 WHERE `pstatus2` = 'Admitted'
 AND `pdate` = '$mydate' group by `pipddept";
 if($result=$mysqli->query($sql))
{   $output="<table><tr><td>department name</td><td>count</td></tr>";
    while($row=$result->fetch_row())
    {
        $output.="<tr><td>{$row[0]}</td><td>{$row[1]}</td><tr>";
    }
echo $output;

}
else{
    echo "sorry something wrong";
}
?>