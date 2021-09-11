<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

<?php

$fail = false;
$success = false;

if (!empty($_POST)) {
    $name = $_POST["name"];
    $password = $_POST["password"];

    $handle = new SQLite3("index.sqlite");
    $migrate = "SELECT name, password FROM users WHERE name='$name' AND password='$password'";
    var_dump($migrate);
    $user = $handle->querySingle($migrate, true);

    if (!empty($user)) {
        $success = true;
    } else {
        $fail = true;
    }

    $handle->close();
}

?>

<div class="container mx-auto mt-12">
    <form class="w-96 mx-auto flex flex-col" method="post">
        <?php
        if ($fail) { ?>
            <div class="bg-red-200 p-2 mb-6 mx-1 rounded">Niewłaściwe dane logowania.</div> <?php
        } ?>
        <?php
        if ($success) { ?>
            <div class="bg-green-200 p-2 mb-6 mx-1 rounded">Zalogowano. Witaj, <?php
                echo $user["name"]; ?></div> <?php
        } ?>
        <h2 class="m-1 text-xl">Logowanie</h2>
        <label class="w-full m-1">
            <input id="name" name="name" type="text" placeholder="Login" class="p-2 rounded border border-gray-300 w-full">
        </label>
        <label class="w-full m-1">
            <input id="password" name="password" type="password" placeholder="Password" class="p-2 rounded border border-gray-300 w-full">
        </label>
        <label class="w-full m-1 opacity-25">
            <input id="password2" name="password2" type="text" placeholder="Password" class="p-2 rounded border border-gray-300 w-full">
        </label>
        <input type="submit" class="m-1 p-2 rounded border border-gray-300 w-full">
    </form>

    <div class="w-96 mx-auto m-1 mt-12 flex">
        <button id="invalid" class="m-1 p-2 rounded border border-gray-300 flex-1">niepoprawne</button>
        <button id="valid" class="m-1 p-2 rounded border border-gray-300 flex-1">poprawne</button>
        <button id="injection" class="m-1 p-2 rounded border border-gray-300 flex-1">SQLi</button>
    </div>
</div>

<script>
  const invalid = document.querySelector('#invalid')
  invalid.addEventListener('click', function () {
    document.getElementById('name').value = 'admin'
    document.getElementById('password').value = 'ndwheyui'
    document.getElementById('password2').value = 'ndwheyui'
  })

  const valid = document.querySelector('#valid')
  valid.addEventListener('click', function () {
    document.getElementById('name').value = 'admin'
    document.getElementById('password').value = 'admin'
    document.getElementById('password2').value = 'admin'
  })

  const injection = document.querySelector('#injection')
  injection.addEventListener('click', function () {
    document.getElementById('name').value = 'admin'
    document.getElementById('password').value = "password' OR 1=1 --"
    document.getElementById('password2').value = "password' OR 1=1 --"
  })
</script>