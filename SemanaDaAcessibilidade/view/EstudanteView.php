<?php $listaEstudantes = $_REQUEST["estudantes"]; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Estudantes</title>
</head>
<body>
    <h1 class="text-capitalize text-center fst-italic"> Semana da sensibilidade <h1>
    <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">idade</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($estudantes as $estudante) { ?>
                <tr>
                    <th scope="row"><?php echo $estudante['Id']; ?></th>
                    <td><?php echo $estudante["nome"]; ?></td>
                    <td><?php echo $estudante['idade']; ?></td>
                </tr>
                <tr>
            <?php } ?>
            </tbody>
    </table>
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfP9a62NkMuEm2NY6bEkZGa4oBxGePhoodfg&usqp=CAU" class="rounded mx-auto d-block" alt="Foto de um espelho redondo com uma pessoa segurando uma margarida roxa">
</body>
</html>
