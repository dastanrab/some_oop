<?php

session_start();

if (isset($_SESSION['ok']))
{
    if ($_SESSION['ok']<=3)
    {
        header("Refresh: 2; URL=http://localhost:63342/untitled/t.php");
        echo $_SESSION['ok'];
        $_SESSION['ok']+=1;
    }

}
else{

    header("Refresh: 2; URL=http://localhost:63342/untitled/t.php");
    $_SESSION['ok']=1;

}





