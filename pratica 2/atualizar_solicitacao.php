<?php
$pdo = new PDO("mysql:host=localhost;dbname=empresa_financeira", "root", "root");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $funcionario_id = $_POST['funcionario_id'];

    $stmt = $pdo->prepare("UPDATE solicitacoes SET status = ?, funcionario_id = ? WHERE id = ?");
    $stmt->execute([$status, $funcionario_id, $id]);

    echo "Solicitação atualizada com sucesso!";
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM solicitacoes WHERE id = ?");
    $stmt->execute([$id]);
    $solicitacao = $stmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Solicitação</title>
</head>
<body>
    <h1>Atualizar Solicitação</h1>
    <form action="atualizar_solicitacao.php" method="POST">
        <input type="hidden" name="id" value="<?= $solicitacao['id'] ?>">
        
        <label for="status">Status:</label>
        <select name="status">
            <option value="pendente" <?= $solicitacao['status'] == 'pendente' ? 'selected' : '' ?>>Pendente</option>
            <option value="em andamento" <?= $solicitacao['status'] == 'em andamento' ? 'selected' : '' ?>>Em andamento</option>
            <option value="finalizada" <?= $solicitacao['status'] == 'finalizada' ? 'selected' : '' ?>>Finalizada</option>
        </select><br>

        <label for="funcionario_id">Funcionario Responsável:</label>
        <input type="text" name="funcionario_id" value="<?= $solicitacao['funcionario_id'] ?>"><br>

       
