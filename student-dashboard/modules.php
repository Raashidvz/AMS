<?php
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $sub_id=$_GET['id'];
        $dbcon=mysqli_connect("localhost","root","","AMS");
        $sql="SELECT * FROM subjects WHERE SUBJECT_ID='$sub_id'";
        $subject=mysqli_query($dbcon,$sql);
        if($subject){
            $sub_row=mysqli_fetch_array($subject);
        }
       
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #336f94;
            color: #336f94;
        }

        .navbar {
            background-color: white;
            height: 90px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            margin: 0;
            color: #336f94;
            text-decoration: none;
            font-size: xx-large;
            font-weight: bolder;
        }

        /* .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
        }

        .navbar ul li {
            position: relative;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            border-radius: 5px;
            font-size: medium;
            transition: background-color 0.3s;
        }

        .navbar ul li a:hover {
            background-color: #0d7aa7;
        }

        .navbar ul li ul {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            color: #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            z-index: 1000;
        }

        .navbar ul li ul li {
            width: 200px;
        }

        .navbar ul li ul li a {
            color: #333;
            padding: 10px;
            border-radius: 0;
        }

        .navbar ul li ul li a:hover {
            background-color: #f5f5f5;
        }

        .navbar ul li:hover ul {
            display: block;
        } */

        .content {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
        }

        .content h2 {
            font-size: 26px;
            margin-bottom: 20px;
            color: #0d7aa7;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 columns */
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            margin-bottom: 10px;
        }

        .card p {
            margin-bottom: 15px;
            color: #6c757d;
        }

        .card a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .card a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Navigation bar -->
    <div class="navbar">
        <a href="student-dashboard.php" ><?php echo $sub_row['SUBJECT_NAME'] ?></a>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="card-container">
            <div class="card">
                <h3>MODULE-1</h3>
                <p>Module Name</p>
                <a href="studyMaterial.html">View</a>
            </div>
            <div class="card">
                <h3>MODULE-2</h3>
                <p>Module Name</p>
                <a href="#grade-assignments">View</a>
            </div>
            <div class="card">
                <h3>MODULE-3</h3>
                <p>Module Name</p>
                <a href="#view-students">View</a>
            </div>
            <div class="card">
                <h3>MODULE-4</h3>
                <p>Module Name</p>
                <a href="#manage-courses">View</a>
            </div>
            <div class="card">
                <h3>MODULE-5</h3>
                <p>Module Name</p>
                <a href="#grade-assignments">View</a>
            </div>
        </div>
    </div>
</body>
</html>
