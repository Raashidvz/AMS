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
                        
                        $subjectName=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('0').$row)->getValue();
                        $className=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('1').$row)->getValue();
                        $semester=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('2').$row)->getValue();

                        if($subjectName){
                            $sql = "INSERT INTO subjects (SUBJECT_NAME, CLASS_NAME, SEMESTER) VALUES ('$subjectName', '$className', '$semester')";
                            $data=mysqli_query($dbcon,$sql);
                            if($data){
                             echo "data inserted<br>";
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
