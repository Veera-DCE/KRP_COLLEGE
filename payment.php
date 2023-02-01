<?php
session_start();
if(isset($_SESSION['uname'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>KRP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="./bs/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="./bs/boostrap-icons.css">
  <script src="./bs/bootstrap.bundle.min.js"></script>
  <link href="./krp.css" rel="stylesheet">
  <style>
    nav {
        background-color: linear-gradient(blue, pink) !important;
    }
  </style>
  <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput1");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function myFunction2() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-light">
  <div class="container">
    <a class="navbar-brand" href="./dashboard.php"><img src="./assets/logo2.jpg" style="height: 50px;" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto justify-content-center">
        <li class="nav-item">
          <a class="nav-link" href="./students.php">Students</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./payment.php">Payments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./reports.php">Reports</a>
        </li>
      </ul>
      <form class="d-flex">
        <a href="./logout.php" class="btn btn-danger" data-toggle="modal" data-target="#logoutModal">Logout</a>
      </form>
    </div>
  </div>
</nav>
<div class="container">
<div class="row mt-5">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                Payments
                                   <div class="d-flex flex-row justify-content-end">
                                    <div class="col-8">
                                    <input type="text" class="form-control" id="myInput1" onkeyup="myFunction()" placeholder="Search for Names">
                                    </div>
                                    <br>
                                    <div class="col-8">
                                      <input type="text" class="form-control" id="myInput2" onkeyup="myFunction2()" placeholder="Search for Roll No">
                                    </div>
                                   </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="">
                                        <form action="payment_action.php" method="POST">
                                            <div class="container">
                                                <div class="row">
                                                <table class="table" id="myTable">
                                                    <thead>
                                                        <th>Name</th>
                                                        <th>Roll No</th>
                                                        <th>Amount</th>
                                                        <th>Paid</th>
                                                        <th>Balance</th>
                                                        <th>Status</th>
                                                        <th>Pay</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $count  = 0;
                                                            require 'config.php';
                                                            $query = "SELECT * FROM `payment` ORDER BY id DESC ";
                                                            $result = mysqli_query($con , $query);
                                                            if(mysqli_num_rows($result)>0) {
                                                                $count = mysqli_num_rows($result);
                                                                $id=1;
                                                                while($row = mysqli_fetch_array($result)) {
                                                                    // $bno = $row['billnumber'];
                                                                    // $salesQ ="SELECT * FROM sales WHERE billnumber=$bno";
                                                                    // $salesR = mysqli_query($con, $salesQ);
                                                                    // $salesRow = mysqli_fetch_array($salesR);
                                                                    // $S_cate = $salesRow['product_category'];
                                                                    // $S_price = $salesRow['product_price'];
                                                                    // $S_waste = $salesRow['product_wastage'];
                                                                    // $S_gram = $salesRow['product_gram'];
                                                                    ?>
                                                                        <tr>
                                                                        <!-- <input type="hidden" name="bno[]" id="bno" value="<?php echo $bno?>">
                                                                        <input type="hidden" name="total[]" id="total" value="<?php echo $row['total']?>">
                                                                        <input type="hidden" name="balance[]" id="balance<?php echo $id?>" value="<?php echo $row['balance']?>"> -->
                                                                        <!-- <td><?php echo $bno?></td>
                                                                        <td><?php echo date_format(new DateTime($row['date1']),'d-m-Y')?></td> -->
                                                                        <td><?php echo $row['name']?></td>
                                                                        <td><?php echo $row['rollno']?></td>
                                                                        <td><?php echo number_format($row['fee_amount'] ,2)?></td>
                                                                        <td><?php echo number_format($row['paid'])?></td>
                                                                        <td><?php echo number_format($row['balance'])?></td>
                                                                        <td><?php echo number_format($row['balance']) > 0 ? '<i style="font-size:36px;color:red"class="fa fa-exclamation-circle"></i>' : 
                                                                        '<i style="font-size:36px;color:green" class="fa fa-check-circle"></i>' ?></td>
                                                                        <?php 
                                                                            if($row['balance']) {
                                                                                ?>
                                                                                     <!-- <td><input type="text" name="pay[]" id="<?php echo $id;?>" class="form-control" onchange="acheck(this.id)"></td> -->
                                                                                  <td><button type="button" class="identifyingClass btn btn-secondary" data-id="<?php echo $row['rollno'];?>" id="<?php echo $row['rollno'];?>" data-bs-toggle="modal" data-bs-target="#exampleModal">View</button></td>
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                        </tr>
                                                                    <?php
                                                                    $id++;
                                                                }
                                                            } else {
                                                                ?>
                                                                    <tr>
                                                                        <td>No Records..!</td>
                                                                    </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Payment Details</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <div id="datalog"></div>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" id="emiSave" name="emiSave" class="btn btn-primary">Save</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <!-- <?php
                                                    if($count > 0) {
                                                        ?>
                                                            <div class="row d-flex flex-row-reverse">
                                                                <div class="col-md-auto">
                                                                    <input type="submit" name="submit" value="Pay" class="btn btn-primary"/>
                                                                </div>
                                                            </div>
                                                        <?php
                                                    }
                                                ?> -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $(".identifyingClass").click(function () {
            var bno = $(this).data('id');
            $.ajax({
              type: "POST",
              url: "payment_log.php",
              data: {BNO : bno},
              success: function(html){
                  $('#datalog').html(html);
              }
            });
        });

        $('#emiSave').click(function() {
          var payAmount = $('#emi_amount').val();
          var eDate = $('#emi_date').val();
          var bno2 = $('#billNo').val();
          if(payAmount && eDate) {
            $.ajax({
              type: "POST",
              url: "payment_action.php",
              data: {bno : bno2 , pay : payAmount , date1 :eDate,},
              success: function(html){
                  window.location.reload();
              }
            });
          } else {
            alert('Please enter Date and Amount');
          }
        });
      });
</script>
</body>
</html>
<?php
} else {
  echo "<script> window.location.href='index.php'</script>";
}
?>

