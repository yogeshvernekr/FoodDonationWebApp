<?php
    session_start();
    if( !isset($_SESSION['id']) )
        header('Location: login.php');
    include("connection.php");
    include("utils.php");
    $id=$_SESSION['id'];
    $select = mysqli_query($con, "SELECT * FROM `users` WHERE id = '$id'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
    $fetch = mysqli_fetch_assoc($select);
    }
    if(isset($_POST['request'])) {
        $requestType = $_POST['request'];
        $location = $_POST['location'];
        $expiry = $_POST['expiry'];
        $foodDescription = $_POST['foodDescription'];
        $randomSeed = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $foodDisplayId = generate_string($randomSeed,3).'-'.generate_string($randomSeed,3).'-'.generate_string($randomSeed,3);
        $result = $con->query("INSERT INTO food VALUES (NULL,".$_SESSION['id'].",'".$foodDescription."','".$location."','".$requestType."','".$foodDisplayId."','".$expiry."');");
        header('Location: dashboard.php?myrequest=true');
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/my-login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"/>
</head>

<body>
    <!--header area start-->
    <header>
        <div class="left_area">
            <h3 class="logo">Food4<span>Thought</span></h3>
        </div>
        <div class="right_area">
            <a href="logout.php" class="logout_btn">Logout</a>
        </div>
    </header>
    <!--header area end-->
    <div class="wrapper">
    <!--sidebar start-->
    <section>
        <div class="sidebar" style="min-height:120vh">
            <center>
            <?php
         if($fetch['pfp'] == ''){
            echo '<img src="images/default-avatar.png" class="profile_image" alt="">
            ';
         }else{
            echo '<img src="uploaded_img/'.$fetch['pfp'].'" class="profile_image" alt="">
            ';
         }
         ?>
                <h4>
                <?php 
				  echo  $_SESSION['name'];
                  ?>
				</h4>
                
            </center>
            <a href="profile.php"><i class="fas fa-sliders-h"></i><span>Profile</span></a>
            <a href="dashboard.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
            <a href="request.php"><i class="fas fa-cogs"></i><span>Create Request</span></a>
            <a href="dashboard.php?myrequest=true"><i class="fas fa-table"></i><span>My Requests</span></a>
            
            <a href="dashboard.php?appliedrequest=true"><i class="fas fa-table"></i><span>Applied Request</span></a>
            <!-- <a href="tracking.php"><i class="fas fa-info-circle"></i><span>Tracking</span></a> -->
            
        </div>
            
        </div>
        <!--sidebar end-->
    </section>

   



    <div class="container-1">
    
    <h2 class="donationh2">Donation Form</h2>
                    <!-- <a class="close" href="#">&times;</a> -->
                    <div class="content">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="form-group">
                                <label for="requestType">Request Type</label>

                                <select name="request" id="requestType" style="width:100%!important">
                                    <option value="donor">Donor</option>
                                    <option value="reciever">Reciever</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input id="location" type="text" name="location" style="width:100%!important">
                            </div>
                            <div class="form-group">
                                <label for="expiry">Expires After</label>
                                <input id="expiry" type="text" name="expiry" style="width:100%!important">
                            </div>
                            <div class="form-group">
                                <label for="foodDescription">Food Description/ Requirement</label>
                                <textarea id="foodDescription" name="foodDescription" rows="4" cols="50" style="width:100%!important"></textarea>
                            </div>
                            <div class="form-group m-0">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>

        </div>
        </div>
        <nav class="mobile-nav">
         <a href="dashboard.php"><i class="fas fa-desktop" id="bloc-icon"></i></a>
         <a href="dashboard.php?myrequest=true"><i class="fas fa-table"  id="bloc-icon"></i></a>
         <a href="request.php"><i class="fas fa-cogs"  id="bloc-icon"></i></a>
         <!-- <a href="#"><i class="fas fa-info-circle"  id="bloc-icon"></i></a> -->
         <a href="profile.php"><i class="fas fa-sliders-h"  id="bloc-icon"></i></a>
    </nav>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/cards.js"></script>
    <script src="js/requestPage.js"></script>
    
</body>

</html>