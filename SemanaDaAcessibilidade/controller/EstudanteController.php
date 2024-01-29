<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/aula3/model/EstudanteModel.php';

class EstudanteController {
    public function listar() {
        $estudanteModel = new EstudanteModel();
        $estudantes = $estudanteModel->listarModel();

        $_REQUEST['estudantes'] = $estudantes;

        require_once $_SERVER['DOCUMENT_ROOT'] . '/aula3/view/EstudanteView.php';
    }

    public function salvar(){
        $nome = $_GET['nome'];
        $idade = $_GET['idade'];
        $id = $_GET['id'];


        $estudanteModel = new EstudanteModel();
        $estudanteModel -> salvarModel($nome, $idade);
    }
}