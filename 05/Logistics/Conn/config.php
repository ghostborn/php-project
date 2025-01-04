<?php
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PWD = 'root';
const DB_NAME = 'db_logistics';
const DB_PORT = '3306';
const DB_TYPE = 'mysql';
const DB_CHARSET = 'utf8';
const DSN = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;

try {
	$pdo = new PDO(DSN, DB_USER, DB_PWD);
} catch (PDOException $e) {
	echo $e->getMessage();
}