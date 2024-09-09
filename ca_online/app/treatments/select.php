<?php

include_once '../../includes/__init__.php';
include_once '../models/Format.php';
include_once '../models/Caoline.php';

$response = [];
$model = new Caoline();

if (isset($_POST['contact'])) {
    $contact = htmlspecialchars($_POST['contact']);
    $data = $model->getOne($contact);
    if ($data) {
        $response = $data;
    }
}

echo json_encode($response);
