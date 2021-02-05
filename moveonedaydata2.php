<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<?php extract($_POST); 
//echo $ipdnumber11 ,  $ipdnumber10  ;

$date = strtotime("+1 day", strtotime($oodate));
$start_date=date('Y-m-d',$date);
echo $oodate;
echo $odate;
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
	 $L= ['old']; 
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
		echo "<script>alert('IPD Registered Successfully!');self.location='super.php';</script>";
	}
	else
	{
	echo "<script>alert('Database Error occured\n please contact system admin!');self.location='super.php';</script>";

    }
}
?>

	


</body>
</html>

