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
</head>
<body class="login-bg">
<div class="container-fluid mt-3">
  <center>
  <div class="card h-100 bg-light mb-3" style="max-width: 540px;margin-top:15rem;">
    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="./assets/logo.jpg" class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-6">
        <div class="card-body">
          <h5 class="card-title">Welcome</h5>
            <form action="login.php" method="POST" class="align-items-center">
              <div class="row row row-cols-lg-auto g-4">
                <div class="col-12">
                  <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
                  <div class="input-group">
                    <div class="input-group-text">@</div>
                    <input type="text" class="form-control" name="username" id="inlineFormInputGroupUsername" placeholder="Username">
                  </div>
                </div>
                <div class="col-12">
                  <label class="visually-hidden" for="inlineFormInputGroupUsername">Password</label>
                  <div class="input-group">
                    <div class="input-group-text">@</div>
                    <input type="password" class="form-control" name="password" id="inlineFormInputGroupUsername" placeholder="Password">
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-12">
                  <input type="submit" class="btn btn-primary" value="Login">
                </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  </center>
</div>
</body>
</html>


