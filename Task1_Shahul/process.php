<?php
$conn = new mysqli('localhost', 'root', '', 'crud');
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
$id = 0;
$update = false;
$name = '';
$address = '';
$website = '';
$email = '';

// Save function
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $website = $_POST['website'];
    $email = $_POST['email'];

    $mysqli->query("INSERT INTO employee (name, address, website, email) VALUES ('$name', '$address', '$website', '$email')") or die($mysqli->error);
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location:index.php");
}

// Delete function
if(isset($_GET['delete'])){
$id = $_GET['delete'];
$mysqli->query("DELETE FROM employee WHERE id=$id") or die($mysqli->error());
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location:index.php");
}

// Edit function
if(isset($_GET['edit'])){
$id = $_GET['edit'];
$update= true;
$result=$mysqli->query("SELECT * FROM employee WHERE id=$id") or die($mysqli->error());
   if (count(['$result'])==1){
       $row = $result->fetch_array();
        $name = $row['name'];
        $address = $row['address'];
         $website = $row['website'];
         $email = $row['email'];
   }
}

// Update function
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $website = $_POST['website'];
    $email = $_POST['email'];
    $sql = "UPDATE employee SET name='$name', address='$address', website='$website', email='$email' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "warning";
        header("location:index.php");
    } else {    
        echo "Error updating record: " . mysqli_error($conn);
    }
}
