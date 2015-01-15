<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $list = $_POST['list'];

    if (empty($list)) {
        $list = array();
    }

    file_put_contents(__DIR__ . '/../data/userdata.json', json_encode($list));
}
