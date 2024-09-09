<?php

class HomeController
{


    public function __construct()
    {
    }

    public function form()
    {

        $pageName = 'formulaire';

        $model = new Caoline();

        if (isset($_GET['q'])) {
            $q = intval($_GET['q']);
            $data = $model->getOne($q);
        }

        // function showValue($string)
        // {
        //     if (isset($string) && $string) {
        //         return $string;
        //     }
        // }

        require 'app/views/form.php';
    }


    public function data()
    {

        $pageName = 'enregistrements';
        $model = new Caoline();

        $data = $model->getAll();
        require 'app/views/enregistrements.php';
    }



    // 
}
