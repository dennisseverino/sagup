<?php

   session_start();
   include_once("../connection/connection.php");
   include_once("../connection/function.php");
   
   // Check if the user is logged in
   $user_data = check_login($conn);
   ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sagup</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../navbar/navigation.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/index1.css">
    <link rel="stylesheet" href="../footer/footer.css">
   
</head>
<body>
    
<header>
    <nav>
        <ul class="nav-bar">
            <li class="logo"><a href="../login/index.php"><img src="../assets/white-logo.jpg" alt=""></a></li>
            <H1 class="text-logo">SAGUP <span class="text-logo2">NEGROS</span></H1>
            <input type="checkbox" id="check">
            <span class="menu">

               
                    <li><a href="../landingPage/index.php">Home</a></li>
                    <?php if($user_data['role_name'] === 'Admin'): ?>
                        <li><a href="../administration/index.php">ADMINISTRATION</a></li>
                     <?php endif; ?>

                        <li><a href="../donation/index.php">DONATIONS</a></li>                      
                        <li><a href="../volunteers/index.php">PROGRAMS</a></li>
          
                <?php
                // Check if user is logged in
                if (isset($_SESSION['user_id'])) {
                    // User is logged in, display "Log Out" link
             
                    echo '<li><a href="../login/logout.php">Log Out</a></li>';
                } else {
                    // User is not logged in, display "Log In" link
                    echo '<li><a href="../login/login.php">Log In</a></li>';
                }
                ?>
                <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
            </span>
            <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
        </ul>
    </nav>
</header>


    <div class="wrapper-container">
        <div class="wrapper1">

                <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
                <div class="upload">
                    <?php
                    $user_id = $user_data["user_id"];
                    $username = $user_data["username"];
                    $images = $user_data["images"];
                    ?>
                    <img src="img/<?php echo $images; ?>" width = 175 height = 175 title="<?php echo $images; ?>">
                    <div class="round">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <input type="hidden" name="name" value="<?php echo $username; ?>">
                    <input type="file" name="images" id = "images" accept=".jpg, .jpeg, .png">
                    <i class = "fa fa-camera" style = "color: #fff;"></i>
                    </div>
                </div>
                </form>
                <script type="text/javascript">
                document.getElementById("images").onchange = function(){
                    document.getElementById("form").submit();
                };
                </script>
                <?php
                if(isset($_FILES["images"]["name"])){
                $user_id = $_POST["user_id"];
                $name = $_POST["name"];

                $imageName = $_FILES["images"]["name"];
                $imageSize = $_FILES["images"]["size"];
                $tmpName = $_FILES["images"]["tmp_name"];

                // Image validation
                $validImageExtension = ['jpg', 'jpeg', 'png'];
                $imageExtension = explode('.', $imageName);
                $imageExtension = strtolower(end($imageExtension));
                if (!in_array($imageExtension, $validImageExtension)){
                    echo
                    "
                    <script>
                    alert('Invalid Image Extension');
                    document.location.href = '../admin';
                    </script>
                    ";
                }
                elseif ($imageSize > 1200000){
                    echo
                    "
                    <script>
                    alert('Image Size Is Too Large');
                    document.location.href = '../admin';
                    </script>
                    ";
                }
                else{
                    $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
                    $newImageName .= '.' . $imageExtension;
                    $query = "UPDATE user_tb SET images = '$newImageName' WHERE user_id = $user_id";
                    mysqli_query($conn, $query);
                    move_uploaded_file($tmpName, 'img/' . $newImageName);
                    echo
                    "
                    <script>
                    document.location.href = '../admin';
                    </script>
                    ";
                }
                }
                
                ?>
                <div class="profile">
                    <h1>HI! <?php echo $user_data['username']; ?></h1>
                    <div class="role-title"><?php echo $user_data['role_name']; ?></div>
            
                </div>
         </div>

         <div class="wrapper-2">
                <div class="volunteers">
                    <div class="volunteer-title">VOLUNTEERS</div>
                    <canvas class="chart" id="myChart"></canvas>
                </div>
         </div>


         
    </div>
    <div class="wrapper-3">
        <div class="donations">
            <h1><div class="donations-title">DONATIONS</div></h1>
            <canvas class="linechart" id="lineChart"></canvas>
        </div>
    </div>

    <!-- ---------------------FOOOTER------------------------------ -->
<footer>
        <div class="footerbg"></div>
        <div class="container">
            <div class="sec aboutus">
               
                <h3>LOCATED AT</h3>
                <p class="footer-text"> Blk. 24, Lot 7, Victoria Street, Eroreco Subdivision, Brgy. Mandalagan City. Philippines
                </p>


            </div>


            <div class="sec Menu">
                <h2>Menu</h2>
                <ul>
                    <li><a href="../../home/home.html">HOME </a></li>
                    <li><a href="../donation/index.php">ABOUT US </a></li>
                    <li><a href="../../menu/teas/teas.html">GOALS </a></li>
                    <li><a href="../../menu/teas/teas.html">CONTACT INFORMATION </a></li>
                </ul>
            </div>

            <div class="sec About-Us">
                <h2>SIGN-UP/LOG-IN</h2>
                <ul class="about">                  
                    <li><a href="../../home/home.html">ADMIN </a></li>
                    <li><a href="../donation/index.php">VOLUNTEER </a></li>
                    <li><a href="../../menu/teas/teas.html">DONATE </a></li>
            
                </ul>
            </div>

            
        </div>
    </footer>
            <div class="last-footer">
                © 2024 all rights reserved
            </div>
    <script src="js/index.js"></script>
</body>