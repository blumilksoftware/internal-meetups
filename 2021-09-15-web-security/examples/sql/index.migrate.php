<?php

$filename = "index.sqlite";
file_put_contents($filename, "");

$handle = new SQLite3($filename);

$migrate = "CREATE TABLE IF NOT EXISTS users (
    id   INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    password TEXT NOT NULL
)";
$handle->exec($migrate);

$seed = "INSERT INTO users(id, name, password) VALUES(1, 'admin', 'admin')";
$handle->exec($seed);

$handle->close();
