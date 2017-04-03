<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
setcookie("token", "", time() - 3600, "/", '.anderskitchen.com');
header("Location: https://www.anderskitchen.com"); /* Redirect browser */
exit();
?>