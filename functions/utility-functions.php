<?php

function loop_dump($array) {
    echo "<ul style=\"list-style-type: none\">";

    foreach ($array as $value) {
        echo "<li>$value</li>";
    }

    echo "</ul>";
}