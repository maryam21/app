<?php
require_once "vendor/autoload.php";

$conn = mysqli_connect("localhost", "root", "", "wp_db");

$faker = Faker\Factory::create();

for ($i=0; $i < 50; $i++) { 
    $sql = "INSERT INTO wp_users (user_nicename, user_email, user_pass, user_registered, user_login) VALUES ('" . $faker->name . "', '" . $faker->email . "', '" . md5($faker->password) . "', '" . date('Y-m-d H:i:s', strtotime($faker->iso8601)) . "', '" . $faker->userName ."' )";
    mysqli_query($conn, $sql);
}

for ($i=0; $i < 20; $i++){
    $sql = "INSERT INTO wp_posts (post_author, post_date, post_content, post_title) VALUES ('". $faker->numberBetween($min = 1, $max = 50) . "','" . date('Y-m-d H:i:s', strtotime($faker->iso8601)) . "', '" . $faker->text . "', '" . $faker->sentence . "')";
    mysqli_query($conn, $sql);
}
?>