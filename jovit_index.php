<?php
session_start(); // Start the session
include('../jovit_connection.php');

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EXERCISE 2 CRUD OPERATIONS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--CSS links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="...">
</head>

<body>


    <!-- Insert Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Details Here</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <form action="jovit_actions.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="firstName" placeholder="Enter First Name" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="lastName" placeholder="Enter Last Name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Birth Date</label>
                            <input type="date" class="form-control" name="birthDate" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="address" placeholder="Enter Your Address" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Gender</label>
                        </div>
                        <div class="form-group mb-3">

                            <input type="radio" name="gender" class="" value="0" id="male" required>
                            <label for="male">Male</label>

                        </div>
                        <div class="form-group mb-3">
                            <input type="radio" name="gender" class="" value="1" id="female" required>
                            <label for="male">Female</label>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="saveBtn" class="btn btn-dark">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editDataLabel">Edit Details Here</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <form action="jovit_actions.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <input type="hidden" class="form-control" id="user_id" name="id">
                        </div>

                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="fName" name="firstName">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="lName" name="lastName">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Birth Date</label>
                            <input type="date" class="form-control" id="bDate" name="birthDate">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Gender</label>
                        </div>
                        <div class="form-group mb-3">

                            <input type="radio" name="gender" id="gender" class="" value="0" id="male" required>
                            <label for="male">Male</label>

                        </div>
                        <div class="form-group mb-3">
                            <input type="radio" name="gender" id="gender" class="" value="1" id="female" required>
                            <label for="male">Female</label>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="updateBtn" class="btn btn-dark">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <!-- message when successfully inserted -->

                <?php
                if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey!!</strong> <?php echo $_SESSION['status']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    unset($_SESSION['status']);
                }


                ?>


            </div>


            <div class="card border-dark">
                <div class="card-header border-dark">
                    <h4 class="text-center">EXERCISE 3 PDF</h4>
                    <!-- Button trigger modal -->
                    <div class="float-end">
                        <!-- buttons -->
                        <a href="jovit_pdf.php" class="btn btn-dark"><i class="fas fa-print"></i> PDF</a>
                        <a href="jovit_csv.php" class="csv btn btn-dark"><i class="fas fa-print"></i> CSV</a>
                        <button type="button" class="btn btn-dark ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fas fa-plus me-2"></i> Add
                        </button>

                    </div>


                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered   text-center">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">FIRST NAME</th>
                                <th scope="col">LAST NAME</th>
                                <th scope="col">GENDER</th>
                                <th scope="col">BIRTH DATE</th>
                                <th scope="col">ADDRESS</th>
                                <th scope="col">DEPARTMENT</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $query = "SELECT * FROM tbl_jovit";
                            $queryRes = $conn->query($query);

                            if (mysqli_num_rows($queryRes) > 0) {
                                $idNumber = 0;
                                while ($row = mysqli_fetch_array($queryRes)) {
                            ?>
                                    <tr>
                                        <th class="userId" scope="row"><?php echo ++$idNumber; ?></th>
                                        <td><?php echo $row["firstName"]; ?></td>
                                        <td><?php echo $row["lastName"]; ?></td>
                                        <td><?php echo $row["gender"] == 0 ? "Male" : "Female"; ?></td>
                                        <td><?= date('F j, Y', strtotime($details['birthDate'])); ?></td>
                                        <td><?php echo $row["address"]; ?></td>
                                        <td><?php echo $row["departmentName"]; ?></td>
                                        <td>

                                            <!-- action buttons -->
                                            <a href="#" class="link-dark text-danger me-2 deleteBtn"><i class="fas fa-trash"></i></a>
                                            <a href="#" class="link-dark text-primary editBtn"><i class="far fa-edit"></i></a>
                                            <!-- <a href="#" class="link-dark text-primary viewBtn"><i class="far fa-eye"></i></a> -->

                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr colspan="4">No Record Found</tr>
                            <?php
                            }
                            ?>






                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>





    <!-- JS LINKS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- <script>
   $(document).ready(function(){
        $('.editBtn').click(function(e){
            e.preventDefault();
            
           var userId = $(this).closest('tr').find('.userId').text();
           console.log(userId); // Corrected variable name to match 'userId'

            $.ajax({
                method: "POST",
                url: "jovit_actions.php",
                data: {
                    'clickEditBtn': true,
                    'userId':userId,
                },
                success: function (response){
                    console.log(response);
                   
                    // $('#editData').modal('show');
                }
            });

        });
   });
</script> -->

    <script>
        //update
        $(document).ready(function() {
            $('.editBtn').click(function(e) {
                e.preventDefault();

                var userId = $(this).closest('tr').find('.userId').text();

                $.ajax({
                    method: "POST",
                    url: "jovit_actions.php",
                    data: {
                        'editBtn': true,
                        'userId': userId,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response && response.length > 0) {
                            $.each(response, function(index, item) {
                                $('#user_id').val(item.id);
                                $('#fName').val(item.firstName);
                                $('#lName').val(item.lastName);
                                $('#bDate').val(item.birthDate);
                                $('#address').val(item.address);
                                $('#gender').val(item.gender);
                                // Set other input values similarly if neede
                            });
                            $('#editData').modal('show');
                        } else {
                            console.log("No data found");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            });
        });

        //delete
        //delete
        $(document).ready(function() {
            $('.deleteBtn').click(function(e) {
                e.preventDefault();

                var userId = $(this).closest('tr').find('.userId').text();

                $.ajax({
                    method: "POST",
                    url: "jovit_actions.php",
                    data: {
                        'deleteBtn': true,
                        'userId': userId, // Change 'user_id' to 'userId' to match the PHP script
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        // Refresh the page or update UI after successful deletion
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            });
        });
    </script>




</body>

</html>