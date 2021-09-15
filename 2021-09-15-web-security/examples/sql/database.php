<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

<?php

$handle = new SQLite3("database.sqlite");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "SELECT * FROM users WHERE id = '{$id}'";
    var_dump($query);
    $user = $handle->query($query);
}

?>

<div class="container mx-auto mt-12">
    <?php
    if (isset($user) && $user && ($user = $user->fetchArray())) { ?>
        <div class="w-96 mx-auto flex flex-col">
            <label class="w-full m-1">
                <input id="id" name="id" type="text" placeholder="ID" class="p-2 rounded border border-gray-300 w-full" value="<?php
                echo $user["id"] ?>">
            </label>
            <label class="w-full m-1">
                <input id="name" name="name" type="text" placeholder="Imię" class="p-2 rounded border border-gray-300 w-full" value="<?php
                echo $user["name"] ?>">
            </label>
            <label class="w-full m-1">
                <input id="password" name="password" type="password" placeholder="Hasło" class="p-2 rounded border border-gray-300 w-full" value="<?php
                echo $user["password"] ?>">
            </label>
        </div>
    <?php
    } ?>

    <div class="w-96 mx-auto m-1 mt-12 flex">
        <a href="?id=1" class="m-1 p-2 text-center rounded border border-gray-300 flex-1">student</a>
        <a href="?id=1234' UNION SELECT name FROM sqlite_master'" class="m-1 p-2 text-center rounded border border-gray-300 flex-1">haxor</a>
        <a href="?id=1234' UNION SELECT GROUP_CONCAT(name), 0, 0 FROM sqlite_master'" class="m-1 p-2 text-center rounded border border-gray-300 flex-1">haxxor</a>
    </div>
</div>

<?php

$handle->close();
