<?php
    session_start();
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $userid=$_GET['id'];
        $dbcon=mysqli_connect("localhost","root","","AMS");
        $sql="SELECT * FROM students WHERE USER_ID='$userid'";
        $student=mysqli_query($dbcon,$sql);
        if($student){
            $std_row=mysqli_fetch_array($student);
        }
        $sql="SELECT * FROM batches WHERE BATCH_ID='$std_row[BATCH_ID]'";
        $batch=mysqli_query($dbcon,$sql);
        if($batch){
            $batch_row=mysqli_fetch_array($batch);
        }

        //Lets store data in session
        $_SESSION["USER_ID"] = $userid;
        $_SESSION["STUDENT_ID"] = $std_row['STUDENT_ID'];
        $_SESSION["BATCH_ID"] = $std_row['BATCH_ID'];
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
            background-color: #f5f5f5;
            color: #0d7aa7;
        }

        .navbar {
            background-color: #0d7aa7;
            color: white;
            height: 90px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar h1 {
            margin: 0;
            font-size: 24px;
        }

        .navbar ul {
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
            transition: background-color 0.3s;
        }

        /* .navbar ul li a:hover {
            background-color: #0d7aa7;
        } */

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

        .content {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
        }

        /* .content h2 {
            font-size: 26px;
            margin-bottom: 20px;
            color: #0d7aa7;
        } */

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
            color: #336f94;
            font-weight: bold;
        }

        .card a:hover {
            color: #007bff;
        }
    </style>
</head>
<body>
    <!-- Navigation bar -->
    <div class="navbar">
        <h1>Welcome, <?php echo $std_row['NAMEE'] ?> !</h1>
        <ul>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="card-container">

        <?php

            for($i=6;$i>=1;$i--){

                if($batch_row['SEMESTER_'.$i]!=0){

                    $sql="SELECT * FROM subjects WHERE CLASS_NAME='$batch_row[CLASS]' AND SEMESTER=$i";
                    $data=mysqli_query($dbcon,$sql);
                    if($data){
                        $rowcount=mysqli_num_rows($data);
                        for($j=0;$j<$rowcount;$j++){
                            $sub=mysqli_fetch_array($data);
                            echo "<div class='card'>
                                <h3>".$sub['SUBJECT_NAME']."</h3>
                                <p>Semester ".$i."</p>
                                <a href='modules.php?id=".$sub['SUBJECT_ID']."&subject=".$sub['SUBJECT_NAME']."'>View</a>
                                </div>"; 
                        }
                    }

                }
            }

            
        ?>
        </div>
    </div>
</body>
</html>
