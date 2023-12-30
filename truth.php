<?php
    include "include/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/truth.css">
    <title>About The Truth</title>
</head>
<body>
    <section>
        <img src="images/truth/images/palistain.jpg">
       <strong> the truth about palistain</strong>
    </section>
    <main>

        <?php

            $all_truths = mysqli_query($connectdb , "SELECT * FROM truths");

            while ($fetch_truth = mysqli_fetch_assoc($all_truths)) {
                
                echo "

                    <div class='container'>
                        <div class='box-1'>
                            <h2 class='blogger'>".$fetch_truth["title"]."</h2>
                            <img src='".$fetch_truth["img"]."' alt='logo'>
                        </div>
                        <div class='box-2'>
                            <p class='explains'>".$fetch_truth["blog"]."</p>
                        </div>
                    </div>
                "; 
                
            }
        ?>


    </main>
    <footer></footer>
</body>
</html>