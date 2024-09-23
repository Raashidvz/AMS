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
                
                    for($row=1;$row<=$sheetcount;$row++){
                
                        $username=$spreadsheetAry[$row][0];
                        $email=$spreadsheetAry[$row][1];
                        $studentName=$spreadsheetAry[$row][2];
                        $className=$spreadsheetAry[$row][3];
                        $parentContact=$spreadsheetAry[$row][4];
                        
                        //converting data to upper case for more accuracy
                        $studentName=strtoupper($studentName);
                        $className=strtoupper($className);
                        
                        if($username){

                            //check whether the data already exist or not
                            $sqlx="SELECT * FROM users where USER_NAME=$username";
                            $check=mysqli_query($dbcon,$sqlx);
                            $deciscion=mysqli_fetch_array($check);

                            if($deciscion['USER_NAME']==$username){

                                //user already exist so update student
                                $sql2="UPDATE users SET EMAIL='$email' WHERE USER_ID='$deciscion[USER_ID]'";
                                $data2=mysqli_query($dbcon,$sql2);
                                if($data2){
                                    $sql21="UPDATE students SET NAMEE='$studentName',CLASS_NAME='$className',PARENT_CONTACT='$parentContact' WHERE USER_ID='$deciscion[USER_ID]'";
                                    $data21=mysqli_query($dbcon,$sql21);
                                    if($data21){
                                        //echo "DATA UPDATED SUCCESSFULLY";
                                    }
                                }           
                            }else{

                                //user doesnt exist so add student and check whether the atch already exist or not

                                //Now lets add a new batch if this batch doesnt exist
                                $yy= substr($username,0,2);
                                $year=2000+(int)$yy;
                                $batch=$className.$year;
                                $sql5="SELECT * FROM batches WHERE BATCH='$batch'";
                                $data5=mysqli_query($dbcon,$sql5);
                                if($data5){
                                    $bd=mysqli_fetch_array($data5);
                                    if($bd['BATCH']!=$batch){
                                        //no batch found,so creating new one
                                        $sql4="INSERT INTO batches (BATCH, YEARR, CLASS) VALUES('$batch','$year','$className') ";
                                        $data4=mysqli_query($dbcon,$sql4);
                                    }else{
                                        //batch already exist
                                    }
                                    
                                }

                                //to get batch_id
                                $sqlx="SELECT * FROM batches WHERE BATCH='$batch'";
                                $datax=mysqli_query($dbcon,$sqlx);
                                $batch_key=mysqli_fetch_array($datax);
                                
                                $sql = "INSERT INTO users (USER_NAME, PASSWORDD, EMAIL,ROLEE) VALUES ('$username', '$username', '$email','3')";
                                $data=mysqli_query($dbcon,$sql);
                                if($data){
                                    
                                     //echo "Data inserted successfully";
                                     $sql2="SELECT USER_ID FROM users WHERE USER_NAME=$username";
                                     $data2=mysqli_query($dbcon,$sql2);
                                     if($data2){
                                        $user_key=mysqli_fetch_array($data2);
                                        $sql3="INSERT INTO students (USER_ID,NAMEE, CLASS_NAME, PARENT_CONTACT,BATCH_ID) VALUES ('$user_key[0]','$studentName','$className','$parentContact','$batch_key[0]')";
                                        $data3=mysqli_query($dbcon,$sql3);
                                        if($data3){
                                            
                                        }
                                    }
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
