<?php
    include "connect.php";

    mysqli_query($connectdb , "DROP TABLE `members` , `products` , `truths` , `requests`");

    mysqli_query($connectdb , "CREATE TABLE `members`(
        `id` INT (30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `user` VARCHAR (255) NOT NULL,
        `email` VARCHAR (255) NOT NULL,
        `pass` VARCHAR (255) NOT NULL
    )");

    mysqli_query($connectdb , "CREATE TABLE `products`(
        `id` INT (30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `img` VARCHAR (255) NOT NULL,
        `price` VARCHAR (255) NOT NULL,
        `color` VARCHAR (255) NOT NULL
    )");

    mysqli_query($connectdb , "CREATE TABLE `truths`(
        `id` INT (30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR (255) NOT NULL,
        `img` VARCHAR (255) NOT NULL,
        `blog` LONGTEXT NOT NULL
    )");

    mysqli_query($connectdb , "CREATE TABLE `requests`(
        `id` INT (30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `client` VARCHAR (255) NOT NULL,
        `img` VARCHAR (255) NOT NULL
    )");

        $email = "luxcoding@dev.io";
        $admin = "admin";
        $pass = md5("root");

        $get_admin = mysqli_query($connectdb , "SELECT * FROM members WHERE email='$email'");

        $fetsh_admin = mysqli_num_rows($get_admin);

        if ($fetsh_admin == 0) {
           
            mysqli_query($connectdb , "INSERT INTO `members` (user,email,pass) VALUES ('$admin','$email','$pass')");
        }

?>