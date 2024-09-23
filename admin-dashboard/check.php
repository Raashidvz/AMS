<?php
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $date = date('d-m-Y');  // Current date
        echo $date;
    }

?>