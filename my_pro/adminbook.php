<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR</title>
     <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #eef2f7;
    color: #333;
    line-height: 1.6;
}

.dashboard-container {
    display: flex;
    flex-direction: column;
    height: 100vh;
}

.navbar {
    background-color: #3b82f6;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.navbar .logo h2 {
    color: #ecf0f1;
    font-size: 24px;
    font-weight: bold;
}

.navbar .menu ul {
    list-style: none;
    display: flex;
    gap: 25px;
}

.navbar .menu ul li a {
    color: #ecf0f1;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
    transition: color 0.3s ease;
}

.navbar .menu ul li a:hover {
    color: #1abc9c;
}

.header {
    text-align: center;
    font-size: 36px;
    color: #3b82f6;
    margin-top: 20px;
    margin-bottom: 30px;
    font-weight: bold;
    text-transform: uppercase;
}

.table-container {
    margin: 20px auto;
    padding: 20px;
    background: #ffffff;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    max-width: 95%;
    overflow-x: auto;
}

.content-table {
    width: 100%;
    border-collapse: collapse;
    table-layout: auto;
    text-align: left;
    font-size: 15px;
}

.content-table thead th {
    background-color: #3b82f6;
    color: white;
    font-weight: bold;
    padding: 15px 10px;
    text-transform: capitalize;
}

.content-table tbody td {
    padding: 12px 10px;
    border-bottom: 1px solid #ddd;
}

.content-table tbody tr:nth-child(odd) {
    background-color: #f8f9fa;
}

.content-table tbody tr:nth-child(even) {
    background-color: #ffffff;
}

.content-table tbody tr:hover {
    background-color: #e8f6f9;
    transition: background-color 0.2s;
}

button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease, transform 0.2s;
    color: white;
    font-weight: bold;
}

button a {
    text-decoration: none;
    color: inherit;
}

.approve-btn {
    background-color: #27ae60;
}

.approve-btn:hover {
    background-color: #2ecc71;
    transform: scale(1.05);
}

.return-btn {
    background-color: #e74c3c;
}

.return-btn:hover {
    background-color: #c0392b;
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .navbar .menu ul {
        flex-direction: column;
        gap: 10px;
    }

    .content-table {
        font-size: 14px;
    }

    button {
        padding: 8px 16px;
    }
}


     </style>
</head>

<body>
    <?php
    require_once('connection.php');
    $query = "SELECT * FROM booking ORDER BY BOOK_ID DESC";
    $queryy = mysqli_query($con, $query);
    ?>

    <div class="dashboard-container">
        <div class="navbar">
            <div class="logo">
                <h2>CaRs</h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="admindash.php">Dashboard</a></li>
                    <li><a href="adminvehicle.php">Vehicle Management</a></li>
                    <li><a href="adminusers.php">Users</a></li>
                    <li><a href="feed.php">Feedback</a></li>
                    <li><a href="index.php">Logout</a></li>
                </ul>
            </div>
        </div>

        <main>
            <h1 class="header">Bookings</h1>
            <div class="table-container">
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>Vehicle Serial Number</th>
                            <th>Email</th>
                            <th>Book Place</th>
                            <th>Book Date</th>
                            <th>Duration</th>
                            <th>Phone Number</th>
                            <th>Destination</th>
                            <th>Return Date</th>
                            <th>Booking Status</th>
                            <th>Approve</th>
                            <th>Car Returned</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($res = mysqli_fetch_array($queryy)) {
                        ?>
                            <tr>
                                <td><?php echo $res['CAR_ID']; ?></td>
                                <td><?php echo $res['EMAIL']; ?></td>
                                <td><?php echo $res['BOOK_PLACE']; ?></td>
                                <td><?php echo $res['BOOK_DATE']; ?></td>
                                <td><?php echo $res['DURATION']; ?></td>
                                <td><?php echo $res['PHONE_NUMBER']; ?></td>
                                <td><?php echo $res['DESTINATION']; ?></td>
                                <td><?php echo $res['RETURN_DATE']; ?></td>
                                <td><?php echo $res['BOOK_STATUS']; ?></td>
                                <td>
                                    <button class="approve-btn"><a href="approve.php?id=<?php echo $res['BOOK_ID']; ?>">Approve</a></button>
                                </td>
                                <td>
                                    <button class="return-btn"><a href="adminreturn.php?id=<?php echo $res['CAR_ID']; ?>&bookid=<?php echo $res['BOOK_ID']; ?>">Returned</a></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>
