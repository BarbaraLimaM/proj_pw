<?php
include 'db.php'; // ou ajuste se necessário

$nome = $_POST['nome_tarefa'];
$inicio = $_POST['data_inicio'];
$fim = $_POST['data_fim'];
$tempo = $_POST['tempo_diario'];

if ($nome && $inicio && $fim && $tempo) {
    $query = "INSERT INTO tarefas (nome_tarefa, data_inicio, data_fim, tempo_diario)
              VALUES ('$nome', '$inicio', '$fim', '$tempo')";

    if (mysqli_query($conn, $query)) {
        header("Location: sucesso.php");
        exit();
    } else {
        echo "Erro no banco: " . mysqli_error($conn);
    }
} else {
    echo "Campos obrigatórios não preenchidos.";
}
?>
