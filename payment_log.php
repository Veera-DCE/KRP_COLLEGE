<?php
require './config.php';
$BillNo = $_POST['BNO'];
$q = "SELECT * FROM payment_log WHERE rollno='$BillNo'";
$r = mysqli_query($con,$q);
if($r) {
    ?>
    <table class="table">
     <tr>
        <th>Date</th>
        <th>Amount</th>
     </tr>
    <?php
    $Total = 0;
    $Paid = 0;
    while($row = mysqli_fetch_array($r)) {
        ?>
        <tr>
            <td><?php echo date_format(new DateTime($row['date1']),'m-d-Y')?></td>
            <td><?php echo number_format($row['amount'])?></td>
        </tr>
      
        <?php
    }
    $BAL = $Total - $Paid;
    ?>
   
    <form>
    <?php
    ?>
    <tr>
        <td><input type="date" id="emi_date" name="emi_date" value="<?php echo date('d-m-Y')?>" class="form-control" required></td>
        <td><input type="number" class="form-control" id="emi_amount" name="emi_amount" required></td>
        <input type="hidden" id="billNo" value="<?php echo $BillNo?>">
    </tr>
    <?php
    ?>
    
    </form>
     </table>
    <?php
   
}

?>