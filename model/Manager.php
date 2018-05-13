<?php
/**
 * Created by PhpStorm.
 * User: olivi
 * Date: 10/05/2018
 * Time: 16:23
 */

class Manager
{
    Protected function dbConnect()
    {

        $bdd = new PDO('mysql:host=localhost;dbname=blogavril;charset=utf8', 'root', '');
        return $bdd;


    }
}