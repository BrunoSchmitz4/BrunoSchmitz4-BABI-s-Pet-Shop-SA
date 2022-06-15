<?php

session_start();
session_unset();
session_destroy();
header("Location:../pags/cliente.php");

// desloga cliente
?>