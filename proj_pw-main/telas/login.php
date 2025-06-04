<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include_once("db.php");
include("header.php");
 
$conn = conectarBanco();
 
if (!$conn) {
    die("Erro na conexão com o banco: " . mysqli_connect_error());
}
 
$pagina = 'home'; // valor padrão
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $nome = $_POST['nome'] ?? '';
    $data_inicio = $_POST['data_inicio'] ?? '';
    $data_fim = $_POST['data_fim'] ?? '';
    $tempo_diario = $_POST['tempo_diario'] ?? '';

    // Verifica se todos os campos estão preenchidos
    if ($nome && $data_inicio && $data_fim && $tempo_diario) {
 
        $sql = "INSERT INTO tarefas (nome, data_inicio, data_fim, tempo_diario)
                VALUES (?, ?, ?, ?)";
 
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nome, $data_inicio, $data_fim, $tempo_diario);
 
        if ($stmt->execute()) {
            $pagina = 'sucesso';
        } else {
            echo "Erro na inserção: " . $stmt->error;
            $pagina = 'teste';
        }
 
        $stmt->close();
 
    } else {
        echo "";
        $pagina = 'teste';
    }
 
} else {
    echo "Acesso inválido.";
    $pagina = 'teste';
}
 
// Redirecionamento com base na página
switch ($pagina) {
    case 'teste':
        include 'views/teste.php';
        break;
    case 'sucesso':
        include 'views/sucesso.php';
        break;
    case 'home':
    default:
        include 'views/home.php';
        break;
}
 
$conn->close();
include 'footer.php';
?>

