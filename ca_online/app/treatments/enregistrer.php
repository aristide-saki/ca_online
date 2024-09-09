<?php

include_once '../../includes/__init__.php';
include_once '../models/Caoline.php';

if(isset($_POST)){
    // var_dump($_POST);
    $model = new Caoline();
    if($model->insert($_POST)){
        echo 'success';
    }else{
        echo 'error';
    }
}

?>