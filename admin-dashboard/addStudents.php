<?php
    error_reporting(0);
    require_once "Classes/PHPExcel.php";
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

                    $reader=PHPExcel_IOFactory::createReaderForFile($fileName);
                    $excel_obj=$reader->load($fileName);
                    $worksheet=$excel_obj->getSheet('0');

                    $lastRow=$worksheet->getHighestRow();
                    //$lastCol=$worksheet->getHighestColumn();
                    //$columnCount=PHPExcel_Cell::columnIndexFromString($lastCol);
                    for($row=2;$row<=$lastRow;$row++){
                        
                        $username=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('0').$row)->getValue();
                        $email=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('1').$row)->getValue();
                        $studentName=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('2').$row)->getValue();
                        $className=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('3').$row)->getValue();
                        $semester=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('4').$row)->getValue();
                        $parentContact=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('5').$row)->getValue();

                        if($username){
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
                unlink($fileName);
            }
            header("Location: adminDashboard.php?tab=" . $tab);
            
                
        }

    ?>


</body>
</html>
