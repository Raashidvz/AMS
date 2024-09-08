<?php
    error_reporting(0);
    require_once "Classes/PHPExcel.php";
    $dbcon=mysqli_connect("localhost","root","","AMS");
    $allowed_ext=['xls','cvs','xlsx'];
    $allowed_sub=['ADVANCED STATISTICAL METHODS','COMPUTER GRAPHICS','MICROPROCESSOR AND PC HARDWARE','OPERATING SYSTEMS','DATA STRUCTURE USING C++','COMPUTER NETWORKS','IT AND ENVIRONMENT','JAVA PROGRMMING USING LINUX','SYSTEM ANALYSIS AND SOFTWARE ENGINEERING','LINUX ADMINISTRATION','DESIGN AND ANALYSIS OF ALGORITHM','WEB PROGRAMING USING PHP','OPERATION RESEARCH'];
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
                        $teacherName=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('2').$row)->getValue();
                        $department=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('3').$row)->getValue();
                        $joiningDate=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('4').$row)->getValue();
                        $sub1=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('5').$row)->getValue();
                        $sub2=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('6').$row)->getValue();
                        $sub3=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('7').$row)->getValue();
                        $sub4=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('8').$row)->getValue();
                        //converting data to upper case for more accuracy
                        $teacherName=strtoupper($teacherName);
                        $department=strtoupper($department);
                        $joiningDate=strtoupper($joiningDate);
                        $SUB1=strtoupper($sub1);
                        $SUB2=strtoupper($sub2);
                        $SUB3=strtoupper($sub3);
                        $SUB4=strtoupper($sub4);
                        
                        if($username){
                            $sql = "INSERT INTO users (USER_NAME, PASSWORDD, EMAIL,ROLEE) VALUES ('$username', '$username', '$email','2')";
                            $data=mysqli_query($dbcon,$sql);
                            if($data){
                                
                                 //echo "Data inserted successfully";
                                 $sql2="SELECT USER_ID FROM users WHERE USER_NAME=$username";
                                 $data2=mysqli_query($dbcon,$sql2);
                                 if($data2){
                                    $key=mysqli_fetch_array($data2);
                                    $sql3="INSERT INTO teachers (USER_ID, NAMEE, DEPARTMENT, JOINING_DATE) VALUES ('$key[0]','$teacherName','$department','$joiningDate')";
                                    $data3=mysqli_query($dbcon,$sql3);
                                }
                             }

                             if(in_array($SUB1,$allowed_sub)){
                                $sql4="SELECT TEACHER_ID FROM teachers WHERE USER_ID=$key[0]";
                                $data4=mysqli_query($dbcon,$sql4);
                                if($data4){
                                    $teacherkey=mysqli_fetch_array($data4);
                                    $sql5="UPDATE subjects SET TEACHER_ID='$teacherkey[0]' WHERE SUBJECT_NAME='$SUB1'";
                                    $data5=mysqli_query($dbcon,$sql5);
                                }
                             }
                             
                             if(in_array($SUB2,$allowed_sub)){
                                $sql4="SELECT TEACHER_ID FROM teachers WHERE USER_ID=$key[0]";
                                $data4=mysqli_query($dbcon,$sql4);
                                if($data4){
                                    $teacherkey=mysqli_fetch_array($data4);
                                    $sql5="UPDATE subjects SET TEACHER_ID='$teacherkey[0]' WHERE SUBJECT_NAME='$SUB2'";
                                    $data5=mysqli_query($dbcon,$sql5);
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
