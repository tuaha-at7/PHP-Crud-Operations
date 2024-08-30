<?php

$name = "";
$email = "";
$phone = "";
$address = "";
$err=false;
$errpos=false;


$connection = new mysqli('localhost', 'root', '', 'crudoperations');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $err=true;
            

            break;
        }
// Insert the new client
$sql = "INSERT INTO clients (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
$result = mysqli_query($connection, $sql);
$errpos=true;

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

else{
//Clear the form fields after successful insertion
$name = "";
$email = "";
$phone = "";
$address = "";
echo "<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'success',
        title: 'Great👍',
        text: 'Data Entered!'
    });
});
</script>";
showAlert();
header("Location: showdata.php");


exit;
}
        // Check if the email already exists
        $checkEmail = "SELECT email FROM clients WHERE email='$email'";
        $result = mysqli_query($connection, $checkEmail);
        
        if (mysqli_num_rows($result) > 0) {
            $errorMessage = "Email already exists";
            echo $errorMessage;
            break;
        }

        
    } while (false);
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Data Enter</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </head>
  <body>
    <div class="container my-5">
      <h2>New Client</h2>
      <form method="post">
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Name</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Email</label>
          <div class="col-sm-6">
            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Phone</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Address</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
          </div>
        </div>
        <div class="row mb-3">
          <div class="offset-sm-3 col-sm-3 d-grid">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          <div class="col-sm-3 d-grid">
            <a href="showdata.php" class="btn btn-outline-primary" role="button">Cancel</a>
          </div>
        </div>
      </form>
    </div>
    <?php
    if($err){
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill all the fields!'
            });
        </script>";
    }
    if($errpos){
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Great👍',
                    text: 'Data Entered!'
                });
            </script>";
        }
        function showAlert() {
          echo "<script>
                  document.addEventListener('DOMContentLoaded', function() {
                      Swal.fire({
                          icon: 'success',
                          title: 'Great👍',
                          text: 'Data Entered!'
                      });
                  });
                </script>";
      }
       
    
    ?>

  </body>
</html>
