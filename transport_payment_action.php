<?php
require 'config.php';
$rollno = $_POST['bno'];
$payAmount = $_POST['pay'];
$date = $_POST['date1'];

    $q5="UPDATE transport_payment SET paid = paid + $payAmount where rollno='$rollno'";
    $r5=mysqli_query($con,$q5);
    
    $query3="update transport_payment set balance=fee_amount-paid where rollno='$rollno'";
    $result3=mysqli_query($con,$query3);

    $logQ = "INSERT INTO `transport_payment_log`(`date1`,`rollno`,`amount`) VALUES ('$date','$rollno',$payAmount)";
    $logR=mysqli_query($con,$logQ) or trigger_error("Query Failed!".mysqli_error($con), E_USER_ERROR);
   
    $query="select fee_amount,paid from transport_payment where rollno='$rollno'";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result))
    {
        while($row=mysqli_fetch_array($result))
        {
            $s1=$row['fee_amount'];
            $s2=$row['paid'];
        }
    }
    if($s2==$s1)
    {
        $query4="update transport_payment set status='P' where rollno='$rollno'";
        $result4=mysqli_query($con,$query4);
    }
    // header("Location:sales_payment.php");

?>