<?php

$filename = "bobby.sqlite";
file_put_contents($filename, "");

$handle = new SQLite3($filename);

$migrate = "CREATE TABLE IF NOT EXISTS students (
    id   INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    surname TEXT NOT NULL
)";
$handle->exec($migrate);

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
