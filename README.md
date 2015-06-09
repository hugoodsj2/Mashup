# Mashup
Trabalho mashup de tecweb

Criar uma pasta chamada 'Mashup' dentro da pasta "www" do WAMP, e colocar os 3 arquivos dentro da mesma.

Criar um banco chamado 'mashup' no phpmyadmin e importar o script abaixo:

----------------------------------------------------------------------------------------------------------

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE IF NOT EXISTS `localidade` (
  `nomeCorretor` varchar(50) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `lng` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

----------------------------------------------------------------------------------------------------------

Pronto!

Basca colocar o nome do corretor, e o endereço e clicar em adicionar para inserir um novo ponto no mapa.
