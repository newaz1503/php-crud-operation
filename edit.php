<?php 
    include("database.php");
    $database = new Database();
    //store value into database
    if(isset($_GET['status'])) {
        if($_GET['status']=='edit'){
            $id=$_GET['id'];
           $user_data=$database->read_data_by_id($id);
        }
    }
    if(isset($_POST['update_btn'])){
        $message = $database->update_data($_POST);
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Php CRUD System</title>
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
        <form  action="" method="post" enctype="multipart/form-data" class="row g-3" novalidate>
            <div class="col-md-12">
                <label for="validationCustom01" class="form-label"><strong>Username</strong></label>
                <input type="text" class="form-control" name="u_username" id="validationCustom01" value="<?php echo $user_data['username'] ?>">
            </div>
            <div class="col-md-12">
                <label for="validationCustom02" class="form-label"><strong>Email</strong></label>
                <input type="email" class="form-control" name="u_email" id="validationCustom02" value="<?php echo $user_data['email'] ?>">
            </div>
            <div class="col-md-12">
                <label for="validationCustom02" class="form-label"><strong>Phone</strong></label>
                <input type="number" class="form-control" name="u_phone" id="validationCustom02" value="<?php echo $user_data['phone'] ?>">
            </div>
            <div class="col-md-12">
                <label for="validationCustom02" class="form-label"><strong>Image</strong></label>
                <input type="file" class="form-control" name="u_image" id="validationCustom02">
                <img src="uploads/images/<?php echo $user_data['image'] ?>" width="120" height="100" />
            </div>
            <input type="hidden" name="user_id" value="<?php echo $user_data['id']; ?>">
            <div class="col-12 pt-4">
                <input class="btn btn-primary" type="submit" name="update_btn" value="update">
                <a href="index.php" class="btn btn-warning">Home</a>
            </div>
         </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>