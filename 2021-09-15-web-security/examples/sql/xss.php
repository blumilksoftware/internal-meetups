<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

<div class="container mx-auto mt-12">

    <form class="w-96 mx-auto flex flex-col" method="get">
        <?php if (isset($_GET["name"]) && $_GET["name"]) { ?>
            <h2 class="m-1 text-xl">Cześć, <?php echo $_GET["name"] ?>!</h2>
        <?php } else { ?>
            <h2 class="m-1 text-xl">Logowanie</h2>
        <?php } ?>

        <label class="w-full m-1">
            <input id="name" name="name" type="text" placeholder="Twoje imię" class="p-2 rounded border border-gray-300 w-full">
        </label>
        <input type="submit" class="m-1 p-2 rounded border border-gray-300 w-full" value="Przywitaj się!">
    </form>

    <div class="w-96 mx-auto m-1 mt-12 flex">
        <a href="?name=" class="m-1 p-2 text-center rounded border border-gray-300 flex-1"></a>
        <a href="?name=Krzysztof" class="m-1 p-2 text-center rounded border border-gray-300 flex-1">Krzysztof</a>
        <a href="?name=<script>alert('dupa')</script>" class="m-1 p-2 text-center rounded border border-gray-300 flex-1">alert(dupa)</a>
    </div>
</div>
