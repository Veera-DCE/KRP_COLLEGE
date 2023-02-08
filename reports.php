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
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Payments
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="./payment.php">College Fee</a></li>
            <li><a class="dropdown-item" href="./trans_payment.php">Transport Fee</a></li>
          </ul>
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
<div class="row g-4 justify-content-center mt-5">
            <!-- Area Chart -->
            <div class="col-xl-10 col-lg-10">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        Reports
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="reports_print.php" method="POST" target="_blank">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Category</label>
                                    <select name="category" id="category" class="form-select" required>
                                      <option value="" disabled selected> -- Select -- </option>
                                      <option value="Paid">Paid List</option>
                                      <option value="Pending">Pending List</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Fee Type</label>
                                    <select name="fType" id="fType" class="form-select" required>
                                      <option value="" disabled selected> -- Select -- </option>
                                      <option value="college">College Fee</option>
                                      <option value="transport">Transport Fee</option>
                                    </select>
                                </div>
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

