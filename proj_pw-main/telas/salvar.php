<?php
include_once("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = conectarBanco(); // Certifique-se de que isso está funcionando

    $nome = $_POST['nome'] ?? '';
    $data_inicio = $_POST['data_inicio'] ?? '';
    $data_fim = $_POST['data_fim'] ?? '';
    $tempo_diario = $_POST['tempo_diario'] ?? '';

    if (!$conn) {
        die("Erro na conexão com o banco.");
    }

    $sql = "INSERT INTO tarefas (nome, data_inicio, data_fim, tempo_diario)
            VALUES ('$nome', '$data_inicio', '$data_fim', '$tempo_diario')";

    if (mysqli_query($conn, $sql)) {
        echo "Tarefa inserida com sucesso!";
    } else {
        echo "Erro ao inserir: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Acesso inválido.";
}
?>
