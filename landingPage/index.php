<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sagup</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="../navbar/navigation.css">
    <link rel="stylesheet" href="../footer/footer.css">
   
</head>
<body>
   <!-- Navigation Bar -->
<header>
    <nav>
        <ul id="homeID" class="nav-bar">
            <li class="logo"><a href="index.php"><img src="../assets/white-logo.jpg" alt=""></a></li>
            <H1 class="text-logo">SAGUP <span class="text-logo2">NEGROS</span></H1>
            <input type="checkbox" id="check">
            <span class="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="#eventID">Events</a></li>
                <li><a href="#aboutusID">About Us</a></li>
                <li><a href="#goalsID">Main Goals</a></li>
                <li><a href="#contactID">Contact Information</a></li>
                <li><a href="../donation/create.php">DONATE</a></li>
                <li><a href="../volunteers/create.php">Programs</a></li>
                <?php
                // Check if user is logged in
                if (isset($_SESSION['user_id'])) {
                    // User is logged in, display "Log Out" link
                    echo '<li><a href="../admin/index.php">Dashboard</a></li>';
                    echo '<li><a href="../login/logout.php">Log Out</a></li>';
                } else {
                    // User is not logged in, display "Log In" link
                    echo '<li><a href="../login/login.php">Log In</a></li>';
                }
                ?>
            </span>
            <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
        </ul>
    </nav>
</header>


<!-- ----------------------CAROUSEL-------------------------  -->

    <!-- Slideshow container -->
<div id="eventID" class="container1">
    <div class="slideshow-container">

<!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            
        <div class="herozero">
            <p class="hero">HERO<span class="zero">ZERO</span> </p>
            <a href="../volunteers/create.php"><p class="hero-text">BE A VOLUNTEER</p></a>
        </div>

                <img src="../assets/img8.jpg" style="width: 100%;height: 83vh">
            
        </div>

        <div class="mySlides fade">
        <div class="herozero">
            <p class="hero">Food waste mitigation</span> </p>
            <a href="../volunteers/create.php"><p class="hero-text">BE A VOLUNTEER</p></a>
        </div>
            <div class="numbertext">2 / 3</div>
                <img src="../assets/img7.jpg" style="width: 100%;height: 83vh">
           
        </div>

        <div class="mySlides fade">
        <div class="herozero">
            <p class="hero">Food<span class="zero">Pantry</span> </p>
            <a href="../volunteers/create.php"><p class="hero-text">BE A VOLUNTEER</p></a>
        </div>
            <div class="numbertext">3 / 3</div>
                <img src="../assets/img6.jpg" style="width: 100%;height: 83vh">
            
        </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <!-- <div class="herozero">
        <p class="hero">HERO<span class="zero">ZERO</span> </p>
        <a href="../volunteers/create.php"><p class="hero-text">BE A VOLUNTEER</p></a>
    </div> -->

    <!-- The dots/circles -->
    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>
 
</div>

<!-- -----------------------ABOUT US---------------------------------- -->

<br><br>
<div id="aboutusID"class="container2">
    <div class="bg-img">

        <div class="aboutus-text">
            <h1>ABOUT US</h1>
            <div class="aboutus-logo"> <img src="../assets/white-logo.jpg" alt=""> </div>
                
            <p> <span>SAGUP NEGROS</span> is an initiative that started by the EYE (Youth Empowering Youth) initiative Inc. 
                    One of their programs is focus on the environment. The one reason why they started SAGUP NEGROS 
                    is about Food Waste and how it contributes to the global gas emission that causes climate change or 
                    climate crisis
            </p>   
            
        </div>

        <div class="history">
            <H1><div class="history-title">HISTORY</div></H1>
            <div class="history-text">Sagup ("rescue") Negros is one of a dozen initiatives that won grants from LSEED
                for new projects during 2020. The team leaders are an inspiring group of recent college graduates
                (and current students) from the University of St. La Salle in Bacolod who had already been working together
                on a very successful initiative called Youth Empowering Youth. The leadership team at Sagup negros includes
                Awit,Eric,Franz,Renna,Roderick,Ted. They are supported by a cadre of student volunteers. They all live 
                together in a house where they cook, compost, and serve meals to the public.
            </div>
        </div>
    </div>
</div>

<!-- ------------------------------MAIN-GOALS--------------------------- -->

<div id="goalsID" class="container3">
    <div class="main-goals">
        <div class="goals-bg"> 
            <div class="number3">3</div>
            <h1><div class="goals-title">MAIN GOALS</div></h1>
            <div class="goals-text">
                <li><span class="goals-text">Help local market vendor to increase their income monthly with 10%.</span></li>
                <li><span class="goals-text">Lessen their food waste generation about 50% to 100%.</span></li>
                <li><span class="goals-text">Spread the advocacy, help them solve their problems related, and encourage young people and 
                    other communities about climate and food waste education.</span></li>
            </div>
            <a href="../donation/create.php" class="donate">DONATE</a>
        </div>
    </div>
</div>


<!-- ----------------------------CONTACT INFO--------------------------------- -->

<div id="contactID"class="container4">
    <div class="contact">
        <div class="contact-bg">
            <h1><div class="contact-title">CONTACT INFORMATION</div></h1>  
            <div class="contact-list">
                <li class="contact-text"> <i class="fas fa-regular fa-envelope"> sagupnegros@yeyinitiative.org </i></li> <br>
                <li class="contact-text"><i class="fas fa-brands fa-square-facebook ">  @Sagupnegros </i></li> <br>
                <li class="contact-text"> <i class="fas fa-brands fa-square-instagram ">   @sagupnegros</i></li> <br>               
            </div>    
        </div>
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
                    <li><a href="#homeID">HOME </a></li>
                    <li><a href="#aboutusID">ABOUT US </a></li>
                    <li><a href="#goalsID">MAIN GOALS </a></li>
                    <li><a href="#contactID">CONTACT INFORMATION </a></li>
                </ul>
            </div>

            <div class="sec About-Us">
                <h2>SIGN-UP/LOG-IN</h2>
                <ul class="about">                  
                    <li><a href="../admin/index.php">ADMIN </a></li>
                    <li><a href="../volunteers/create.php">VOLUNTEER </a></li>
                    <li><a href="../donation/create.php">DONATE </a></li>
            
                </ul>
            </div>

            
        </div>
    </footer>
            <div class="last-footer">
                © 2024 all rights reserved
            </div>
    <script src="js/index.js"></script>
</body>
</html>