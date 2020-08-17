<?php

if(isset($_SESSION['login'])){
    session_destroy();

    // header('Location: /Home');
    echo '<meta http-equiv="refresh" content="0;url=/"/>';
}