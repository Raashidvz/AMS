
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Details</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 500px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], input[type="email"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            outline: none;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus, input[type="email"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        }

        button {
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-message {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #28a745;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Update User Details</h2>
        <form action="updateUser.php" method="POST">
            <div class="form-group">
                <label for="username"><?php ?></label>
                <input type="text" id="username" name="username" placeholder="Enter username" value="" required>
            </div>

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter full name" value="" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter email address" value="" required>
            </div>

            <div class="form-group">
                <label for="course">Course</label>
                <input type="text" id="course" name="course" placeholder="Enter course (e.g., BCA)" value="" required>
            </div>

            <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="text" id="contact" name="contact" placeholder="Enter contact number" value="" required>
            </div>

            <button type="submit" name="update">Update</button>
        </form>
    </div>

</body>
</html>
