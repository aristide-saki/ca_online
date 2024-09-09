<?php
// chargement automatique des classes
spl_autoload_register(function ($class_name) {
    require_once 'app/models/' . $class_name . '.php';
});
