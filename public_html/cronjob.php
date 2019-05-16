<?php
$link= mysqli_connect('localhost','root','','bayankhongor');
if ($link) {
    $time=date('Y-m-d');
    mysqli_query($link, "delete from zar where created_at <='".date('Y-m-d', time()-3600*24*30)."'");
    echo 'deleted zar';
    mysqli_query($link, "delete from messages where created_at <='".date('Y-m-d', time()-3600*24*180)."'");
    echo 'deleted chat';
    mysqli_close($link);
}
?>