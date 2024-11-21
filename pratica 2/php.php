<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Solicitações</title>
</head>
<body>
    <h1>Solicitações</h1>
    <form action="listar_solicitacoes.php" method="GET">
        <label for="status">Status:</label>
        <select name="status">
            <option value="pendente">Pendente</option>
            <option value="em andamento">Em andamento</option>
            <option value="finalizada">Finalizada</option>
        </select>
        <label for="urgencia">Urgência:</label>
        <select name="urgencia">
            <option value="baixa">Baixa</option>
            <option value="media">Média</option>
            <option value="alta">Alta</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <table border="1">
        <tr>
            <th>Descrição</th>
            <th>Urgência</th>
            <th>Status</th>
            <th>Funcionario Responsável</th>
            <th>Ações</th>
        </tr>
        <?php
        

        $pdo = new PDO("mysql:host=localhost;dbname=empresa_financeira", "root", "");

        

        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $urgencia = isset($_GET['urgencia']) ? $_GET['urgencia'] : '';

        $sql = "SELECT s.*, c.nome AS cliente_nome, f.nome AS funcionario_nome 
                FROM solicitacoes s
                LEFT JOIN clientes c ON s.cliente_id = c.id
                LEFT JOIN funcionarios f ON s.funcionario_id = f.id
                WHERE s.status LIKE :status AND s.urgencia LIKE :urgencia";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':status' => "%$status%", ':urgencia' => "%$urgencia%"]);

        while ($row = $stmt->fetch()) {
            echo "<tr>
                    <td>{$row['descricao']}</td>
                    <td>{$row['urgencia']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['funcionario_nome']}</td>
                    <td>
                        <a href='atualizar_solicitacao.php?id={$row['id']}'>Atualizar</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
