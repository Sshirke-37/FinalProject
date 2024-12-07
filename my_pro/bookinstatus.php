<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Status</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }

        .container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            padding: 30px;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header .name {
            font-size: 24px;
            font-weight: bold;
            color: #007BFF;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            padding: 10px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #007BFF;
            color: #fff;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }

        .button-group {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <?php
        require_once('connection.php');
        session_start();
        $email = $_SESSION['email'];

        // Fetch user details
        $sql_user = "SELECT * FROM users WHERE EMAIL='$email'";
        $result_user = mysqli_query($con, $sql_user);
        $user = mysqli_fetch_assoc($result_user);

        // Fetch all bookings for the user
        $sql_bookings = "SELECT * FROM booking WHERE EMAIL='$email' ORDER BY BOOK_ID DESC";
        $result_bookings = mysqli_query($con, $sql_bookings);

        if (mysqli_num_rows($result_bookings) == 0) {
            echo '<script>alert("No booking details found.")</script>';
            echo '<script>window.location.href = "cardetails.php";</script>';
        } else {
    ?>

    <div class="container">
        <div class="header">
            <p class="name">Hello, <?php echo $user['FNAME'] . " " . $user['LNAME']; ?>!</p>
            <h3>Your Booking Details</h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Car Name</th>
                    <th>Duration (Days)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = mysqli_fetch_assoc($result_bookings)) { 
                    $car_id = $booking['CAR_ID'];
                    $sql_car = "SELECT * FROM cars WHERE CAR_ID='$car_id'";
                    $result_car = mysqli_query($con, $sql_car);
                    $car = mysqli_fetch_assoc($result_car);
                ?>
                <tr>
                    <td><?php echo $booking['BOOK_ID']; ?></td>
                    <td><?php echo $car['CAR_NAME']; ?></td>
                    <td><?php echo $booking['DURATION']; ?></td>
                    <td><?php echo $booking['BOOK_STATUS']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="button-group">
            <a href="cardetails.php" class="button">Go to Home</a>
        </div>
    </div>

    <?php } ?>
</body>
</html>
