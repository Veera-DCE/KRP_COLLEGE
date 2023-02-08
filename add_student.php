<?php 
include('config.php');
$name = $_POST['c1'];
$rollno = $_POST['c2'];
$address = $_POST['c3'];
$beha = $_POST['c4'];
$amount = $_POST['c5'];
$scholar = $_POST['c6'];
$trans = $_POST['c7'];
$transfee = $_POST['c8'];

$status = false;

$find_query = "SELECT * FROM `students` WHERE `rollno` ='$rollno'";
$result = mysqli_query($con, $find_query);
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) {
        if($row['rollno'] == $rollno) {
            $status = true;
        }
    }
}

if($status) {
    $data = array(
        'status'=>'duplicate',
       
    );
    echo json_encode($data);
}
else {
    $sql = "INSERT INTO `students`(`name`, `rollno`, `address`, `behaviour`,`scholarship`,`transport`,`fee_amount`) VALUES ('$name','$rollno','$address','$beha','$scholar','$trans',$amount)";
    $query= mysqli_query($con,$sql);

    if($transfee > 0) {
        $paymentsql1 = "INSERT INTO `transport_payment`(`name`, `rollno`, `fee_amount`,`paid`,`balance`,`status`) VALUES ('$name','$rollno',$transfee,0,$transfee,'B')";
        $paymentResult1 = mysqli_query($con,$paymentsql1);
    } 
    
    $paymentsql = "INSERT INTO `payment`(`name`, `rollno`, `fee_amount`,`paid`,`balance`,`status`) VALUES ('$name','$rollno',$amount,0,$amount,'B')";
    $paymentResult = mysqli_query($con,$paymentsql);

    $lastId = mysqli_insert_id($con);
    if($query){
        $data = array(
            'status'=>'true',
        
        );
        echo json_encode($data);
    }
    else {
        $data = array(
            'status'=>'false',
        
        );

        echo json_encode($data);
    } 
}



?>