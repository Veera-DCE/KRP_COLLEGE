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
$id = $_POST['id'];

$sql = "UPDATE `students` SET `name`= '$name', `rollno`='$rollno',  `address`='$address',`behaviour`='$beha',`scholarship`='$scholar',`fee_amount`=$amount,`transport`='$trans',`transport_fee`=$transfee WHERE id='$id' ";
$query= mysqli_query($con,$sql);


$sql = "UPDATE `payment` SET `name`= '$name', `rollno`='$rollno', `fee_amount`=$amount ,`transport_fee`=$transfee WHERE rollno='$rollno' ";
$query= mysqli_query($con,$sql);

$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>