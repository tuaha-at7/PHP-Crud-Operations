<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <title>Data</title>

   
  </head>
  <body>
    <div class="container my-5">
        <h2>List of Clients</h2>
        <a href="demo.php" class="btn btn-primary" role="button">New Clients</a>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php

                $connection=new mysqli('localhost','root','','crudoperations');
                if($connection->connect_error){
                    die("Connection Failed:".$connection->connect_error);
                }

                $sql ="SELECT * FROM clients";
                $result =$connection->query($sql);

                if(!$result){
                    die("Invalid query:". $connection->error);
                }

                while($row = $result->fetch_assoc()){
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td>$row[phone]</td>
                        <td>$row[address]</td>
                        <td>$row[created_at]</td>
                        <td>
                            <a href='edit.php?id=$row[id]' class='btn btn-primary btn-sm'>Edit</a>
                            <a href='delete.php?id=$row[id]' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                    </tr>
                    ";
                    
                }

                ?>
               
            </tbody>
        </table>
    </div>
    
  </body>
  </html>