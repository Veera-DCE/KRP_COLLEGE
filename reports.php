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
<div class="row g-4 justify-content-center mt-5">
            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-8">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        Reports
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="reports_print.php" method="POST" target="_blank">
                            <div class="row">
                                <div class="col-md-3">
                                    <label> Start Date</label>
                                    <input type="date" class="form-control" name="sDate" id="sDate">
                                </div>
                                <div class="col-md-3">
                                  <label> End Date </label>
                                    <input type="date" class="form-control" name="eDate" id="eDate">
                                </div>
                                <br>
                                <div class="col-md-2">
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Search">
                                </div>
                            </div>
                        </form>
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

