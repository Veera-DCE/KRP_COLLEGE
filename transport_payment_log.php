<?php
require './config.php';
$BillNo = $_POST['BNO'];
$q1 = "SELECT * FROM payment_log WHERE rollno='$BillNo'";
$r1 = mysqli_query($con,$q1);
if($r1) {
    ?>
    <h4> Transport Fees </h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Amount</th>
            </tr>
            <?php
                $Total = 0;
                $Paid = 0;
                while($row1 = mysqli_fetch_array($r1)) {
                    ?>
                    <tr>
                        <td><?php echo date_format(new DateTime($row1['date1']),'m-d-Y')?></td>
                        <td><?php echo number_format($row1['amount'])?></td>
                    </tr>
                
                    <?php
                }
                $BAL = $Total - $Paid;
                ?>
            <tbody>
                <form action="">
                    <tr>
                    <td><input type="date" id="emi_date" name="emi_date" value="<?php echo date('d-m-Y')?>" class="form-control" required></td>
                    <td><input type="number" class="form-control" id="emi_amount" name="emi_amount" required></td>
                        <input type="hidden" id="billNo" value="<?php echo $BillNo?>">
                    </tr>
                </form>
            </tbody>
        </thead>
     </table>
    <?php
}

?>