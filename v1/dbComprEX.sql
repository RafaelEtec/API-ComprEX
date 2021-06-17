create database dbComprEX;

use dbComprEX;

CREATE TABLE tbProdutos (
	id int NOT NULL,
	nome varchar(255) NOT NULL,
	descricao varchar(255),
	quantidade int NOT NULL,
	valorUni decimal(7,2) NOT NULL,
	dataEntrada datetime default CURRENT_TIMESTAMP,
	imagem longblob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE tbProdutos
  ADD PRIMARY KEY (id);

ALTER TABLE tbProdutos
  MODIFY id int NOT NULL AUTO_INCREMENT;