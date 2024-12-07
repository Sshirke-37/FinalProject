<?php

// require_once('connection.php');
// $bookid=$_GET['id'];
// $sql="SELECT *from booking where BOOK_Id=$bookid";
// $result=mysqli_query($con,$sql);
// $res = mysqli_fetch_assoc($result);
// $car_id=$res['CAR_ID'];
// $sql2="SELECT *from cars where CAR_ID=$car_id";
// $carres=mysqli_query($con,$sql2);
// $carresult = mysqli_fetch_assoc($carres);
// $email=$res['EMAIL'];
// $carname=$carresult['CAR_NAME'];
// if($carresult['AVAILABLE']=='Y')
// {
// if($res['BOOK_STATUS']=='APPROVED' || $res['BOOK_STATUS']=='RETURNED')
// {
//     echo '<script>alert("ALREADY APPROVED")</script>';
//     echo '<script> window.location.href = "adminbook.php";</script>';
// }
// else{
//     $query="UPDATE booking set  BOOK_STATUS='APPROVED' where BOOK_ID=$bookid";
//     $queryy=mysqli_query($con,$query);
//     $sql2="UPDATE cars set AVAILABLE='N' where CAR_ID=$res[CAR_ID]";
//     $query2=mysqli_query($con,$sql2);
    
//     echo '<script>alert("APPROVED SUCCESSFULLY")</script>';
//     $to_email = $email;
//     $subject = "DONOT-REPLY";
//     $body = "YOUR BOOKING FOR THE CAR $carname IS BEEN APPROVED WITH BOOKING ID : $bookid";
//     $headers = "From: sender email";
    
//     if (mail($to_email, $subject, $body, $headers))
    
//     {
//         echo "Email successfully sent to $to_email...";
//     }
    
//     else

//     {
//     echo "Email sending failed!";
//     }
//     echo '<script> window.location.href = "adminbook.php";</script>';
// }  
// }
// else{
//     echo '<script>alert("CAR IS NOT AVAILABLE")</script>';
//     echo '<script> window.location.href = "adminbook.php";</script>';
// }


// ***********************************************************************************************

require_once('connection.php');
require 'vendor/autoload.php';  // Include Composer autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$bookid = $_GET['id'];
$sql = "SELECT * FROM booking WHERE BOOK_ID=$bookid";
$result = mysqli_query($con, $sql);
$res = mysqli_fetch_assoc($result);
$car_id = $res['CAR_ID'];

$sql2 = "SELECT * FROM cars WHERE CAR_ID=$car_id";
$carres = mysqli_query($con, $sql2);
$carresult = mysqli_fetch_assoc($carres);

$email = $res['EMAIL'];
$carname = $carresult['CAR_NAME'];

if ($carresult['AVAILABLE'] == 'Y') {
    if ($res['BOOK_STATUS'] == 'APPROVED' || $res['BOOK_STATUS'] == 'RETURNED') {
        echo '<script>alert("ALREADY APPROVED")</script>';
        echo '<script> window.location.href = "adminbook.php";</script>';
    } else {
        $query = "UPDATE booking SET BOOK_STATUS='APPROVED' WHERE BOOK_ID=$bookid";
        $queryy = mysqli_query($con, $query);

        $sql2 = "UPDATE cars SET AVAILABLE='N' WHERE CAR_ID=$res[CAR_ID]";
        $query2 = mysqli_query($con, $sql2);

        echo '<script>alert("APPROVED SUCCESSFULLY")</script>';

        // Send email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Use Gmail SMTP
            $mail->SMTPAuth   = true;
            $mail->Username   = 'mulgechannveer@gmail.com'; // Your email
            $mail->Password   = 'Channu@123';       // Your email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('mulgechannveer@gmail.com', 'Carental'); // Your email
            $mail->addAddress($email); // User's email

            //Content
            $mail->isHTML(true);
            $mail->Subject = "Booking Approval Notification";
            $mail->Body    = "Dear User,<br><br>Your booking for the car <strong>$carname</strong> has been approved. Your Booking ID is: <strong>$bookid</strong><br><br>Thank you for choosing Carental!";

            $mail->send();
            echo 'Email has been sent successfully!';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        echo '<script> window.location.href = "adminbook.php";</script>';
    }
} else {
    echo '<script>alert("CAR IS NOT AVAILABLE")</script>';
    echo '<script> window.location.href = "adminbook.php";</script>';
}



?>
