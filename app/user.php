<?php
switch ($_SESSION['user']['status']){
    case 0:
        echo "<p>Pending Request for sir, {".$_SESSION['user']['user_name']."}</p>";
    break;

    case 1:
        echo "<p>Welcome sir, {".$_SESSION['user']['user_name']."}</p>";
    break;

    case 2:
        echo "<p>Rejected Request for sir, {".$_SESSION['user']['user_name']."}</p>";
    break;
}
?>