<?php

require_once 'DataBase.php';
require_once 'DBQuery.php';

echo '<pre>';

$db = DataBase::connect('mysql:host=localhost; dbname=bwt_task_1; charset=utf8;', 'root', '');
$db1 = DataBase::connect('mysql:host=localhost; dbname=mail_chimp; charset=utf8;', 'root', '');

//var_dump($db->pdo);

$db->close();

$db->reconnect();

//var_dump($db->pdo);

//print $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
//print $db->getAttribute(PDO::ATTR_DEFAULT_FETCH_MODE);

//print_r($db->getPdoInstance());

$query = new DBQuery($db);

$query->setDBConnection($db1);

print_r($query->queryColumn('SELECT email FROM `users`'));
//print_r($query->queryRow('SELECT * FROM `users`'));
//print_r($query->queryColumn('SELECT `email` FROM `users`'));
//print_r($query->queryScalar('SELECT `email` FROM `users`'));

print '<br>'.$query->getLastQueryTime().'<br>';
























