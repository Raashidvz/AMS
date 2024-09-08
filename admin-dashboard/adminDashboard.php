<?php
    $dbcon=mysqli_connect("localhost","root","","AMS");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="adminDashboard.css">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.sidebar ul li a');
            const contents = document.querySelectorAll('.tab-content');

            // Function to show the active tab
            function showActiveTab(tabId) {
                // Hide all contents
                contents.forEach(content => content.classList.remove('active'));

                // Show the target tab content
                const target = document.getElementById(tabId);
                if (target) {
                    target.classList.add('active');
                }
            }

            // Check the URL parameters for the active tab
            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = urlParams.get('tab');

            if (activeTab) {
                showActiveTab(activeTab); // Load the tab based on URL parameter
            } else {
                contents[0].classList.add('active'); // Load the first tab by default
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', function (e) {
                    e.preventDefault();
                    const tabId = tab.getAttribute('href').substring(1); // Get tab ID from href
                    showActiveTab(tabId);
                });
            });
        });

    </script>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="#" class="logout-btn">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="dashboard">
        <aside class="sidebar">
            <ul>
                <!-- <li><a href="#overview">Dashboard Overview</a></li> -->
                <li><a href="#manage-students">Manage Students</a></li>
                <li><a href="#manage-classes">Manage Classes</a></li>
                <li><a href="#manage-subjects">Manage Subjects</a></li>
                <li><a href="#manage-teachers">Manage Teachers</a></li>
                <li><a href="#view-timetable">Time Table</a></li>
                <!-- <li><a href="#manage-assignments">Manage Assignments</a></li>
                <li><a href="#view-submissions">View Submissions</a></li>
                <li><a href="#messages">Messages</a></li> -->
            </ul>
        </aside>
        <main class="content">
            <!-- Content will be dynamically loaded here -->
            
            <div id="manage-students" class="tab-content">
                <a href="addStudents.php?tab=manage-students" class="new-btn">Add New</a>
                <div style="height: 20px; width: 100%;"></div>
                <table>
                    <thead>
                        <tr>
                            
                            <th>User Name</th>
                            <th>Student Name</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Semester</th>
                            <th>Parent Contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                        $sql="SELECT * FROM users WHERE ROLEE=3";
                        $students=mysqli_query($dbcon,$sql);
                        if($students){
                            $rowCount=mysqli_num_rows($students);
                            for($i=0;$i<$rowCount;$i++){
                                $row=mysqli_fetch_array($students);
                                $key=$row['USER_ID'];
                                $sql2="SELECT * FROM students where USER_ID=$key";
                                $data=mysqli_query($dbcon,$sql2);
                                if($data){
                                    $stud=mysqli_fetch_array($data);
                                }
                                echo "<tr>
                                        <td>".$row['USER_NAME']."</td>
                                        <td>".$stud['NAMEE']."</td>
                                        <td>".$row['PASSWORDD']."</td>
                                        <td>".$row['EMAIL']."</td>
                                        <td>".$stud['CLASS_NAME']."</td>
                                        <td>".$stud['SEMESTER']."</td>
                                        <td>".$stud['PARENT_CONTACT']."</td>
                                        <td class='action-btn'><a href='updateUser.html' class='update-btn'>Update</a><a href='delete.php?id=".$row['USER_ID']."&rolee=student&tab=manage-students' class='delete-btn'>Delete</a></td>
                                    </tr>";
                            }
                        }
                        
                    ?>
                
                    </tbody>
                </table>
            </div>
        
            <div id="manage-classes" class="tab-content">
                <table>
                    <thead>
                        <tr>
                            <th>Class Name</th>
                            <th>Semester</th>
                            <th>Subject-1</th>
                            <th>Subject-2</th>
                            <th>Subject-3</th>
                            <th>Subject-4</th>
                            <th>Subject-5</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example row -->
                        <tr>
                            <td>BCA</td>
                            <td>1</td>
                            <td>English</td>
                            <td>C</td>
                            <td>DBMS</td>
                            <td>Maths</td>
                            <td>Statistics</td>
                            <td class="action-btn"><a href="" class="update-btn">Update</a></td>
                        </tr>
                        <!-- Additional rows here -->
                    </tbody>
                </table>
            </div>
            <div id="manage-subjects" class="tab-content">
                <a href="addSubjects.php?tab=manage-subjects" class="new-btn">Add New</a>
                <div style="height: 20px; width: 100%;"></div>
                <table>
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Class</th>
                            <th>Semester</th>
                            <th>Teacher</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        $sql="SELECT * FROM subjects ORDER BY SEMESTER";
                        $subjectTable=mysqli_query($dbcon,$sql);
                        if($subjectTable){
                            $rowCount=mysqli_num_rows($subjectTable);
                            for($i=0;$i<$rowCount;$i++){
                                $subject=mysqli_fetch_array($subjectTable);
                                $key=$subject['TEACHER_ID'];
                                if($key!=null){
                                    $sql="SELECT NAMEE FROM teachers WHERE TEACHER_ID=$key";
                                    $data=mysqli_query($dbcon,$sql);
                                    $array=mysqli_fetch_array($data);
                                    $teacherName=$array[0];

                                }else{
                                    $teacherName=null;
                                }

                                echo "<tr>
                                        <td>".$subject['SUBJECT_NAME']."</td>
                                        <td>".$subject['CLASS_NAME']."</td>
                                        <td>".$subject['SEMESTER']."</td>
                                        <td>".$teacherName."</td>
                                        <td class='action-btn'><a href='updateUser.html' class='update-btn'>Update</a><a href='delete.php?id=".$subject['SUBJECT_ID']."&rolee=subject&tab=manage-subjects' class='delete-btn'>Delete</a></td>
                                    </tr>";
                            }
                        }
                        
                    ?>
                        
                    </tbody>
                </table>
            </div>

            <div id="manage-teachers" class="tab-content">
                <a href="addTeachers.php?tab=manage-teachers" class="new-btn">Add New</a>
                <div style="height: 20px; width: 100%;"></div>
                <table>
                    <thead>
                        <tr>
                            
                            <th>User Name</th>
                            <th>Teacher Name</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>Department</th>      
                            <th>Joining Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql="SELECT * FROM users WHERE ROLEE=2";
                        $teachers=mysqli_query($dbcon,$sql);
                        if($teachers){
                            $rowCount=mysqli_num_rows($teachers);
                            for($i=0;$i<$rowCount;$i++){
                                $row=mysqli_fetch_array($teachers);
                                $key=$row['USER_ID'];
                                $sql2="SELECT * FROM teachers where USER_ID=$key";
                                $data=mysqli_query($dbcon,$sql2);
                                if($data){
                                    $person=mysqli_fetch_array($data);
                                }
                                echo "<tr>
                                        <td>".$row['USER_NAME']."</td>
                                        <td>".$person['NAMEE']."</td>
                                        <td>".$row['PASSWORDD']."</td>
                                        <td>".$row['EMAIL']."</td>
                                        <td>".$person['DEPARTMENT']."</td>
                                        <td>".$person['JOINING_DATE']."</td>
                                        <td class='action-btn'><a href='updateUser.html' class='update-btn'>Update</a><a href='delete.php?id=".$row['USER_ID']."&rolee=teacher&tab=manage-teachers' class='delete-btn'>Delete</a></td>
                                    </tr>";
                            }
                        }
                        
                    ?>
                        
                    </tbody>
                </table>
            </div>
            <!-- Add more sections as needed -->
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>
