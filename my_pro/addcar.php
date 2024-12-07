<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator - Add New Car</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <script type="text/javascript">
        window.history.forward();
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function () { return null };
    </script>

<style>
/
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #74b9ff, #0984e3);
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    width: 100%;
    max-width: 100%;
    padding: 20px;
    margin-top: 50px; 
}

.form-box {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    padding: 30px;
    max-width: 450px;
    width: 100%;
    text-align: center;
}

h1 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 10px;
    color: #333;
}

.description {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
    text-align: left;
}

label {
    display: block;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 5px;
    color: #555;
}

input[type="text"],
input[type="number"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 8px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

input[type="text"]:focus,
input[type="number"]:focus,
input[type="file"]:focus {
    border-color: #0984e3;
    outline: none;
    box-shadow: 0 0 6px rgba(9, 132, 227, 0.3);
}

.btn {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(to right, #74b9ff, #0984e3);
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.3s ease;
}

.btn:hover {
    background: linear-gradient(to right, #0984e3, #74b9ff);
    transform: translateY(-2px);
}

.btn i {
    margin-right: 8px;
}

@media screen and (max-width: 480px) {
    .form-box {
        padding: 20px;
    }

    h1 {
        font-size: 22px;
    }

    .btn {
        font-size: 14px;
    }
}
    </style>

</head>

<body>
    <div class="container">
        <div class="form-box">
            <h1>Add New Car</h1>
            <p class="description">Fill in the details below to add a new car to the system.</p>
            <form id="register" action="upload.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="carname"><i class="fas fa-car"></i> Car Name</label>
                    <input type="text" name="carname" id="carname" placeholder="Enter Car Name" required>
                </div>

                <div class="form-group">
                    <label for="ftype"><i class="fas fa-gas-pump"></i> Fuel Type</label>
                    <input type="text" name="ftype" id="ftype" placeholder="Enter Fuel Type" required>
                </div>

                <div class="form-group">
                    <label for="capacity"><i class="fas fa-user-friends"></i> Capacity</label>
                    <input type="number" name="capacity" id="capacity" placeholder="Enter Capacity of Car" min="1" required>
                </div>

                <div class="form-group">
                    <label for="price"><i class="fas fa-dollar-sign"></i> Price (Per Day)</label>
                    <input type="number" name="price" id="price" placeholder="Enter Price in Rupees" min="1" required>
                </div>

                <div class="form-group">
                    <label for="image"><i class="fas fa-image"></i> Car Image</label>
                    <input type="file" name="image" id="image" required>
                </div>

                <button type="submit" class="btn" name="addcar">
                    <i class="fas fa-plus-circle"></i> Add Car
                </button>
            </form>
        </div>
    </div>
</body>

</html>
