<?php 

    require_once('connection.php');
    session_start();
 
    $carid=$_GET['id'];
    
    $sql="select *from cars where CAR_ID='$carid'";
    $cname = mysqli_query($con,$sql);
    $email = mysqli_fetch_assoc($cname);
    
    $value = $_SESSION['email'];
    $sql="select * from users where EMAIL='$value'";
    $name = mysqli_query($con,$sql);
    $rows=mysqli_fetch_assoc($name);
    $uemail=$rows['EMAIL'];
    $carprice=$email['PRICE'];
    if(isset($_POST['book'])){
       
        $bplace=mysqli_real_escape_string($con,$_POST['place']);
        $bdate=date('Y-m-d',strtotime($_POST['date']));;
        $dur=mysqli_real_escape_string($con,$_POST['dur']);
        $phno=mysqli_real_escape_string($con,$_POST['ph']);
        $des=mysqli_real_escape_string($con,$_POST['des']);
        $rdate=date('Y-m-d',strtotime($_POST['rdate']));
         
        if(empty($bplace)|| empty($bdate)|| empty($dur)|| empty($phno)|| empty($des)|| empty($rdate)){
            echo '<script>alert("please fill the place")</script>';

        }
        else{
            if($bdate<$rdate){
            $price=($dur*$carprice);
            $sql="insert into booking (CAR_ID,EMAIL,BOOK_PLACE,BOOK_DATE,DURATION,PHONE_NUMBER,DESTINATION,PRICE,RETURN_DATE) values($carid,'$uemail','$bplace','$bdate',$dur,$phno,'$des',$price,'$rdate')";
            $result = mysqli_query($con,$sql);
            
            if($result){
                
                $_SESSION['email'] =$uemail;
                header("Location: payment.php");
            }
            else{
                echo '<script>alert("please check the connection")</script>';
            }
        }
        else{
            echo  '<script>alert("please enter a correct rturn date")</script>';
        }
    
        }
    }
    
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Booking</title>
    <link rel="stylesheet" href="css/style2.css">
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style2.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Section -->
    <!-- <div class="navbar-content">
        <h2 class="logo">CaRental</h2>
        <div class="menu">
            <ul>
                <li><a href="cardetails.php">HOME</a></li>
                <li><a href="aboutus2.html">ABOUT</a></li>
                <li><a href="contactus2.html">CONTACT</a></li>
                <li><a href="index.html">LOGOUT</a></li>
            </ul>
        </div>
    </div> -->
    <nav>
        <div class="navbar-content">
            <div class="logo">CaRental</div>
            <div class="menu">
                <nav class="space-x-6">
                    <a href="index.php" class="text-gray-700 hover:text-blue-500">Home</a>
                    <a href="#" class="text-gray-700 hover:text-blue-500">Contact</a>
                </nav>
            </div>
        </div>
    </nav>

    <!-- Booking Form Section -->
    <div class="search-form">
        <h2>Car Booking</h2>
        <form id="register" method="POST">
            <h3>Car Name: <?php echo htmlspecialchars($email['CAR_NAME']); ?></h3>
            <div class="input-group">
                <label for="place">Booking Place:</label>
                <input type="text" id="place" name="place" placeholder="Enter Your Destination" class="input-style">
            </div>
            <div class="input-group">
                <label for="datefield">Booking Date:</label>
                <input type="date" id="datefield" name="date" placeholder="Select Booking Date" class="input-style">
            </div>
            <div class="input-group">
                <label for="duration">Duration (days):</label>
                <input type="number" id="duration" name="dur" min="1" max="30" placeholder="Enter Rent Period (in days)"
                    class="input-style">
            </div>
            <div class="input-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="ph" maxlength="10" placeholder="Enter Your Phone Number"
                    class="input-style">
            </div>
            <div class="input-group">
                <label for="destination">Destination:</label>
                <input type="text" id="destination" name="des" placeholder="Enter Destination" class="input-style">
            </div>
            <div class="input-group">
                <label for="returnDate">Return Date:</label>
                <input type="date" id="dfield" name="rdate" placeholder="Enter Return Date" class="input-style">
            </div>
            <button type="submit" class="search-btn btnn" name="book">BOOK</button>
        </form>
    </div>

    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementById("datefield").setAttribute("min", today);
        document.getElementById("dfield").setAttribute("min", today);
    </script>
</body>

</html>