<?php
class Db extends PDO
{
    const LOC = 'localhost';
    const PW = '123';
    const USER = 'devroot';
    const DB = 'bookshop';

    function __construct()
    {
        parent::__construct('mysql:host='.self::LOC, self::USER, self::PW);
    }
}