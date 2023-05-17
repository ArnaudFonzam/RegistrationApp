<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Contact</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="jquery.min.js_3.5.1/cdnjs/css/datatable.min.css">
    <script src = "bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <script src = "jquery.min.js_3.5.1/cdnjs/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>  
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-secondary navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="image/profil.png" alt="Avatar Logo" style="width:60px;" class="rounded-pill"> <br>
                <?php echo $_SESSION['username']; ?>
            </a>
            <form class="d-flex" action="logout.php" method="post">
              <button class="btn btn-primary" type="sumit">Logout</button>
            </form>
          </div>
        </div>
    </nav>
   <div class="container">
      <div class="mt-4 p-5 bg-light text-dark rounded">
        <h2 >Manage your Contact easyly</h2>
        <div class="card"> 
            <div class="card-body"> 
            <div id="button">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
                    ADD Contact
                </button>
                <button type="submit" class="btn btn-primary printToPDF">Print To PDF</button>
                <button type="submit" class="btn btn-primary printToExcel">Print To Excel</button> 
            </div>
            <!-- The Modal For Addind contact-->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content"> 
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="text-dark">ADD Contact</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="create.php" method="POST">
                          <!-- Modal body -->
                          <div class="modal-body">
                        
                              <input type="text" class="box-input" name="firstname" placeholder="first name" required>
                              <input type="text" class="box-input" name="lastname" placeholder="last name" required>
                              <input type="text" class="box-input" name="phone" placeholder="phone number" required>
                              <input type="text" class="box-input" name="invitedby" placeholder="invited by" required>
                          </div>
                          <!-- Modal footer -->
                          <div class="modal-footer">
                              <input type="submit" name ="savedata" class="box-button"  value="Save">
                          </div>
                        </form>

                        </div>
                    </div>
                </div>
                 <!-- The Modal For Edit  contact-->
                <div class="modal" id="editmodal">
                    <div class="modal-dialog">
                        <div class="modal-content"> 
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="text-dark">Edit Contact</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="update.php" method="POST">
                              <!-- Modal body -->
                              <div class="modal-body">
                                  <input type="hidden" name="update_id" id="id">
                                  <input type="text" class="box-input" id="fname" name="fname" placeholder="first name" required>
                                  <input type="text" class="box-input" id="lname" name="lname" placeholder="last name" required>
                                  <input type="text" class="box-input" id="phone" name="phone" placeholder="phone number" required>
                                  <input type="text" class="box-input" id="invitedby" name="invitedby" placeholder="invited by" required>
                              </div>
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                  <input type="submit" name ="updatedata" class="box-button"  value="Update">
                              </div>
                            </form>
                            </div>
                        </div>
                    </div>
                     <!-- The Modal For delete  contact-->
                <div class="modal" id="deletemodal">
                    <div class="modal-dialog">
                        <div class="modal-content"> 
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="text-dark">Delete Contact</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="delete.php" method="POST">
                              <!-- Modal body -->
                              <div class="modal-body">
                                  <input type="hidden" name="delete_id" id="delete_id">
                                  <h3> Did you need to delete this ligne?</h3>
                              </div>
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                  <input type="submit" name ="deletedata" class="box-button"  value="Delete">
                              </div>
                            </form>

                            </div>
                        </div>
                    </div>
                    <div class="modal" id="printmodalp">
                    <div class="modal-dialog">
                        <div class="modal-content"> 
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="text-dark">Add Range To Print To PDF</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="test.php" method="POST">
                              <!-- Modal body -->
                              <div class="modal-body">
                                <label for="From">De</label>
                                <input type="date" class="box-input" name="dateFrom"><br>
                                <label for="To">A</label><br>
                                <input type="date" class="box-input" name="dateTo">
                              </div>
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                  <input type="submit" name ="deletedata" class="box-button"  value="Print To PDF">
                              </div>
                            </form>

                            </div>
                        </div>
                    </div>
                    <div class="modal" id="printmodalx">
                    <div class="modal-dialog">
                        <div class="modal-content"> 
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="text-dark">Add Range To Print To Excel</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="excelfile.php" method="POST">
                              <!-- Modal body -->
                              <div class="modal-body">
                                <label for="From">De</label>
                                <input type="date" class="box-input" name="dateFrom" ><br>
                                <label for="To">A</label><br>
                                <input type="date" class="box-input" name="dateTo">
                              </div>
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                  <input type="submit" name ="deletedata" class="box-button"  value="Print To Excel">
                              </div>
                            </form>

                            </div>
                        </div>
                    </div>
                <?php
                require_once "config.php";
                $query = "select * from personne";
                $query_num = mysqli_query($conn, $query);
                
                ?>
                <table class="table table-striped table-striped" id="dtBasicExample"> 
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Phone</th>
                        <th>Invited By</th>
                        <th>update</th>
                        <th>delete</th>
                      </tr>
                    </thead>
                    <?php
                    if($query_num){
                      foreach($query_num as $row)
                      {
                   ?>
                      
                    <tbody>  
                       <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['invitedby']; ?></td>
                        <td><button class="btn btn-info editbtn">Edit</button></td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
                        <td><button class="btn btn-danger deletebtn">Delete</button></td>
                      </tr>
                    </tbody>
                   <?php
                      }
                    }else{
                      echo " No Record Found";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
   </div>
   <div class="footer">
    @2022
   </div>
   <!-- Paging JS -->
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="js/paging.js"></script> 
  <script type="text/javascript">
              $(document).ready(function() {
                  $('#dtBasicExample').paging({limit:5});
              });
  </script>
   <!-- Paging JS -->
   <script>
    $(document).ready(function(){
      $('.editbtn').on('click', function(){
        $('#editmodal').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
          return $(this).text();
        }).get();
        $('#id').val(data[0]);
        $('#fname').val(data[1]);
        $('#lname').val(data[2]);
        $('#phone').val(data[3]);
        $('#invitedby').val(data[4]);
      });
    });
   </script>
   <script>
    $(document).ready(function(){
      $('.deletebtn').on('click', function(){
        $('#deletemodal').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
          return $(this).text();
        }).get();
        $('#delete_id').val(data[0]);
      });
    });
   </script>
   <script>
    $(document).ready(function(){
      $('.printToPDF').on('click', function(){
        $('#printmodalp').modal('show');
      });
    });
   </script>
   <script>
    $(document).ready(function(){
      $('.printToExcel').on('click', function(){
        $('#printmodalx').modal('show');
      });
    });
   </script>
  <style type="text/css">

    .paging-nav {
      text-align: right;
      padding-top: 2px;
    }

    .paging-nav a {
      margin: auto 1px;
      text-decoration: none;
      display: inline-block;
      padding: 1px 7px;
      background: #91b9e6;
      color: white;
      border-radius: 3px;
    }

    .paging-nav .selected-page {
      background: #187ed5;
      font-weight: bold;
    }

    .paging-nav,
    #tableData {
      width: 400px;
      margin: 0 auto;
      font-family: Arial, sans-serif;
    }
  </style>

</body>
</html>