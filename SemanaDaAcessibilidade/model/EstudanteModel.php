<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/aula3/model/Database.php';
class EstudanteModel {
    private string $nome;

    private int $idade;

    private int $id;

    private $database;

    

    public function __construct(){
        $this->database = new Database();
    }

    public function listarModel():array{
        $dadosArray = $this->database->executeSelect("SELECT * FROM estudantes");
        return $dadosArray;

    }

    public function salvarModel(string $nome, int $idade){
        $sql = "INSERT into estudantes (nome, idade) values ('$nome', '$idade')"; 
        $this->database->insert($sql);

        echo 'Estudante salvo com sucesso!';
    }

    
}