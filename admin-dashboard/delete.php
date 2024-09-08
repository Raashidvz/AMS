<?php
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $id=$_GET['id'];
        $role=$_GET['rolee'];
        $tab=$_GET['tab'];
        $dbcon=mysqli_connect("localhost","root","","AMS");
        if($role=='teacher'){

            //first we have to get teacher id
            //echo $id;

            $sql="SELECT * FROM teachers WHERE USER_ID='$id'";
            $data=mysqli_query($dbcon,$sql);
            if($data){
                $row=mysqli_fetch_array($data);//here we have that teacher details
                //echo $row[0];
                $sql="SELECT * FROM subjects WHERE TEACHER_ID='$row[0]'";
                $data2=mysqli_query($dbcon,$sql);
                if($data2){
                    $count=mysqli_num_rows($data2);
                    for($i=0;$i<$count;$i++){
                        $sub=mysqli_fetch_array($data2);
                        echo $sub[0];
                        $sql="UPDATE subjects SET TEACHER_ID=null WHERE SUBJECT_ID='$sub[0]'";
                        $data3=mysqli_query($dbcon,$sql);
                    }
                }
                //so we successfully deleted teacher from subject table
            }
      
            $sql="DELETE FROM teachers WHERE USER_ID='$id'";
            $result=mysqli_query($dbcon,$sql);
            if($result){
                $sql="DELETE FROM users WHERE USER_ID='$id'";
                $result=mysqli_query($dbcon,$sql);

                //now we had deleted teacher from teacher table and then from user table
            }
            header("Location: adminDashboard.php?tab=" . $tab);




        }else if($role=='student'){
            $sql="DELETE FROM students WHERE USER_ID='$id'";
            $result=mysqli_query($dbcon,$sql);
            if($result){
                $sql="DELETE FROM users WHERE USER_ID='$id'";
                $result=mysqli_query($dbcon,$sql);
            }
            header("Location: adminDashboard.php?tab=" . $tab);




        }else if($role=='subject'){
            $sql="UPDATE subjects SET TEACHER_ID=NULL WHERE SUBJECT_ID='$id'";
            $result=mysqli_query($dbcon,$sql);
            if($result){
           
            }
            header("Location: adminDashboard.php?tab=" . $tab);
        }
    }
    //header("location:adminDashboard.php?section=manage-teachers");
    exit;
?>