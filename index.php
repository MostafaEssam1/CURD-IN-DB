<?php
$host = "localhost";
$user = 'root';
$password = "";
$dbName = "shop";
$conn = mysqli_connect($host, $user, $password, $dbName);
######## connect done ########

######## CURD ########

######## CREATE ########
if(isset($_POST['send'])){
    $name = $_POST['CourseName'];
    $cost = $_POST['CostValue'];
    $insert = "INSERT INTO `courses` VALUES (null ,'$name' ,$cost)";
    $i = mysqli_query($conn , $insert);
    if($i){
        echo '<div class="alert mx-auto w-50 alert-info"> Insert Data Done</div>';
    }
}

######## READ ########
$select = "SELECT * FROM `courses`";
$s = mysqli_query($conn ,$select);

#empty value#
$name ='';
$cost ='';
$update = false;
######## UPDATE ########
if(isset($_GET['edit'])){
    $update = true ;
    $id = $_GET['edit'];

    $select = "SELECT * FROM `courses` where id = $id";
    $ss = mysqli_query($conn ,$select);
    $row = mysqli_fetch_assoc($ss);
    $name = $row['name'];
    $cost = $row['cost'];

    if(isset($_POST['update'])){
        $name = $_POST['CourseName'];
        $cost = $_POST['CostValue'];
        $update = "UPDATE `courses` SET `name` = '$name' ,cost = $cost where id = $id "; 
        $u = mysqli_query($conn , $update);
        header('location: index.php');
    }
}
######## DELETE ########
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete ="DELETE FROM `courses` where id =$id";
    $d = mysqli_query($conn ,$delete);
    header('location: index.php');
}

######## CURD done ########
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
     
</head>
<body>
<div class="container col-6 mt-5 text-center">
    <div class="card card-body">
    <form method="POST">
        <div class="form-group">
        <label>Course Name</label>
        <input type="text" value="<?php echo $name ?>" name="CourseName" class="form-control" placeholder="Course Name">
        </div>

        <div class="form-group">
        <label>Course Cost</label>
        <input type="text" <?php echo $cost ?> name="CostValue" class="form-control" placeholder="Course Cost">
        </div>
        
        <?php if($update): ?>
        <button class="btn btn-warning" name="update">Update Data</button>
        <?php else :?>
        <button class="btn btn-info" name="send">Send Data</button>
        <?php endif; ?>
    </form>
    </div>
</div>


    <div class="container col-6 mt-5 text-center">
        <table class="table table-dark">
            <tr>
                <th>ID<th>
                <th>Name</th>
                <th>Cost</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
            <?php foreach($s as $data) {?>
            <tr>
                <th> <?php echo $data['id']?> </th>
                <th></th>
                <th> <?php echo $data['name']?> </th>
                <th> <?php echo $data['cost']?> </th> 
                <th><a onclick="return confirm('Are You Sure)" href="index.php?delete=<?php echo $data['id']?>" class="btn btn-danger">Delete</a></th>
                <th><a href="index.php?edit=<?php echo $data['id']?>" class="btn btn-info">edit</a></th>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>