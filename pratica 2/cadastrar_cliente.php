<?php
$host = "localhost";
$dbname = "Prática2_ruan";
$username = "root";
$password = "root";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

       
        if (strlen($cpf) != 11) {
            echo "CPF inválido.";
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO clientes (nome, cpf, email, telefone) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $cpf, $email, $telefone]);

        echo "Cliente cadastrado com sucesso!";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
