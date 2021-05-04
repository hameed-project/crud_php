<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!--Bootstrap CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!--FontAwesome Bootstrap CDN-->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">
    <title>I am Learner</title>
</head>
<body>
    <div class="banner">
         <img class="d-block img-fluid" src="img/banner3.jpg" alt="First slide">
         <div class="carousel-caption">
         <h5>Employee Details - Our Company</h5>
         <p>Create Read Update and Delete Operations</p>
        </div>
   </div>
<?php require_once 'process.php'; ?>
<?php
if(isset($_SESSION['message'])): ?>
<div class="alert alert-<?=$_SESSION['msg_type']?>">
<?php
echo $_SESSION['message'];
unset($_SESSION['message']);
?>
</div>
<?php endif ?>
<div class="container clear-fix">
 <?php
    $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM employee") or die($mysqli->error);
    // pre_r($result->fetch_assoc());
    //  pre_r($result->fetch_assoc());
   ?>
    <div class="row justify-content-center" >
    <table class="table">
    <thead>
    <tr>
    <th>Name</th>
    <th>Address</th>
    <th>Website</th>
    <th>Email</th>
    <th colspan="2">Action</th>
    </tr>
    </thead>
    <?php
        while ($row = $result->fetch_assoc()): ?>
        <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['address']; ?></td>
        <td><?php echo $row['website']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td>
            <a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info">Edit</a>
            <a href="index.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
        </td>
        </tr>
    <?php endwhile; ?>
    </table>
    </div>
    <?php
     function pre_r ( $array ) {
         echo '<pre>';
             print_r($array);
             echo '</pre>';
     }
    ?>
    <div class="row justify-content-center clear-fix">
        <form action="process.php" method="POST">
            <input type ="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="<?php echo $address; ?>" placeholder="Enter your address">
            </div>
             <div class="form-group">
                <label>Website</label>
                <input type="text" name="website" class="form-control" value="<?php echo $website; ?>" placeholder="Enter your website">
            </div>
               <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Enter your email">
            </div>
            <div class="form-group">

            <?php
            if($update == true): ?>
            <button type="submit" class="btn btn-info" name="update">Update</button>
            <?php else: ?>
                <button type="submit" class="btn btn-primary" name="save">Save</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
    </div>
</body>
</html>