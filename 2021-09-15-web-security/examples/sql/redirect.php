<?php

header("Content-Type: text/javascript");

?>

function openInNewTab(href) {
    Object.assign(document.createElement('a'), {
        target: '_blank',
        href: href,
    }).click();
    window.focus();
}

openInNewTab("http://localhost:2667/facebook.php");
