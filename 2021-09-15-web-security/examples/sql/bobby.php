<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

<?php

$handle = new SQLite3("bobby.sqlite");
$all = "SELECT id, name, surname FROM students";
$students = $handle->query($all);

if (!empty($_POST)) {
    $count = "SELECT COUNT(id) as count FROM students";
    $count = $handle->querySingle($count, true);

    $id = $count["count"] + 1;
    $name = $_POST["name"];
    $surname = $_POST["surname"];

    $seed = "INSERT INTO students(id, name, surname) VALUES({$id}, '{$name}', '{$surname}')";
    var_dump($seed);
    $handle->exec($seed);
}

?>

<div class="container mx-auto mt-12">
    <form class="w-96 mx-auto flex flex-col" method="post">
        <h2 class="m-1 text-xl">formularz dodawania konta ucznia</h2>
        <label class="w-full m-1">
            <input id="name" name="name" type="text" placeholder="Imię" class="p-2 rounded border border-gray-300 w-full">
        </label>
        <label class="w-full m-1">
            <input id="surname" name="surname" type="text" placeholder="Nazwisko" class="p-2 rounded border border-gray-300 w-full">
        </label>
        <input type="submit" class="m-1 p-2 rounded border border-gray-300 w-full">
    </form>

    <div class="w-96 mx-auto m-1 mt-12 flex">
        <button id="student" class="m-1 p-2 rounded border border-gray-300 flex-1">zwykły student</button>
        <button id="bobby" class="m-1 p-2 rounded border border-gray-300 flex-1">Little Bobby Tables</button>
        <button id="bobby2" class="m-1 p-2 rounded border border-gray-300 flex-1">Little Bobby Tables*</button>
    </div>

    <hr class="my-12">

    <div class="w-96 mx-auto flex flex-col">
        <h2 class="m-1 text-xl">lista studentów</h2>
        <table class="my-2">
            <?php while ($student = $students->fetchArray()) { ?>
                <tr>
                    <td class="py-1"><?php echo $student["id"] ?></td>
                    <td class="py-1"><?php echo $student["name"] ?></td>
                    <td class="py-1"><?php echo $student["surname"] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<script>
  const student = document.querySelector('#student')
  student.addEventListener('click', function () {
    document.getElementById('name').value = 'Zofia'
    document.getElementById('surname').value = 'Lewandowska'
  })

  const bobby = document.querySelector('#bobby')
  bobby.addEventListener('click', function () {
    document.getElementById('name').value = 'Robert\'); DROP TABLE students;--'
    document.getElementById('surname').value = 'Lewandowski'
  })

  const bobby2 = document.querySelector('#bobby2')
  bobby2.addEventListener('click', function () {
    document.getElementById('name').value = 'Robert'
    document.getElementById('surname').value = 'Robert\'); DROP TABLE students;--'
  })
</script>

<?php

$handle->close();

?>

