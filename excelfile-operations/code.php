<?php
error_reporting(0);
require_once "Classes/PHPExcel.php";

    $dbcon=mysqli_connect("localhost","root","","exam");


    if(isset($_POST['importdata'])){
        $fileName=$_FILES['upload-file']['name'];
        $tname=$_FILES['upload-file']['tmp_name'];
       // $upload_dir='/excel-files';
        move_uploaded_file($tname,$fileName);
        //$fileName="Blood_group.xlsx";
        $file_extension=pathinfo($fileName,PATHINFO_EXTENSION);
        $allowed_ext=['xls','cvs','xlsx'];
        echo "<br>";
        echo $fileName;
        echo "<br>";
        echo  var_dump($fileName);
        echo "<br>";
        echo $file_extension;
        echo "<br>";
        echo  var_dump($file_extension);
        echo "<br>";

        if(in_array($file_extension,$allowed_ext)){
            echo "IF";
            $reader=PHPExcel_IOFactory::createReaderForFile($fileName);
            echo  var_dump($reader);
            $excel_obj=$reader->load($fileName);
            $worksheet=$excel_obj->getSheet('0');
            echo "IF";
            $lastRow=$worksheet->getHighestRow();
            $lastCol=$worksheet->getHighestColumn();
            $columnCount=PHPExcel_Cell::columnIndexFromString($lastCol);

            $rowcount=(int)$lastRow;


            echo "<br>";
            echo  var_dump($lastRow);
            echo "<br>";
            echo  var_dump($lastCol);
            echo "<br>";
            echo  var_dump($columnCount);
            echo "<br>";
            echo $rowcount;
            echo "<br>";
            echo  var_dump($rowcount);
            $worksheet->getCell('A2')->getValue();

            for($row=2;$row<=$rowcount;$row++){
                echo "IF";
                $mobno=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('0').$row)->getValue();
                $username=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('1').$row)->getValue();
                $bloodgroup=$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex('2').$row)->getValue();

                if($username){
                    $sql="INSERT INTO blood_bank VALUES('$mobno','$username','$bloodgroup')";
                    $data=mysqli_query($dbcon,$sql);
                    if($data){
                        echo "Data inserted successfully";
                    }
                }


            }


        }else{
            $_SESSION['message']="invalid file";
            header('Location: readexcel.php');
            exit(0);
        }
        unlink($fileName);//to delete a file
    }
?>