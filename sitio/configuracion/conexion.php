<?php
// Ocultamos los mensajes de error. Muy útil en producción.
ini_set('display_errors', 'On');
// Pedimos la sección que el usuario pide ver, que llega
session_start();
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_BASE = 'JM';

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_BASE);

if(!$db) {
    require 'mantenimiento.php';
    exit;
}

mysqli_set_charset($db, 'utf8mb4');

