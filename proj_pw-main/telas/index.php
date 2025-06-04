<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include_once("db.php");
include("header.php");

// Conecta com o banco
$conn = conectarBanco();
if (!$conn) {
    die("Erro na conexão com o banco: " . mysqli_connect_error());
}

$pagina = 'home'; // Página padrão

// Verifica se é um POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $data_inicio = trim($_POST['data_inicio'] ?? '');
    $data_fim = trim($_POST['data_fim'] ?? '');
    $tempo_diario = trim($_POST['tempo_diario'] ?? '');

    // Verifica se todos os campos estão preenchidos
    if ($nome && $data_inicio && $data_fim && $tempo_diario) {

        $sql = "INSERT INTO tarefas (nome, data_inicio, data_fim, tempo_diario) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $nome, $data_inicio, $data_fim, $tempo_diario);
            if ($stmt->execute()) {
                $pagina = 'sucesso';
            } else {
                // Erro ao executar
                $_SESSION['erro'] = "Erro ao inserir tarefa: " . $stmt->error;
                $pagina = 'teste';
            }
            $stmt->close();
        } else {
            $_SESSION['erro'] = "Erro ao preparar a query: " . $conn->error;
            $pagina = 'teste';
        }

    } else {
        $_SESSION['erro'] = "Preencha todos os campos.";
        $pagina = 'teste';
    }
} else {
    // Se não for POST, exibe home
    $pagina = 'home';
}

// Exibe a página correta
switch ($pagina) {
    case 'sucesso':
        include 'views/sucesso.php';
        break;
    case 'teste':
        include 'views/teste.php';
        break;
    default:
        include 'views/home.php';
        break;
}

$conn->close();
include 'footer.php';
?>