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
          <a class="nav-link" href="./sales.php">Students</a>
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

<div class="container-fluid">
    <div class="row g-4 justify-content-center mt-5">
        <div class="col-xl-10 col-lg-10">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    Students
                    <div class="btnAdd">
                      <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal"   class="btn btn-danger btn-sm" >Add Students</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="example" class="table">
                                        <thead>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Behaviour</th>
                                            <th>Fee Amount</th>
                                            <th>Options</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>
                    </div>
              </div>
              <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/af-2.3.7/date-1.1.0/r-2.2.9/rg-1.1.3/sc-2.0.4/sp-1.3.0/datatables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable({
        "fnCreatedRow": function( nRow, aData, iDataIndex ) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide':'true',
        'processing':'true',
        'paging':'true',
        'order':[],
        'ajax': {
          'url':'fetch_students_data.php',
          'type':'post',
        },
        "columnDefs": [{
          'target':[5],
          'orderable' :false,
        }]
      });
    } );
    $(document).on('submit','#addCustomer',function(e){
      e.preventDefault();
      var sName= $('#stu_name').val();
      var sRollno= $('#stu_rollno').val();
      var sAddress= $('#stu_address').val();
      var sBeha= $('#stu_beha').val();
      var sAmount = $('#stu_amount').val();
      if(sName != '' && sRollno != '' && sAddress != '' && sBeha !='' && sAmount != '')
      {
       $.ajax({
         url:"add_student.php",
         type:"post",
         data:{c1:sName,c2:sRollno,c3:sAddress,c4:sBeha,c5:sAmount},
         success:function(data)
         {
           var json = JSON.parse(data);
           var status = json.status;
           if(status == 'duplicate') {
              alert('Student already exists..!');
              $('#stu_name').val('');
              $('#stu_rollno').val('');
              $('#stu_address').val('');
              $('#stu_beha').val('');
              $('#stu_amount').val('');
           }
           else if(status=='true')
           {
            mytable =$('#example').DataTable();
            mytable.draw();
            $('#stu_name').val("");
            $('#stu_rollno').val("");
            $('#stu_address').val("");
            $('#stu_beha').val("");
            $('#stu_amount').val('');
            $('#addUserModal').modal('hide');
          }
          else
          {
            alert('failed');
          }
        }
      });
     }
     else {
      alert('Fill all the required fields');
    }
  });
    $(document).on('submit','#updateUser',function(e){
      e.preventDefault();
      var sName= $('#Ustu_name').val();
      var sRollno= $('#Ustu_rollno').val();
      var sAddress= $('#Ustu_address').val();
      var sBeha= $('#Ustu_beha').val();
      var sAmount= $('#Ustu_amount').val();
      var trid= $('#trid').val();
      var id= $('#id').val();
      if(sName != '' && sRollno != '' && sAddress != '' && sBeha !='' && sAmount != '')
      {
         $.ajax({
           url:"update_student.php",
           type:"post",
           data:{c1:sName,c2:sRollno,c3:sAddress,c4:sBeha,c5:sAmount,id:id},
           success:function(data)
           {
             var json = JSON.parse(data);
             var status = json.status;
             if(status=='true')
             {
              table =$('#example').DataTable();
              // table.cell(parseInt(trid) - 1,0).data(id);
              // table.cell(parseInt(trid) - 1,1).data(username);
              // table.cell(parseInt(trid) - 1,2).data(email);
              // table.cell(parseInt(trid) - 1,3).data(mobile);
              // table.cell(parseInt(trid) - 1,4).data(city);
              var button =   '<td><a href="javascript:void();" data-id="' +id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' +id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
              var row = table.row("[id='"+trid+"']");
              row.row("[id='" + trid + "']").data([id,sName,sRollno,sAddress,sBeha,sAmount,button]);
              $('#exampleModal').modal('hide');
            }
            else
            {
              alert('failed');
            }
          }
        });
       }
       else {
        alert('Fill all the required fields');
      }
    });
    $('#example').on('click','.editbtn ',function(event){
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
     // console.log(selectedRow);
     var id = $(this).data('id');
     $('#exampleModal').modal('show');

     $.ajax({
      url:"get_single_data_student.php",
      data:{id:id},
      type:'post',
      success:function(data)
      {
       var json = JSON.parse(data);
        $('#Ustu_name').val(json.name);
        $('#Ustu_rollno').val(json.rollno);
        $('#Ustu_address').val(json.address);
        $('#Ustu_beha').val(json.behaviour);
        $('#Ustu_amount').val(json.fee_amount);
       $('#id').val(id);
       $('#trid').val(trid);
     }
   })
   });

    $(document).on('click','.deleteBtn',function(event){
       var table = $('#example').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if(confirm("Are you sure want to delete this Customer ? "))
      {
      $.ajax({
        url:"delete_customer.php",
        data:{id:id},
        type:"post",
        success:function(data)
        {
          var json = JSON.parse(data);
          status = json.status;
          if(status=='success')
          {
            //table.fnDeleteRow( table.$('#' + id)[0] );
             //$("#example tbody").find(id).remove();
             //table.row($(this).closest("tr")) .remove();
             $("#"+id).closest('tr').remove();
          }
          else
          {
            alert('Failed');
            return;
          }
        }
      });
      }
      else
      {
        return null;
      }



    })
 </script>
 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updateUser" >
          <input type="hidden" name="id" id="id" value="">
          <input type="hidden" name="trid" id="trid" value="">
          <div class="mb-3 row">
            <label for="addEmailField" class="col-md-3 form-label">Name</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="Ustu_name" name="Ustu_name">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addEmailField" class="col-md-3 form-label">Roll No</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="Ustu_rollno" name="Ustu_rollno">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addCityField" class="col-md-3 form-label">Address</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="Ustu_address" name="Ustu_address">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addCityField" class="col-md-3 form-label">Behaviour</label>
            <div class="col-md-9">
              <!-- <input type="text" class="form-control" id="stu_beha" name="stu_beha"> -->
              <select class="form-select" id="Ustu_beha" name="Ustu_beha">
                  <option value="" selected disabled> -- Select --</option>
                  <option value="Regular">Regular</option>
                  <option value="NonRegular">NonRegular</option>
              </select>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addCityField" class="col-md-3 form-label">Fee Amount</label>
            <div class="col-md-9">
              <input type="number" class="form-control" id="Ustu_amount" name="Ustu_amount">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-link" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
       </form>
    </div>
  </div>
</div>

<!-- Add user Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addCustomer" action="">
          <div class="mb-3 row">
            <label for="addEmailField" class="col-md-3 form-label">Name</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="stu_name" name="stu_name">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addEmailField" class="col-md-3 form-label">Roll No</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="stu_rollno" name="stu_rollno">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addCityField" class="col-md-3 form-label">Address</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="stu_address" name="stu_address">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addCityField" class="col-md-3 form-label">Behaviour</label>
            <div class="col-md-9">
              <!-- <input type="text" class="form-control" id="stu_beha" name="stu_beha"> -->
              <select class="form-select" id="stu_beha" name="stu_beha">
                  <option value="" selected disabled> -- Select --</option>
                  <option value="Regular">Regular</option>
                  <option value="NonRegular">NonRegular</option>
              </select>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addCityField" class="col-md-3 form-label">Fee Amount</label>
            <div class="col-md-9">
              <input type="number" class="form-control" id="stu_amount" name="stu_amount">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
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
