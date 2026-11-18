<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    // Níveis de acesso (usados nas rotas: "auth:1" = só administrador)
    public const NIVEL_ADMIN   = 1;
    public const NIVEL_CLIENTE = 11;

    // Por quanto tempo o link de recuperação de senha vale
    public const VALIDADE_TOKEN_HORAS = 1;

    protected $table = 'usuario';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nome', 'nivel', 'statusRegistro', "email", 'senha', 'pessoa_id', 'resetToken', 'resetExpira'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $validationRules = [
        'nome' => [
            "label" => 'Nome',
            'rules' => 'required|min_length[3]|max_length[50]'
        ],
        'nivel' => [
            'label' => 'Nível',
            'rules' => 'required|in_list[1,11]'
        ],
        'statusRegistro' => [
            'label' => 'Status',
            'rules' => 'required|in_list[1,2]'
        ],
        'email' => [
            "label" => 'E-mail',
            'rules' => 'required|valid_email'
        ],
    ];

    /**
     * getByEmail
     *
     * @param string $email 
     * @return array
     */
    public function getByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Lista do painel (sem a senha).
     */
    public function listaAdmin(): array
    {
        return $this->select('id, nome, email, nivel, statusRegistro, created_at')
                    ->orderBy('nome')
                    ->findAll();
    }

    /**
     * Cria o token de recuperação de senha.
     *
     * O token puro vai no link do e-mail; no banco fica só o hash dele.
     *
     * @return string token puro (64 caracteres hexadecimais)
     */
    public function criarTokenRecuperacao(int $usuarioId): string
    {
        $token = bin2hex(random_bytes(32));     // aleatório criptograficamente seguro

        $this->update($usuarioId, [
            'resetToken'  => hash('sha256', $token),
            'resetExpira' => date('Y-m-d H:i:s', strtotime('+' . self::VALIDADE_TOKEN_HORAS . ' hour')),
        ]);

        return $token;
    }

    /**
     * Usuário ativo dono do token, se o token ainda estiver no prazo.
     */
    public function getByTokenValido(string $token): ?array
    {
        if (! preg_match('/^[a-f0-9]{64}$/', $token)) {
            return null;
        }

        return $this->where('resetToken', hash('sha256', $token))
                    ->where('resetExpira >=', date('Y-m-d H:i:s'))
                    ->where('statusRegistro', 1)
                    ->first();
    }

    /**
     * Grava a nova senha (com hash) e invalida qualquer token pendente.
     */
    public function gravarNovaSenha(int $usuarioId, string $senha): bool
    {
        return $this->update($usuarioId, [
            'senha'       => password_hash(trim($senha), PASSWORD_DEFAULT),
            'resetToken'  => null,
            'resetExpira' => null,
        ]);
    }

    /**
     * insertUsuario
     *
     * @param array $aPessoa 
     * @param array $aEndereco 
     * @param array $aUsuario 
     * @return integer
     */
    public function insertUsuario($aPessoa, $aEndereco, $aUsuario) 
    {
        $db = \Config\Database::connect();

        $db->transBegin();      // Inicia controle de transação

        // insere a Empresa
        $tbPessoa = $db->table("pessoa");
        $tbPessoa->insert($aPessoa);

        $pessoa_id = $db->insertID();

        if ($pessoa_id > 0) {

            // Insere o usuário

            $aUsuario['pessoa_id']  = $pessoa_id;
            $aEndereco['pessoa_id'] = $pessoa_id;

            $tbEndereco = $db->table("pessoaendereco");
            $tbEndereco->insert($aEndereco);

            $tbUsuario = $db->table("usuario");
            $tbUsuario->insert($aUsuario);

            $usuario_id = $db->insertID();

            //

            if ($db->transStatus() === FALSE) {
                $db->transRollback();               // Defaz o que foi feito na base de dados
                return 0;
            } else {
                $db->transCommit();                 // Confirmar a gravação dos dados na base dados
                return $usuario_id;
            }

        } else {
            $db->transRollback();                   // Defaz o que foi feito na base de dados
            return 0;           
        }
    }
}