<?php 
    include("database.php");
    $database = new Database();
    //store value into database
    if(isset($_POST['submit'])){
       $message = $database->add_data($_POST);
    }
    //rretriev data
    $users = $database->read_data();
    //delete data
    if(isset($_GET['status'])){
        if($_GET['status']=='delete'){
            $id=$_GET['id'];
            $message = $database->delete_user($id);
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Php Crud System</title>
  </head>
  <body>
    <div class="container mt-5 py-4 shadow-sm">
        <a href="index.php" class="btn btn-primary">Home</a>
        <br/>
        <?php 
            if(isset($message)){
                echo $message;
            }
        ?>    
        <h2 class="text-center"><a href="index.php" class="text-decoration-none text-reset">PHP CRUD OPERATION</a></h2>
        <form  action="" method="post" enctype="multipart/form-data" class="row g-3 needs-validation">
            <div class="col-md-12">
                <label for="validationCustom01" class="form-label"><strong>Username</strong></label>
                <input type="text" class="form-control" name="username" id="validationCustom01" placeholder="Enter Username" required>
            </div>
            <div class="col-md-12">
                <label for="validationCustom02" class="form-label"><strong>Email</strong></label>
                <input type="email" class="form-control" name="email" id="validationCustom02" placeholder="Enter Email" required>
            </div>
            <div class="col-md-12">
                <label for="validationCustom02" class="form-label"><strong>Phone</strong></label>
                <input type="number" class="form-control" name="phone" id="validationCustom02" placeholder="Enter Phone" required>
            </div>
            <div class="col-md-12">
                <label for="validationCustom02" class="form-label"><strong>Image</strong></label>
                <input type="file" class="form-control" name="image" id="validationCustom02">
            </div>
            <div class="col-12 pt-4">
                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            </div>
         </form>
    </div>

    <!-- Result -->
    <div class="container my-5 py-4 shadow-sm">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($user=mysqli_fetch_assoc($users)) { ?>
                <tr>
                    <td><?php echo $user['id']?></td>
                    <td><?php echo $user['username']?></td>
                    <td><?php echo $user['email']?></td>
                    <td><img src="uploads/images/<?php echo $user['image'] ?>" alt="user image" width="60" height="60" /></td>
                    <td><?php echo $user['phone']?></td>
                    <td>
                        <a href="edit.php?status=edit&&id=<?php echo $user['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="?status=delete&&id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

   



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>