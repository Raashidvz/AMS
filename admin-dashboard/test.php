<?php
    error_reporting(0);
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
    require_once('vendor/autoload.php');
    $dbcon=mysqli_connect("localhost","root","","AMS");
    $allowed_ext=['xls','cvs','xlsx'];
    $tab=$_GET['tab'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload PDF</title>
    <link rel="stylesheet" href="addStudents.css">
</head>
<body>
    <div class="container">

        <h2>Upload a New PDF</h2>
        
        <form action="" method="post" enctype="multipart/form-data">
            <label>Select EXCEL file to upload:</label>
            <label for="file-input" id="file-label" class="custom-file-upload">
                Choose File
            </label>
            <input  type="file" id="file-input" name="fileUpload[]" multiple required>
            <input type="submit" name="upload-file" id="upload-file" value="Upload File">
            <h5 id="prin"></h5>
        </form>
    </div>
    <script>
        document.getElementById('file-input').addEventListener('change', function() {
            var fileLabel = document.getElementById('file-label');
            var fileNames = Array.from(this.files).map(file => file.name).join(', ');
            fileLabel.textContent = fileNames || 'Choose Files';
            document.getElementById('prin').value.innerHTML=fileNames;
        });
    </script>

    <?php
        if(isset($_POST['upload-file'])){
                 
            for($i=0;$i<count($_FILES['fileUpload']['name']);$i++){

                $fileName= basename($_FILES['fileUpload']['name'][$i]);
                $uploadfile=$_FILES['fileUpload']['tmp_name'][$i];
                move_uploaded_file($uploadfile,$fileName);
                $file_extension=pathinfo($fileName,PATHINFO_EXTENSION);

                if(in_array($file_extension,$allowed_ext)){

                    $reader=new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $spreedsheet=$reader->load($fileName);
                    $excelsheet=$spreedsheet->getSheet(0);
                    $spreadsheetAry=$excelsheet->toArray();
                    $sheetcount=count($spreadsheetAry);
                    //var_dump($sheetcount);
                    // echo $sheetcount;
                    for($row=1;$row<=$sheetcount;$row++){
                
                        $username=$spreadsheetAry[$row][0];
                        $email=$spreadsheetAry[$row][1];
                        $studentName=$spreadsheetAry[$row][2];
                        $className=$spreadsheetAry[$row][3];
                        $semester=$spreadsheetAry[$row][4];
                        $parentContact=$spreadsheetAry[$row][5];
                        
                        //converting data to upper case for more accuracy
                        $studentName=strtoupper($studentName);
                        $className=strtoupper($className);
                        echo $username."<br>";
                        echo $email."<br>";
                        echo $studentName."<br>";
                        echo $className."<br>";
                        echo $semester."<br>";
                        echo $parentContact."<br>";

                        
                        

                        if($username){


                            //check whether the data already exist or not
                            $sqlx="SELECT * FROM users where USER_NAME=$username";
                            $check=mysqli_query($dbcon,$sqlx);
                            $deciscion=mysqli_fetch_array($check);
                            if($deciscion[1]==$username){
                                //update student
                                echo "UPDATEE<BR><BR>";
                                $sql2="UPDATE users SET EMAIL='$email' WHERE USER_ID='$deciscion[0]'";
                                $data2=mysqli_query($dbcon,$sql2);
                                if($data2){
                                    $sql21="UPDATE students SET NAMEE='$studentName',CLASS_NAME='$className',SEMESTER='$semester',PARENT_CONTACT='$parentContact' WHERE USER_ID='$deciscion[0]'";
                                    $data21=mysqli_query($dbcon,$sql21);
                                    if($data21){
                                        echo "DATA UPDATED SUCCESSFULLY";
                                    }
                                }           
                            }else{
                                echo "NEW DATA<BR><BR>";
                                echo "<br><br>USERNAME";
                                $sql = "INSERT INTO users (USER_NAME, PASSWORDD, EMAIL,ROLEE) VALUES ('$username', '$username', '$email','3')";
                                //$sql = "INSERT INTO USERS VALUES ('$username', '$username', '$email','3', '$studentName')";
    
                                $data=mysqli_query($dbcon,$sql);
                                if($data){
                                    
                                     //echo "Data inserted successfully";
                                     $sql2="SELECT USER_ID FROM users WHERE USER_NAME=$username";
                                     $data2=mysqli_query($dbcon,$sql2);
                                     if($data2){
                                        $key=mysqli_fetch_array($data2);
                                        //echo ($row[0]);
                                        $sql3="INSERT INTO students (USER_ID,NAMEE, CLASS_NAME, SEMESTER, PARENT_CONTACT) VALUES ('$key[0]','$studentName','$className','$semester','$parentContact')";
                                        $data3=mysqli_query($dbcon,$sql3);
                                        // if($data){
                                        //     echo "Data inserted successfully STUDENTS TABLE";
                                        // }
                                    }
                                 }


                            }



                           
                            
                        }
                        


                    }

                }
                unlink($fileName);
            }
            //header("Location: adminDashboard.php?tab=" . $tab);
            
                
        }

    ?>


</body>
</html>
