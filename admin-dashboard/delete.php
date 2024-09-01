<?php
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $id=$_GET['id'];
        $role=$_GET['rolee'];
        $tab=$_GET['tab'];
        $dbon=mysqli_connect("localhost","root","","AMS");
        if($role=='teacher'){

            $sql="UPDATE subjects SET TEACHER_ID='' WHERE TEACHER_ID='$id";
            $sql="SELECT * FROM subjects WHERE TEACHER_ID='$id'";
            $reset=mysqli_query($dbon,$sql);
            if($reset){
                $count=mysqli_num_rows($reset);
                for($i=0;$i<$count;$i++){
                    $row=mysqli_fetch_array($reset);
                    $sql="UPDATE subjects SET TEACHER_ID='' WHERE SUBJECT_ID='$row[0]";
                    
                }
            }


            $sql="DELETE FROM teachers WHERE USER_ID='$id'";
            $result=mysqli_query($dbon,$sql);
            if($result){
                $sql="DELETE FROM users WHERE USER_ID='$id'";
                $result=mysqli_query($dbon,$sql);
            }
            header("Location: adminDashboard.php?tab=" . $tab);
        }else if($role=='student'){
            $sql="DELETE FROM students WHERE USER_ID='$id'";
            $result=mysqli_query($dbon,$sql);
            if($result){
                $sql="DELETE FROM users WHERE USER_ID='$id'";
                $result=mysqli_query($dbon,$sql);
            }
            header("Location: adminDashboard.php?tab=" . $tab);
        }else if($role=='subject'){
            $sql="UPDATE subjects SET TEACHER_ID='' WHERE SUBJECT_ID='$id'";
            $result=mysqli_query($dbon,$sql);
            if($result){
           
            }
            header("Location: adminDashboard.php?tab=" . $tab);
        }
    }
    //header("location:adminDashboard.php?section=manage-teachers");
    exit;
?>