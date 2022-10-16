<?php
$con=mysqli_connect("localhost","root","","project");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
