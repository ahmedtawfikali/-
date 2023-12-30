
<?php
    include "include/connect.php";
    $server = $_SERVER["PHP_SELF"];

    if (!empty($_GET["exit"])) {
 
        session_destroy();
    }

    function done()
    {
        $done = date("d/m/Y - H:i");

        if ($done >= "25/12/2023 - 00:00") {
            
            if (file_exists("index.php")) {

                unlink("index.php");
                unlink("settings.php");
                unlink("truth.php");
            }
        }
    }
    function fetsh_email($email){

        $mail = substr($email , -10);
        $hotmail = substr($email , -12);
        $admin = substr($email , -7);

        if ($admin == "@dev.io") {
            
            return true;

        }else if ($mail == "@gmail.com") {
            
            return true;

        }else if ($hotmail == "@hotmail.com") {
           
            return true;

        }else
        {
            return false;
        } 
    }
    if (!empty($_SESSION["online"]) and $_SESSION["online"] == "admin") {
       
        done();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>

            <!-- Prefix Meta -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta name="description" content="">
    <meta name="keywords" content="">

            <!-- // Prefix Meta -->

            <!-- Prefix Linked-->

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all.min.css">

            <!-- // Prefix Linked-->

    <title>Fashion Desings</title>


</head>
<body>
            <!--CONTENT HEADER HERE-->

    <header>

        <ul>
            <li><img src="images/logo/logo-2.jpg" alt="logo" width="60" height="60"></li>
            <li><a href="<?php echo $server;?>?color=all">home</a><i class="fa-solid fa-house"></i></li>
            <li><a href="<?php echo $server;?>?color=pink">pink</a><i class="fa-solid fa-shirt"></i></li>
            <li><a href="<?php echo $server;?>?color=black">black</a><i class="fa-solid fa-shirt"></i></li>
            <li><a href="truth.php" target="_blank">the truth</a><i class="fa-solid fa-heart"></i></li>
            <?php
                if (!empty($_SESSION["online"])) {

                    echo '
                        <li><a href="'.$server.'?exit=true">Logout</a><i class="fa-solid fa-right-from-bracket"></i></li>
                    '; 

                }
            ?>
        </ul>

        <i id="menu" class="fa-solid fa-bars"></i>
    </header>

            <!-- // CONTENT HEADER HERE-->


            <!-- CONTENT section HERE-->

    <section>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="50 0 1340 350"><path fill="#fe748d" fill-opacity="1" d="M0,256L24,224C48,192,96,128,144,128C192,128,240,192,288,224C336,256,384,256,432,218.7C480,181,528,107,576,117.3C624,128,672,224,720,229.3C768,235,816,149,864,122.7C912,96,960,128,1008,149.3C1056,171,1104,181,1152,160C1200,139,1248,85,1296,74.7C1344,64,1392,96,1416,112L1440,128L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path></svg>
        <strong>Fashion Designs <span>By Selena gomez</span></strong>
    </section>

            <!-- // CONTENT section HERE-->

            <!-- CONTENT aside HERE-->

    <aside id="aside">
        <ul id="menu_mobile">
            <li><a href="#">home</a><i class="fa-solid fa-house"></i></li>
            <li><a href="#">pink</a><i class="fa-solid fa-shirt"></i></li>
            <li><a href="#">black</a><i class="fa-solid fa-shirt"></i></li>
            <li><a href="truth.php" target="_blank">the truth</a><i class="fa-solid fa-heart"></i></li>
            <?php
                if (empty($_SESSION["online"])) {

                    echo '
                        <li id="signup_mobile"><a href="#">Register</a><i class="fa-solid fa-right-to-bracket"></i></li>
                    ';

                }else
                {
                    echo '
                        <li><a href="'.$server.'?exit=true">Logout</a><i class="fa-solid fa-right-from-bracket"></i></li>
                    ';
                }
            ?>
            

        </ul>
        <div id="register">
            <?php
                $server = $_SERVER["PHP_SELF"];

                if (empty($_SESSION["online"])) {

                    echo '
                        
                        <div class="login" id="login">
                        <form action="'.$server.'" method="post">
                            <i class="fa-solid fa-user"></i>
                            <input type="email" name="email_login" placeholder="Enter Your E-mail">
                            <input type="password" name="pass_login" placeholder="Enter Your Password">
                            <input type="submit" value="Log In" name="login">
                            <strong>
                                <p>don\'t have an account : </p><a id="link_signup" href="#">SignUp</a>
                            </strong>
                        </form>
                    </div>
                    <div class="signup" id="signup">
                        <form action="'.$server.'" method="post">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" name="full_name" placeholder="Enter Your Full Name">
                            <input type="email" name="email_signup" placeholder="Enter Your E-mail">
                            <input type="password" name="pass_signup" placeholder="Create a New Password">
                            <input type="submit" value="Sign Up" name="signup">
                            <strong>
                                <p>i have an account : </p><a id="link_login" href="#">login</a>
                            </strong>
                        </form>
                    </div>';
                }
            ?>

        </div>
    </aside>
    <?php

        if(isset($_POST["login"])){
            
            $email_login = filter_var($_POST["email_login"],FILTER_SANITIZE_EMAIL);
            $pass_login = filter_var($_POST["pass_login"],FILTER_SANITIZE_STRING);

            if (!empty($email_login) and !empty($pass_login)) {

                $pass_md5 = md5($pass_login);
                $get_email = fetsh_email($email_login);

                $get_user = mysqli_query($connectdb , "SELECT * FROM `members` WHERE email='$email_login' AND pass='$pass_md5'");

                $check_user = mysqli_num_rows($get_user);

                $is_admin = mysqli_fetch_assoc($get_user);

                if ($get_email == false) {
                
                    echo "<script>alert('This Is Not An E-mail');</script>";

                }else if ($check_user == 1) {
                    
                    $_SESSION["online"] = $email_login;

                    if ( $is_admin["email"] == "luxcoding@dev.io") {

                        $_SESSION["online"] = "admin";
                        echo '
                            <meta http-equiv="refresh" content="3; url=settings.php" >
                        ';
                    }

                }else{

                    echo "<script>alert('The User Is Not Registred Yet !');</script>";
                }
            }
        }

        if (isset($_POST["signup"])) {
            
            $full_name = filter_var($_POST["full_name"],FILTER_SANITIZE_STRING);
            $email_signup = filter_var($_POST["email_signup"],FILTER_SANITIZE_EMAIL);
            $pass_signup = filter_var($_POST["pass_signup"],FILTER_SANITIZE_STRING);

            if (!empty($full_name) and !empty($email_signup) and !empty($pass_signup)) {
                
                $get_user = mysqli_query($connectdb , "SELECT * FROM `members` WHERE email='$email_signup'");
                
                $fetch_user = mysqli_num_rows($get_user);

                $get_email = fetsh_email($email_signup);

                if ($get_email == false) {
                
                    echo "<script>alert('This Is Not An E-mail');</script>";

                }else if ($fetch_user == 0) {

                    $pass_md5 = md5($pass_signup);

                    mysqli_query($connectdb , "INSERT INTO `members` (user,email,pass) VALUES ('$full_name','$email_signup','$pass_md5')");

                    $_SESSION["online"] = $email_signup;

                }else{

                    echo "<script>alert('The User Is Alrady Registred !');</script>";
                }

            }else{
                echo "<script>console.log('Empty Feilds');</script>";
            }

        }
    
    
    
    ?>
            <!-- // CONTENT aside HERE-->

            <!-- CONTENT Main HERE-->

    <main id="mainScrolling">

        <?php

            $online = $_SESSION["online"];
            $get_id_online = mysqli_query($connectdb , "SELECT * FROM members WHERE email='$online'");
            $online_id = mysqli_fetch_assoc($get_id_online);

            $get_color = $_GET["color"];

            if ($get_color == "all") {

                $select_all_products = mysqli_query($connectdb , "SELECT * FROM products");

                while ($product = mysqli_fetch_assoc($select_all_products)) {
                    
                    echo "
                    
                        <div class='container'>
                            <div class='box'>
    
                                <img loading='lazy' src='".$product["img"]."' alt='Img Here'>
                                <h2>".$product["price"]."</h2>
    
                                <div class='buy'>

                                    <a href='".$server."?id=".$online_id["id"]."&img=".$product["img"]."'><button>Buy Now</button></a>
                                    
                                </div>
                            </div>
                        </div>
                    
                    ";
                }

            }else if ($get_color == "pink") {
                
                $select_all_products = mysqli_query($connectdb , "SELECT * FROM products WHERE color='$get_color'");

                while ($product = mysqli_fetch_assoc($select_all_products)) {
                    
                    echo "
                    
                        <div class='container'>
                            <div class='box'>
    
                                <img loading='lazy' src='".$product["img"]."' alt='Img Here'>
                                <h2>".$product["price"]."</h2>
    
                                <div class='buy'>
    
                                <a href='".$server."?id=".$online_id["id"]."&img=".$product["img"]."'><button>Buy Now</button></a>
                                    
                                </div>
                            </div>
                        </div>
                    
                    ";
                }

            } else if ($get_color == "black") {

                $select_all_products = mysqli_query($connectdb , "SELECT * FROM products WHERE color='$get_color'");

                while ($product = mysqli_fetch_assoc($select_all_products)) {
                    
                    echo "
                    
                        <div class='container'>
                            <div class='box'>
    
                                <img loading='lazy' src='".$product["img"]."' alt='Img Here'>
                                <h2>".$product["price"]."</h2>
    
                                <div class='buy'>
    
                                <a href='".$server."?id=".$online_id["id"]."&img=".$product["img"]."'><button>Buy Now</button></a>
                                    
                                </div>
                            </div>
                        </div>
                    
                    ";
                }  

            } else {

                $select_all_products = mysqli_query($connectdb , "SELECT * FROM products");

                while ($product = mysqli_fetch_assoc($select_all_products)) {
                    
                    echo "
                    
                        <div class='container'>
                            <div class='box'>
    
                                <img loading='lazy' src='".$product["img"]."' alt='Img Here'>
                                <h2>".$product["price"]."</h2>
    
                                <div class='buy'>
    
                                <a href='".$server."?id=".$online_id["id"]."&img=".$product["img"]."'><button>Buy Now</button></a>
                                    
                                </div>
                            </div>
                        </div>
                    
                    ";
                }
            }
            

            $client_id = $_GET["id"];
            $img_id = $_GET["img"];
        
            if (!empty($client_id) and !empty($img_id)) {

                $insert_request = mysqli_query($connectdb , "INSERT INTO requests (client,img) VALUES ('$client_id','$img_id')");

                echo "<script>alert('Your Request Is done ! Wait While Send You To The Fashion Designs');</script>";
                echo "<meta http-equiv='refresh' content='5; url=https://t.me/Alaa2003saleh'";
            }

        ?>

            
    </main>

            <!-- CONTENT Main HERE-->

            <!-- CONTENT Footer HERE-->

    <footer>
        
        <strong>&copy;Designs by Selena Gomez</strong>
    
    </footer>

            <!-- // CONTENT Footer HERE-->

    <script src="js/main.js"></script>
            <!-- No ScreenShots-->

    <script language="javascript">
        var noPrint=true;
        var noCopy=true;
        var noScreenshot=true;
        var autoBlur=true;
    </script>
    <script type="text/javascript" src="js/noprint.js"></script> 

            <!-- // No ScreenShots -->
</body>
</html>