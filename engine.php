<?php

// String que cria a conexão "servidor, usuário, senha e banco"
$conn = mysqli_connect("localhost", "root", "", "mashup");

$txt_nome = $_POST["nome"];
$txt_lat = $_POST["txt_lat"];
$txt_lng = $_POST["txt_lng"];

$query = "INSERT INTO localidade (nomeCorretor, lat, lng) VALUES ('$txt_nome','$txt_lat', '$txt_lng')";
$result = mysqli_query($conn, $query)
	or die (mysql_error());
if ($result){
	header("location:../mashup/mashup.php");
}	
else{
	echo "Ocorreu um erro!";
}

?>