<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('home');
    }

    public function faleconosco()
    {

        $teste = ['codigo' => 100, "nome" => "FASM" ];

        dd("Rota: Home - Fale Conosco", $teste);
    }

    public function sobrenos()
    {
        return view("sobrenos");
    }
}
