-- MySQL Script generated by MySQL Workbench
-- Fri Oct 26 14:00:21 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

/*SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';*/

-- -----------------------------------------------------
-- Schema PadelDB
-- -----------------------------------------------------
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
-- -----------------------------------------------------
-- Schema PadelDB
-- -----------------------------------------------------
DROP DATABASE IF EXISTS `PadelDB`;
CREATE DATABASE `PadelDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `PadelDB` ;

-- DAMOS PERMISO USO Y BORRAMOS EL USUARIO QUE QUEREMOS CREAR POR SI EXISTE
--
GRANT USAGE ON * . * TO `userPadel`@`localhost`;
  DROP USER `userPadel`@`localhost`;
--
-- CREAMOS EL USUARIO Y LE DAMOS PASSWORD,DAMOS PERMISO DE USO Y DAMOS PERMISOS SOBRE LA BASE DE DATOS.
--
CREATE USER IF NOT EXISTS `userPadel`@`localhost` IDENTIFIED BY 'passPadel';
GRANT USAGE ON *.* TO `userPadel`@`localhost` REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `PadelDB`.* TO `userPadel`@`localhost` WITH GRANT OPTION;

-- -----------------------------------------------------
-- Table `PadelDB`.`Usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PadelDB`.`Usuarios` (
  `login` VARCHAR(9) NOT NULL,
  `password` VARCHAR(128) NOT NULL,
  `DNI` VARCHAR(9) NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  `Apellido` VARCHAR(45) NOT NULL,
  `Telefono` INT(9) NOT NULL,
  `Administrador` VARCHAR(9) NOT NULL,
  `Entrenador` VARCHAR(9) NOT NULL,
  PRIMARY KEY (`login`),
  UNIQUE KEY `login` (`login`)
  )
ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -----------------------------------------------------
-- Table `PadelDB`.`Clase`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PadelDB`.`Clase` (
  `idClase` INT NOT NULL,
  `Pista` VARCHAR(45) NOT NULL,
  `Precio` INT(3) NOT NULL,
  `Entrenador_login` VARCHAR(9) NOT NULL,
  PRIMARY KEY (`idClase`),
  INDEX `fk_Clase_Usuarios1_idx` (`Entrenador_login` ASC),
  CONSTRAINT `fk_Clase_Ususarios1`
    FOREIGN KEY (`Entrenador_login`)
    REFERENCES `PadelDB`.`Usuarios` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `PadelDB`.`Pista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PadelDB`.`Pista` (
  `idPistas` INT NOT NULL AUTO_INCREMENT,
  `num_Pista` INT NOT NULL,
  `Disponibilidad`  VARCHAR(2) NOT NULL,
  `Fecha/Hora` DATETIME NOT NULL,
  `Precio` FLOAT NOT NULL,
  PRIMARY KEY (`idPistas`))
ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `PadelDB`.`Partido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PadelDB`.`Partido` (
  `idPartido` INT NOT NULL,
  `Fecha/Hora` DATETIME(1) NOT NULL,
  `Pista_idPistas` INT NOT NULL,
  PRIMARY KEY (`idPartido`),
  INDEX `fk_Partido_Pista1_idx` (`Pista_idPistas` ASC),
  CONSTRAINT `fk_Partido_Pista1`
    FOREIGN KEY (`Pista_idPistas`)
    REFERENCES `PadelDB`.`Pista` (`idPistas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `PadelDB`.`Grupo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PadelDB`.`Grupo` (
  `idGrupo` INT NOT NULL,
  `Grupocol` VARCHAR(45) NOT NULL,
  `Partido_idPartido` INT NOT NULL,
  PRIMARY KEY (`idGrupo`),
  INDEX `fk_Grupo_Partido1_idx` (`Partido_idPartido` ASC),
  CONSTRAINT `fk_Grupo_Partido1`
    FOREIGN KEY (`Partido_idPartido`)
    REFERENCES `PadelDB`.`Partido` (`idPartido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `PadelDB`.`Clase_has_Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PadelDB`.`Clase_has_Usuario` (
  `Clase_idClase` INT NOT NULL,
  `Usuario_login` VARCHAR(9) NOT NULL,
  PRIMARY KEY (`Clase_idClase`, `Usuario_login`),
  INDEX `fk_Clase_has_Deportista_copy1_Deportista_copy11_idx` (`Usuario_login` ASC),
  INDEX `fk_Clase_has_Deportista_copy1_Clase_idx` (`Clase_idClase` ASC),
  CONSTRAINT `fk_Clase_has_Deportista_copy1_Clase`
    FOREIGN KEY (`Clase_idClase`)
    REFERENCES `PadelDB`.`Clase` (`idClase`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Clase_has_Deportista_copy1_Deportista_copy11`
    FOREIGN KEY (`Usuario_login`)
    REFERENCES `PadelDB`.`Usuarios` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -----------------------------------------------------
-- Table `PadelDB`.`Reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PadelDB`.`Reserva` (
  `idReserva` INT NOT NULL,
  `Deportista_login` VARCHAR(9) NULL,
  `Pista_idPistas` INT NOT NULL,
  PRIMARY KEY (`idReserva`),
  INDEX `fk_Reserva_Deportista1_idx` (`Deportista_login` ASC),
  INDEX `fk_Reserva_Pista1_idx` (`Pista_idPistas` ASC),
  CONSTRAINT `fk_Reserva_Deportista1`
    FOREIGN KEY (`Deportista_login`)
    REFERENCES `PadelDB`.`Usuarios` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reserva_Pista1`
    FOREIGN KEY (`Pista_idPistas`)
    REFERENCES `PadelDB`.`Pista` (`idPistas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `PadelDB`.`Campeonato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PadelDB`.`Campeonato` (
  `idCampeonato` VARCHAR(10) NOT NULL,
  `Periodo` VARCHAR(23) NOT NULL,
  `LimInscrip` DATE NOT NULL,
  `Categoria` VARCHAR(9) NOT NULL,
  `Sexo` ENUM('Masculino', 'Femenino', 'Mixto') NOT NULL,
  PRIMARY KEY (`idCampeonato`))
ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -----------------------------------------------------
-- Table `PadelDB`.`Campeonato_has_Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PadelDB`.`CampeonatoUsuario` (
  `idCampeonato`VARCHAR(10) NOT NULL,
  `login` VARCHAR(9) NOT NULL,
  PRIMARY KEY (`idCampeonato`, `login`),
  INDEX `fk_CampeonatoUsuario_copy1_Usuarios_copy11_idx` (`login` ASC),
  INDEX `fk_CampeonatoUsuario_copy1_Campeonato_idx` (`idCampeonato` ASC),
  CONSTRAINT `fk_CampeonatoUsuario_copy1_Campeonato`
    FOREIGN KEY (`idCampeonato`)
    REFERENCES `PadelDB`.`Campeonato` (`idCampeonato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CampeonatoUsuario_copy1_Usuarios_copy11`
    FOREIGN KEY (`login`)
    REFERENCES `PadelDB`.`Usuarios` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `PadelDB`.`Tabla de clasificación`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PadelDB`.`Tabla de clasificacion` (
  `idTabla de clasificacion` VARCHAR(10) NOT NULL,
  `Partidos Jugados` INT(3) NOT NULL,
  `Partidos Ganados` INT(3) NOT NULL,
  `Partidos Perdidos` INT(3) NOT NULL,
  `Partidos Empatados` INT(3) NULL,
  `Puntuacion` INT(3) NULL,
  `Campeonato_idCampeonato` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`idTabla de clasificacion`),
  INDEX `fk_Tabla de clasificacion_Campeonato1_idx` (`Campeonato_idCampeonato` ASC),
  CONSTRAINT `fk_Tabla de clasificacion_Campeonato1`
    FOREIGN KEY (`Campeonato_idCampeonato`)
    REFERENCES `PadelDB`.`Campeonato` (`idCampeonato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `PadelDB`.`Enfrentamiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PadelDB`.`Enfrentamiento` (
  `idEnfrentamiento` INT NOT NULL,
  `Fecha/Hora` DATETIME(1) NOT NULL,
  `Pareja1` VARCHAR(45) NOT NULL,
  `Pareja2` VARCHAR(45) NOT NULL,
  `Resultado1` ENUM('1', '2', 'X') NOT NULL,
  `Campeonato_idCampeonato` VARCHAR(10) NOT NULL,
  `Pistas_idPistas` INT ,
  PRIMARY KEY (`idEnfrentamiento`),
  INDEX `fk_Enfrentamiento_Campeonato1_idx` (`Campeonato_idCampeonato` ASC),
  INDEX `fk_Enfrentamiento_Pistas1_idx` (`Pistas_idPistas` ASC),
  CONSTRAINT `fk_Enfrentamiento_Campeonato1`
    FOREIGN KEY (`Campeonato_idCampeonato`)
    REFERENCES `PadelDB`.`Campeonato` (`idCampeonato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Enfrentamiento_Pistas1`
    FOREIGN KEY (`Pistas_idPistas`)
    REFERENCES `PadelDB`.`Pista` (`idPistas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `PadelDB`.`Parejas`
-- -----------------------------------------------------
/*CREATE TABLE IF NOT EXISTS `PadelDB`.`Parejas` (
  `idParejas` INT NOT NULL,
  `NombrePareja` VARCHAR(45) NOT NULL,
  `Tabla de clasificacion_idTabla de clasificacion` INT NOT NULL,
  PRIMARY KEY (`idParejas`),
  INDEX `fk_Parejas_Tabla de clasificacion1_idx` (`Tabla de clasificacion_idTabla de clasificacion` ASC),
  CONSTRAINT `fk_Parejas_Tabla de clasificacion1`
    FOREIGN KEY (`Tabla de clasificacion_idTabla de clasificacion`)
    REFERENCES `PadelDB`.`Tabla de clasificacion` (`idTabla de clasificacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;*/


-- -----------------------------------------------------
-- Table `PadelDB`.`Usuarios_has_Partido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PadelDB`.`Usuarios_has_Partido` (
  `Usuarios_login` VARCHAR(9) NOT NULL,
  `Partido_idPartido` INT NOT NULL,
  PRIMARY KEY (`Usuarios_login`, `Partido_idPartido`),
  INDEX `fk_Usuarios_has_Partido_Partido1_idx` (`Partido_idPartido` ASC),
  INDEX `fk_Usuarios_has_Partido_Usuarios1_idx` (`Usuarios_login` ASC),
  CONSTRAINT `fk_Usuarios_has_Partido_Usuarios1`
    FOREIGN KEY (`Usuarios_login`)
    REFERENCES `PadelDB`.`Usuarios` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuarios_has_Partido_Partido1`
    FOREIGN KEY (`Partido_idPartido`)
    REFERENCES `PadelDB`.`Partido` (`idPartido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*
-- -----------------------------------------------------
-- Table `PadelDB`.`Categoría`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PadelDB`.`Categoría` (
  `idCategoría` INT NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  `Campeonato_idCampeonato` INT NOT NULL,
  PRIMARY KEY (`idCategoría`),
  INDEX `fk_Categoría_Campeonato1_idx` (`Campeonato_idCampeonato` ASC),
  CONSTRAINT `fk_Categoría_Campeonato1`
    FOREIGN KEY (`Campeonato_idCampeonato`)
    REFERENCES `PadelDB`.`Campeonato` (`idCampeonato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `PadelDB`.`Categoría_has_Parejas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PadelDB`.`Categoría_has_Parejas` (
  `Categoría_idCategoría` INT NOT NULL,
  `Parejas_idParejas` INT NOT NULL,
  PRIMARY KEY (`Categoría_idCategoría`, `Parejas_idParejas`),
  INDEX `fk_Categoría_has_Parejas_Parejas1_idx` (`Parejas_idParejas` ASC),
  INDEX `fk_Categoría_has_Parejas_Categoría1_idx` (`Categoría_idCategoría` ASC),
  CONSTRAINT `fk_Categoría_has_Parejas_Categoría1`
    FOREIGN KEY (`Categoría_idCategoría`)
    REFERENCES `PadelDB`.`Categoría` (`idCategoría`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Categoría_has_Parejas_Parejas1`
    FOREIGN KEY (`Parejas_idParejas`)
    REFERENCES `PadelDB`.`Parejas` (`idParejas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

*/
-- -----------------------------------------------------
-- Table `PadelDB`.`Parejas_has_Usuarios`
-- -----------------------------------------------------
/*CREATE TABLE IF NOT EXISTS `PadelDB`.`Parejas_has_Usuarios` (
  `Parejas_idParejas` INT NOT NULL,
  `Usuarios_DNI` VARCHAR(9) NOT NULL,
  PRIMARY KEY (`Parejas_idParejas`, `Usuarios_DNI`),
  INDEX `fk_Parejas_has_Usuarios_Usuarios1_idx` (`Usuarios_DNI` ASC),
  INDEX `fk_Parejas_has_Usuarios_Parejas1_idx` (`Parejas_idParejas` ASC),
  CONSTRAINT `fk_Parejas_has_Usuarios_Parejas1`
    FOREIGN KEY (`Parejas_idParejas`)
    REFERENCES `PadelDB`.`Parejas` (`idParejas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Parejas_has_Usuarios_Usuarios1`
    FOREIGN KEY (`Usuarios_DNI`)
    REFERENCES `PadelDB`.`Usuarios` (`DNI`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;*/


/*SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;*/

/* INSERTS*/
INSERT INTO `usuarios`(`login`, `password`, `DNI`, `Nombre`, `Apellido`, `Telefono`, `Administrador`, `Entrenador`) 
VALUES ('admin','admin','12345678A','Admin','istrador','666666666','TRUE','FALSE');

INSERT INTO `usuarios`(`login`, `password`, `DNI`, `Nombre`, `Apellido`, `Telefono`, `Administrador`, `Entrenador`) 
VALUES ('entrenador','entrenador','12345678E','Coach','Lillo','666666667','FALSE','TRUE');

INSERT INTO `campeonato`(`idCampeonato`, `Periodo`, `LimInscrip`, `Categoria`, `Sexo`) 
VALUES ('CMP1','10/09/2018-30/09/2018','2018-09-05','1','Masculino');

INSERT INTO `pista` (`idPistas`, `num_Pista`, `Disponibilidad`, `Fecha/Hora`, `Precio`) 
VALUES ('1', '1', 'SI', '2018-11-01 09:00:00', '7.50');
INSERT INTO `pista` (`idPistas`, `num_Pista`, `Disponibilidad`, `Fecha/Hora`, `Precio`) 
VALUES ('2', '1', 'SI', '2018-11-02 09:00:00', '7.50');
INSERT INTO `pista` (`idPistas`, `num_Pista`, `Disponibilidad`, `Fecha/Hora`, `Precio`) 
VALUES ('3', '2', 'SI', '2018-11-01 10:30:00', '7.50');
INSERT INTO `pista` (`idPistas`, `num_Pista`, `Disponibilidad`, `Fecha/Hora`, `Precio`) 
VALUES ('4', '2', 'SI', '2018-11-02 10:30:00', '7.50');
INSERT INTO `pista` (`idPistas`, `num_Pista`, `Disponibilidad`, `Fecha/Hora`, `Precio`) 
VALUES ('5', '3', 'SI', '2018-11-01 12:00:00', '7.50');
INSERT INTO `pista` (`idPistas`, `num_Pista`, `Disponibilidad`, `Fecha/Hora`, `Precio`) 
VALUES ('6', '3', 'SI', '2018-11-02 12:30:00', '7.50');





/*INSERT INTO Usuarios_has_Partido (Usuarios_DNI, Partido_idPartido)
VALUES ('49710115Z', '3');

INSERT INTO Parejas_has_Usuarios (Parejas_idParejas, Usuarios_DNI)
VALUES ('1', '49710115Z');

INSERT INTO Categoría_has_Parejas (Categoría_idCategoría, Parejas_idParejas)
VALUES ('1', '2');

INSERT INTO Categoría (idCategoría, Nombre, Campeonato_idCampeonato)
VALUES ('1', 'MASC1', '2');

INSERT INTO Administrador (DNI, Nombre, Apellidos, Teléfono, Campeonato_idCampeonato)
VALUES ('12345678W', 'Jorge', 'Carlos', '897987987', '1');

INSERT INTO Entrenador (DNI, Nombre, Apellidos, Teléfono)
VALUES ('12345378W', 'Jorges', 'Carlo', '897981987');

INSERT INTO Usuarios (login,password,DNI, Nombre, Apellidos, Teléfono, Administrador, Grupo_idGrupo)
VALUES ('lillo10','hola',12345365W', 'Josh', 'Carl', '897981985', 'TRUE', '1');

INSERT INTO Campeonato (idCampeonato, Categoría, Período, Limite Inscripcion)
VALUES ('1', 'M1', '31/10/2018 -- 31/12/2018', '31/9/2018 -- 31/10/2018' );

INSERT INTO Reserva (idReserva, precio, Deportista_DNI, Fecha/Hora)
VALUES ('2', '500', '44444444W', '31/9/2018');

INSERT INTO Enfrentamiento (idEnfrentamiento, Fecha/Hora, Pareja1, Pareja2, Resultado1, Campeonato_idCampeonato, Pistas_idPistas)
VALUES ('1', '31/12/2018', 'Jorge C.', 'Abraham A.', 'X', '1', '1');

INSERT INTO Tabla de clasificación (idTabla de clasificación, Partidos Jugados, Partidos Ganados, Partidos Perdidos, Partidos Empatados, Puntuación, Campeonato_idCampeonato)
VALUES ('1', 'BLABLA', '2', '1', '1', '0', '3', '1');

INSERT INTO Partido (idPartido, Fecha/Hora, Pista_idPistas)
VALUES ('1', '31/12/2018', '1');

INSERT INTO Pista (idPistas, Disponibilidad, Fecha/Hora)
VALUES ('2', 'TRUE', '31/12/2018');

INSERT INTO Clase (idClase, Pista, Precio, Entrenador_DNI)
VALUES ('1', '1', '500', '44444444X');*/
