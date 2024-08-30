
<?php
    $id="";
    $name = "";
    $email = "";
    $phone = "";
    $address = "";

    $errorMessage = "";
    $successMeaasge = "";
    
    $connection = new mysqli('localhost', 'root', '', 'crudoperations');
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
    
    if (!isset($_GET["id"])){
        header("location:showdata.php");
        exit;

    }
    $id= $_GET["id"];

    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location:showdata.php");
        exit;
    }

    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
}
else{

  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  do{
    if (empty($id) || empty($name) || empty($email) || empty($phone) || empty($address)) {
      $errorMessage = "All the fields are required";
      break;
  }

  $sql="UPDATE clients SET name='$name', email='$email', phone= '$phone',
  address= '$address' WHERE id=$id";

  $result = $connection->query($sql);

  if (!$result) {
    $errorMessage = "invalid query: " . $connection->error;
    break;
  }

  $successMeaasge = "Client updated correctly";

  header("location:showdata.php");
  exit;

  }while(false);
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
    <style>
      .form-group {
        display: flex;
        justify-content: center;
        align-items: center;
      }
    </style>
  </head>
  <body>
    <div class="container my-5">
      <h2>New Client</h2>
      <form method="post">
        <input type="hidden" name='id' value="<?php echo $id ?>">
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
  </body>
</html>
