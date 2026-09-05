<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

class Categoria extends BaseController
{
    private $CategoriaModel;

    public function __construct()
    {
        $this->CategoriaModel = new CategoriaModel();
    }

    public function index()
    {
        return view("admin/listaCategoria", 
            $this->CategoriaModel->lista()
        );
    }

    public function save()
    {
        $this->CategoriaModel->save([
            "id" => 2,
            "descricao" => "Smartphones",
            "statusRegistro" => 1
        ]);
    }

    public function delete()
    {
        $this->CategoriaModel->delete(1);
    }
}