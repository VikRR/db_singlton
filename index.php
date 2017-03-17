<?php

echo "Singleton<br>";

require_once 'DB.php';
require_once 'DBQuery.php';

session_start();

$db_option = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8',
];

var_dump($db);

$db = DB::connect('mysql:host=localhost; dbname=bwt_task_1; charset=utf8;', 'root', '', $db_option);

//$db->getLastInsertID();

var_dump($db);

//$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
//print $db->getAttribute(PDO::ATTR_DEFAULT_FETCH_MODE);
//print $db->getAttribute();

$query = new DBQuery($db);

//var_dump($_SESSION);

echo '<br><pre>';
var_dump($query->queryAll('select * from users'));
//$query->queryAll('select * from users');
var_dump(get_class_vars('DBQuery'));
//echo '</pre><br> Timestamp last query: ';
//echo $query->getLastQueryTime();
//exit;
//echo '<br>';
////var_dump(get_class_vars('DBQuery'));
//echo '<br>';
////var_dump($query->getTimestamp());
//$data = [
//    'last_name' => 'Muk',
//    'email'     => 'nunk@ua.ua',
//];
//$db->close();
//var_dump($db);
//echo $lastId = $db->lastInsertId();
////$rowCount = $query->execute('insert into users (last_name, email) values(:last_name, :email)', $data);
//echo "\n count insert row" . $rowCount . "\n";
//echo $lastId = $db->lastInsertId();
//var_dump($db->getPdoInstance());