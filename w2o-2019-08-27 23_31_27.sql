-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.39-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para w2o
CREATE DATABASE IF NOT EXISTS `w2o` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `w2o`;

-- Copiando estrutura para tabela w2o.gradehoraria
CREATE TABLE IF NOT EXISTS `gradehoraria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horario` int(11) NOT NULL DEFAULT '0',
  `diaSemana` enum('Segunda','Terca','Quarta','Quinta','Sexta','Sabado') NOT NULL,
  `materiaId` int(11) NOT NULL DEFAULT '0',
  `tipoAula` enum('Principal','Extra') NOT NULL COMMENT 'P-Principal, E-Extra',
  PRIMARY KEY (`id`),
  KEY `FK_gradehoraria_materia` (`materiaId`),
  CONSTRAINT `FK_gradehoraria_materia` FOREIGN KEY (`materiaId`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela w2o.gradehoraria: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `gradehoraria` DISABLE KEYS */;
INSERT INTO `gradehoraria` (`id`, `horario`, `diaSemana`, `materiaId`, `tipoAula`) VALUES
	(1, 1, 'Segunda', 1, 'Principal'),
	(2, 2, 'Segunda', 2, 'Principal'),
	(3, 3, 'Segunda', 4, 'Principal'),
	(4, 3, 'Segunda', 3, 'Principal');
/*!40000 ALTER TABLE `gradehoraria` ENABLE KEYS */;

-- Copiando estrutura para tabela w2o.materia
CREATE TABLE IF NOT EXISTS `materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `professorId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_materia_professor` (`professorId`),
  CONSTRAINT `FK_materia_professor` FOREIGN KEY (`professorId`) REFERENCES `professor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela w2o.materia: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` (`id`, `nome`, `professorId`) VALUES
	(1, 'Português', 1),
	(2, 'Inglês', 2),
	(3, 'Espanhol', 3),
	(4, 'Literatura', 4),
	(5, 'Matemática', 5),
	(6, 'Geografia', 6),
	(7, 'História', 7),
	(8, 'Física', 8);
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;

-- Copiando estrutura para tabela w2o.professor
CREATE TABLE IF NOT EXISTS `professor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `tipo` enum('Principal','Substituto') DEFAULT NULL COMMENT 'P - Principal, S - Substituto',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela w2o.professor: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
INSERT INTO `professor` (`id`, `nome`, `tipo`) VALUES
	(1, 'João', 'Principal'),
	(2, 'Fernando', 'Principal'),
	(3, 'Marcelo', 'Principal'),
	(4, 'Maria', 'Principal'),
	(5, 'Eduarda', 'Principal'),
	(6, 'Pedro', 'Principal'),
	(7, 'Silvana', 'Principal'),
	(8, 'Alberto', 'Principal');
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
