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
  <link rel="stylesheet" href="./bs/boostrap-icons.css">
  <script src="./bs/bootstrap.bundle.min.js"></script>
  <link href="./krp.css" rel="stylesheet">
  <style>
    nav {
        background-color: linear-gradient(blue, pink) !important;
    }
  </style>
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
          <a class="nav-link" target="_blank" href="./reports_print.php">Reports</a>
        </li>
      </ul>
      <form class="d-flex">
        <a href="./logout.php" class="btn btn-danger" data-toggle="modal" data-target="#logoutModal">Logout</a>
      </form>
    </div>
  </div>
</nav>
<div class="container">
  <?php 
    require './config.php';
    $stuQ = "SELECT COUNT(`rollno`) AS CA FROM `students`";
    $stuR = mysqli_query($con,$stuQ);
    $stuRow = mysqli_fetch_array($stuR);
    $STUDENTS = $stuRow['CA'];


    $payQ = "SELECT SUM(`fee_amount`) AS AM, SUM(`balance`) AS DM FROM `payment`";
    $payR = mysqli_query($con,$payQ);
    $payRow = mysqli_fetch_array($payR);
    $PAY_TOTAL = $payRow['AM'];
    $PAY_DUE = $payRow['DM'];
  ?>
  <div class="row mt-5">
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Students</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">  <?php echo $STUDENTS; ?></div>
                  </div>
                  <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Amount</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"> &#x20b9 <?php echo $PAY_TOTAL; ?></div>
                  </div>
                  <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Due Amount</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"> &#x20b9 <?php echo $PAY_DUE; ?></div>
                  </div>
                  <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<?php
} else {
  echo "<script> window.location.href='index.php'</script>";
}
?>


