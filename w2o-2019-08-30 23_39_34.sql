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

-- Copiando estrutura para tabela w2o.feria
CREATE TABLE IF NOT EXISTS `feria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `professorId` int(11) NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `professorId` (`professorId`),
  CONSTRAINT `FK__professor` FOREIGN KEY (`professorId`) REFERENCES `professor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela w2o.feria: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `feria` DISABLE KEYS */;
INSERT INTO `feria` (`id`, `professorId`, `dataInicio`, `dataFim`) VALUES
	(1, 8, '2019-08-30', '2019-09-30'),
	(3, 4, '2019-10-16', '2019-11-13');
/*!40000 ALTER TABLE `feria` ENABLE KEYS */;

-- Copiando estrutura para tabela w2o.gradehoraria
CREATE TABLE IF NOT EXISTS `gradehoraria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horario` enum('1','2','3','4') NOT NULL,
  `gradeMensal` enum('Todas','Penultima','Ultima') NOT NULL,
  `diaSemana` enum('Segunda','Terca','Quarta','Quinta','Sexta','Sabado') NOT NULL,
  `materiaId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_gradehoraria_materia` (`materiaId`),
  KEY `diaSemana` (`diaSemana`),
  KEY `gradeMensal` (`gradeMensal`),
  KEY `horario` (`horario`),
  CONSTRAINT `FK_gradehoraria_materia` FOREIGN KEY (`materiaId`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela w2o.gradehoraria: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `gradehoraria` DISABLE KEYS */;
INSERT INTO `gradehoraria` (`id`, `horario`, `gradeMensal`, `diaSemana`, `materiaId`) VALUES
	(1, '1', 'Todas', 'Segunda', 1),
	(2, '2', 'Todas', 'Segunda', 2),
	(3, '3', 'Todas', 'Segunda', 4),
	(4, '4', 'Todas', 'Segunda', 3),
	(5, '4', 'Todas', 'Quarta', 4),
	(6, '1', 'Penultima', 'Sabado', 4),
	(7, '4', 'Todas', 'Sexta', 4),
	(8, '3', 'Todas', 'Quinta', 2);
/*!40000 ALTER TABLE `gradehoraria` ENABLE KEYS */;

-- Copiando estrutura para tabela w2o.materia
CREATE TABLE IF NOT EXISTS `materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela w2o.materia: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` (`id`, `nome`) VALUES
	(1, 'Português'),
	(2, 'Inglês'),
	(3, 'Espanhol'),
	(4, 'Literatura'),
	(5, 'Matemática'),
	(6, 'Geografia'),
	(7, 'História'),
	(8, 'Física');
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;

-- Copiando estrutura para tabela w2o.professor
CREATE TABLE IF NOT EXISTS `professor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `tipo` enum('Principal','Substituto') NOT NULL COMMENT 'P - Principal, S - Substituto',
  `materiaId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_professor_materia` (`materiaId`),
  CONSTRAINT `FK_professor_materia` FOREIGN KEY (`materiaId`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela w2o.professor: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
INSERT INTO `professor` (`id`, `nome`, `tipo`, `materiaId`) VALUES
	(1, 'João', 'Principal', 1),
	(2, 'Fernando', 'Principal', 2),
	(3, 'Marcelo', 'Principal', 3),
	(4, 'Maria', 'Principal', 4),
	(5, 'Eduarda', 'Principal', 5),
	(6, 'Pedro', 'Principal', 6),
	(7, 'Silvana', 'Principal', 7),
	(8, 'Alberto', 'Principal', 8);
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
