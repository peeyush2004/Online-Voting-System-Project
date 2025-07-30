<?php
session_start(); 
if(!isset($_SESSION['id'])){
    header('location:../');
}

// Check if $_SESSION['data'] is set and not null
if(isset($_SESSION['data']) && $_SESSION['data'] !== null) {
    $data = $_SESSION['data'];
    if($_SESSION['status']==1){
        $status='<b class="text-warning">Voted</b>';
    }else{
        $status='<b class="text-danger">Not Voted</b>';
    }
} else {
    // Handle the case where data is missing or not properly set
    // For example, you might want to redirect the user to a login page
    // or display an error message.
    // Replace the following line with appropriate handling.
    die("Data not available.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting system -Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-secondary text-light">
    <div class="container my-5">
<a href="../"><button class="btn btn-dark text-light px-3">Back</button></a>
<a href="logout.php"><button class="btn btn-dark text-light px-3">Logout</button></a>
<h1 class="my-3">Voting System</h1>
<div class="row my-5">
    <div class="col-md-7">
        
        <?php
        if(isset($_SESSION['groups'])){
           $groups=$_SESSION['groups'];
           for($i=0;$i<count($groups);$i++){
        
            ?>
            <div class="row">
            <div class="col-md-4">
                <img src="../uploads/<?php echo $groups[$i]['photo'] ?>" 
                alt="Group image">
            </div>
            <div class="col-md-8">
                <strong class="text-dark h5">Group name:</strong>
                <?php echo $groups[$i]['username'] ?>
                <br>
                <strong class="text-dark h5">Votes:</strong>
                <?php echo $groups[$i]['votes'] ?>
                <br>
            </div>
        </div>
        
        <form action="../actions/voting.php" method="post">
    <input type="hidden" name="groupvotes" value="<?php echo $groups[$i]['votes'] ?>">
    <input type="hidden" name="groupid" value="<?php echo $groups[$i]['id'] ?>"> 
    
    <?php
    if($_SESSION['status']==1){
        ?>
        <radio button class="my-3 text-white px-3">Voted</button>
        <?php

    }else{
        ?>
        <button class="bg-danger my-3 text-white px-3" type="submit">Vote</button>
        <?php
    }
    ?>
        </form>
        <hr>
        <?php
           }
        }else{
            ?>
            <div class="container">
                <p>No groups to display</p>
            </div>
            <?php
        }
        ?>

        <!-- groups -->
        </div>
        
    <div class="col-md-5">
    <img src="../uploads/<?php echo $data['photo']  ?>" alt="User image">
    <br>
    <br>
    <strong class="text-dark h5">Name:</strong>
    <?php echo $data['username'] ;?> <br><br>
    <strong class="text-dark h5">Mobile:</strong>
    <?php echo $data['mobile']  ;?><br><br>
    <strong class="text-dark h5">Status:</strong>
    <?php echo $status  ;?><br><br>
    </div>
</div>
    </div>
</body>
</html>