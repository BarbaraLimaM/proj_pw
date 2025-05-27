<?php 

#iniciar sessão
session_start();

#Base de dados
include 'db.php';

#Cabeçalho
include 'header.php';


#Conteúdo da página

if(isset($_SESSION['salvar'])){//se existir um login
	if(isset($_GET['pagina'])){
		$pagina = $_GET['pagina'];
	}
	else{
		$pagina = 'teste';
	}
}

else{
		$pagina = 'home';
}

if(isset($_SESSION['salvar'])){//se existir um login
	if(isset($_GET['pagina'])){
		$pagina = $_GET['pagina'];
	}
	else{
		$pagina = 'sucesso';
	}
}

else{
		$pagina = 'teste';
}

switch ($pagina) {
	case 'teste': include 'views/teste.php'; break;
	case 'sucesso': include 'views/sucesso.php'; break;
	default: include 'views/home.php'; 
	break;
}


#Rodapé
include 'footer.php';