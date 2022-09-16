
CREATE SCHEMA IF NOT EXISTS `apiliga`;
USE `apiliga` ;

CREATE TABLE IF NOT EXISTS `apiliga`.`produto` (
  `idproduto` INT(11) NOT NULL AUTO_INCREMENT,
  `dataCriacao` DATETIME NULL DEFAULT NULL,
  `nome` VARCHAR(255) NULL DEFAULT NULL,
  `preco` FLOAT NULL DEFAULT NULL,
  `ultimaAtualizacao` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`idproduto`));
  
CREATE TABLE IF NOT EXISTS `apiliga`.`token` (
  `idtoken` INT(11) NOT NULL AUTO_INCREMENT,
  `token` VARCHAR(45) NULL DEFAULT NULL,
  `data_criacao` DATETIME NULL DEFAULT NULL,
  `timestamp` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idtoken`));

  INSERT INTO produto (dataCriacao, nome, preco, ultimaAtualizacao ) VALUES ("2021-10-15 02:38:11", "Aberração Consumidora", 19.90, "2022-10-11 14:32:11");
  INSERT INTO produto (dataCriacao, nome, preco, ultimaAtualizacao ) VALUES ("2021-10-08 10:28:51", "A Árvore-mundo", 14.99, "2022-10-12 15:58:31");
  INSERT INTO produto (dataCriacao, nome, preco, ultimaAtualizacao ) VALUES ("2021-10-09 02:37:21", "A Imperatriz Errante", 2.99, "2022-10-19 08:08:21");
  INSERT INTO produto (dataCriacao, nome, preco, ultimaAtualizacao ) VALUES ("2021-10-04 02:29:31", "Abala-terra", 12.54, "2022-10-17 09:28:41");
  INSERT INTO produto (dataCriacao, nome, preco, ultimaAtualizacao ) VALUES ("2021-10-18 02:13:38", "Aberração Insetídea", 9.95, "2022-10-18 011:18:51");