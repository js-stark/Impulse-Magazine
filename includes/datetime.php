<?php
    date_default_timezone_set("Asia/calcutta");
    // $DateTime = strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
    $DateTime = strftime("%B-%d-%Y %H:%M:%S",time());
    echo $DateTime;
?>