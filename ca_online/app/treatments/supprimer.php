<?php

include_once '../../includes/__init__.php';
include_once '../models/Caoline.php';

if(isset($_GET['id'])){
    $id = intval($_GET['id']);

    $model = new Caoline();

    if($model->delete($id)){
        echo 'success';
    }else{
        echo 'error';
    }
}

?>