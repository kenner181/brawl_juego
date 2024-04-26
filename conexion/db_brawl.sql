
CREATE TABLE `niveles` (
  `id_nivel` INT PRIMARY KEY,
  `nombre_nivel` VARCHAR(255),
  `puntos_requeridos` INT
);

CREATE TABLE `armas` (
  `id_arma` INT PRIMARY KEY,
  `nombre_arma` VARCHAR(255),
  `cantidad_municion` INT,
  `daño` INT,
  `imagen_arma` VARCHAR(255),
  `id_nivel` INT,
  FOREIGN KEY (`id_nivel`) REFERENCES `niveles`(`id_nivel`)
);




CREATE TABLE `estado` (
  `id_estado` INT PRIMARY KEY,
  `estado` VARCHAR(255)
);

CREATE TABLE `roles` (
  `id_rol` INT PRIMARY KEY,
  `rol` VARCHAR(255)
);



CREATE TABLE `avatar` (
  `id_avatar` INT PRIMARY KEY,
  `nombre` VARCHAR(255),
  `foto` VARCHAR(255),

);

CREATE TABLE `usuarios` (
  `id` INT PRIMARY KEY,
  `username` VARCHAR(255),
  `contraseña` VARCHAR(255),
  `correo` VARCHAR(255),
  `puntaje` INT,
  `vida` INT,
  `id_estado` INT,
  `id_rol` INT,
  `id_nivel` INT,
  `id_avatar` INT,
  
  FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`),
  FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  FOREIGN KEY (`id_nivel`) REFERENCES `niveles` (`id_nivel`),
  FOREIGN KEY (`id_avatar`) REFERENCES `avatar` (`id_avatar`)
  );

  CREATE TABLE `mundos` (
  `id_mundo` INT PRIMARY KEY,
  `nombre_mundo` VARCHAR(255),
  `foto` VARCHAR(255),
  `id_jugador1` INT,
  `id_jugador2` INT,
  `id_jugador3` INT,
  `id_jugador4` INT,
  `id_jugador5` INT,
  FOREIGN KEY (`id_jugador1`) REFERENCES `usuarios` (`id`),
  FOREIGN KEY (`id_jugador2`) REFERENCES `usuarios` (`id`),
  FOREIGN KEY (`id_jugador3`) REFERENCES `usuarios` (`id`),
  FOREIGN KEY (`id_jugador4`) REFERENCES `usuarios` (`id`),
  FOREIGN KEY (`id_jugador5`) REFERENCES `usuarios` (`id`)
);
);
CREATE TABLE `d_partidas` (
  `id_partida` INT PRIMARY KEY,
  `id_jugador_atacante` INT,
  `id_jugador_defensor` INT,
  `id_arma` INT,
  `id_mundo` INT,
  `puntos_obtenidos` INT,
  `tiempo_inicio` DATETIME,
  `tiempo_fin` DATETIME,
  FOREIGN KEY (`id_jugador_atacante`) REFERENCES `usuarios` (`id`),
  FOREIGN KEY (`id_jugador_defensor`) REFERENCES `usuarios` (`id`),
  FOREIGN KEY (`id_mundo`) REFERENCES `mundos` (`id_mundo`),
  FOREIGN KEY (`id_arma`) REFERENCES `armas` (`id_arma`)
);
CREATE TABLE `posiciones` (
  `id_ps` INT,
  `id_jugador1` INT,
  `id_jugador2` INT,
  `id_jugador3` INT,
  `id_jugador4` INT,
  `id_jugador5` INT,
  `id_mundo` INT,
  FOREIGN KEY (`id_jugador1`) REFERENCES `usuarios` (`id`),
  FOREIGN KEY (`id_jugador2`) REFERENCES `usuarios` (`id`),
  FOREIGN KEY (`id_jugador3`) REFERENCES `usuarios` (`id`),
  FOREIGN KEY (`id_jugador4`) REFERENCES `usuarios` (`id`),
  FOREIGN KEY (`id_jugador5`) REFERENCES `usuarios` (`id`),
  FOREIGN KEY (`id_mundo`) REFERENCES `mundos` (`id_mundo`)
);
