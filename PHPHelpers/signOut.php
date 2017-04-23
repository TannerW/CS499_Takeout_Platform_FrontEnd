<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
       * 
       * deletes token from local cookies upon logout 
       *
       * @param none
       * @return none, deletes local cookie
       */

setcookie("token", "", time() - 3600, "/", '.anderskitchen.com');
header("Location: https://www.anderskitchen.com"); /* Redirect browser */
exit();
?>