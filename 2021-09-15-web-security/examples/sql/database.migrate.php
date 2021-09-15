<?php

$filename = "database.sqlite";
file_put_contents($filename, "");

$handle = new SQLite3($filename);

$migrate = "CREATE TABLE IF NOT EXISTS students (
    id   INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    surname TEXT NOT NULL
)";
$handle->exec($migrate);

$migrate = "CREATE TABLE IF NOT EXISTS users (
    id   INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    password TEXT NOT NULL
)";
$handle->exec($migrate);

$migrate = "CREATE TABLE IF NOT EXISTS migrations (
    id   INTEGER PRIMARY KEY,
    name TEXT NOT NULL
)";
$handle->exec($migrate);

$seed = "INSERT INTO users(id, name, password) VALUES(1, 'admin', 'admin')";
$handle->exec($seed);

$users = [
    ["id" => 1, "name" => "Jan", "surname" => "Kowalski"],
    ["id" => 2, "name" => "Anna", "surname" => "Nowak"],
    ["id" => 3, "name" => "Piotr", "surname" => "Wiśniewski"],
    ["id" => 4, "name" => "Jacek", "surname" => "Wójcik"],
];

foreach ($users as $user) {
    $seed = "INSERT INTO students(id, name, surname) VALUES({$user["id"]}, '{$user["name"]}', '{$user["surname"]}')";
    $handle->exec($seed);
}

$handle->close();
