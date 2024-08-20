<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read excel sheet</title>
</head>
<body>
    <center>
        <h2>Read excel by PHPExcel</h2>

        <?php
        error_reporting(0);

            require_once "Classes/PHPExcel.php";

            //to load excel into our project
            $path="test1.xlsx";
            $reader=PHPExcel_IOFactory::createReaderForFile($path);
            $excel_Obj=$reader->load($path);//created an object of excel sheet 'test1.xlsx'

            //creating variable to get data of the excel sheet
            //$worksheet=$excel_Obj->getActiveSheet();//this will give last sheet(page)
            $worksheet=$excel_Obj->getSheet('0');//this will give first  sheet

            //read value from sheet
            echo $worksheet->getCell('B4')->getValue();
        
            //to get row count and column count of sheet
            $lastRow=$worksheet->getHighestRow();
            $columnCount=$worksheet->getHighestDataColumn();
            $columncount_number=PHPExcel_Cell::columnIndexFromString($columnCount);
            

            echo "<br>";
            echo $lastRow;
            echo "<br>";
            echo $columnCount;
            echo "<br>";
            echo $columncount_number;

            echo "<table border='1'>";
            for($row=0;$row<=$lastRow;$row++){
                
                echo "<tr>";
                for($col=0;$col<=$columncount_number;$col++){
                    
                    echo "<td>";
                    echo $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue();
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";

        ?>

    </center>
</body>
</html>



                