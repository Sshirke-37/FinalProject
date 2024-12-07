<?php 
    require_once('connection.php');
        session_start();

    $value = $_SESSION['email'];
    $_SESSION['email'] = $value;
    
    $sql="select * from users where EMAIL='$value'";
    $name = mysqli_query($con,$sql);
    $rows=mysqli_fetch_assoc($name);
    $sql2="select *from cars where AVAILABLE='Y'";
    $cars= mysqli_query($con,$sql2);

    
    
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <link rel="stylesheet" href="css/cardetails.css">
</head>

<body>


    <div class="navbar">
        <h2 class="logo">CaRental</h2>
        <div class="menu">
            <ul>
                <li><a href="cardetails.php">HOME</a></li>
                <li><a href="aboutus.html">ABOUT</a></li>
                <li><a href="contactus.html">CONTACT</a></li>
                <li><a href="feedback/Feedbacks.php">FEEDBACK</a></li>
                <li><a href="bookinstatus.php">BOOKING STATUS</a></li>
                <li><a class="button" href="index.php">LOGOUT</a></li>
                <li><span class="phello"><strong><?php echo $rows['FNAME'] . " " . $rows['LNAME']; ?></strong></span></li>
                
            </ul>
        </div>
    </div>

    <h1 class="overview">OUR CARS OVERVIEW</h1>

    <ul class="de">
        <?php while ($result = mysqli_fetch_array($cars)) { ?>
            <li>
                <div class="box">
                    <div class="imgBx">
                        <img src="images/<?php echo $result['CAR_IMG']; ?>" alt="<?php echo $result['CAR_NAME']; ?>">
                    </div>
                    <div class="content">
                        <h1><?php echo $result['CAR_NAME']; ?></h1>
                        <h2>Fuel Type: <a><?php echo $result['FUEL_TYPE']; ?></a></h2>
                        <h2>Capacity: <a><?php echo $result['CAPACITY']; ?></a></h2>
                        <h2>Rent Per Day: <a>₹<?php echo $result['PRICE']; ?>/-</a></h2>
                        <a href="booking.php?id=<?php echo $result['CAR_ID']; ?>" class="utton">Book</a>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
</body>
</html>
