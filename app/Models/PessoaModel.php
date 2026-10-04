<?php

namespace App\Models;

class PessoaModel extends BaseModel
{
    protected $table = 'pessoa';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nome', 'ddd1', 'celular1', 'statusRegistro'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}