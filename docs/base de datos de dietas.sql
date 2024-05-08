-- Base de datos: sayafit_db
-- --------------------------------------------------------

-- Estructura de la tabla `ingredientes`
-- Almacena todos los ingredientes disponibles en la base de datos.
CREATE TABLE `ingredientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Estructura de la tabla `recetas`
-- Contiene información sobre las recetas, como título y preparación.
CREATE TABLE `recetas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `preparacion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Estructura de la tabla `recetas_ingredientes`
-- Establece una relación muchos a muchos entre recetas e ingredientes,
-- permitiendo que una receta tenga varios ingredientes y viceversa.
CREATE TABLE `recetas_ingredientes` (
  `receta_id` int(11) NOT NULL,
  `ingrediente_id` int(11) NOT NULL,
  PRIMARY KEY (`receta_id`,`ingrediente_id`),
  CONSTRAINT `fk_receta` FOREIGN KEY (`receta_id`) REFERENCES `recetas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ingrediente` FOREIGN KEY (`ingrediente_id`) REFERENCES `ingredientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Estructura de la tabla `planes_de_dieta`
-- Se utiliza para almacenar información sobre los planes de dieta de los clientes,
-- incluyendo el nombre del cliente, el número de días de entrenamiento, la fecha de inicio y la fecha de finalización del plan.
CREATE TABLE `planes_de_dieta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(255) NOT NULL,
  `dias_entrenamiento` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Estructura de la tabla `planes_recetas`
-- Relaciona los planes de dieta con las recetas asignadas a cada comida del día para cada día de la semana.
CREATE TABLE `planes_recetas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `dia_semana` varchar(20) NOT NULL,
  `comida` varchar(20) NOT NULL,
  `receta_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_plan` FOREIGN KEY (`plan_id`) REFERENCES `planes_de_dieta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_receta_plan` FOREIGN KEY (`receta_id`) REFERENCES `recetas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

