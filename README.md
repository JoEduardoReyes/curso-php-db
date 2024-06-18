# Proyecto de Conexión a Base de Datos con PHP

Este proyecto fue desarrollado como parte del curso de Conexión a Base de Datos con PHP en Platzi. Está diseñado para demostrar el uso de tecnologías como PDO, PHP, Composer y SQL en el contexto de una aplicación web básica para gestionar ingresos y retiros financieros.

![PHP Version](https://img.shields.io/badge/php-%3E%3D%208.1-blue)
![PDO](https://img.shields.io/badge/database-PDO-green)
![Composer](https://img.shields.io/badge/composer-vendor-blueviolet)
![License](https://img.shields.io/badge/license-MIT-green)


## Estructura del Proyecto

El proyecto está organizado de la siguiente manera:

- **App/**
    - **Controllers/**
        - `IncomesController.php`: Controlador para gestionar ingresos.
        - `WithdrawalsController.php`: Controlador para gestionar retiros.

- **database/**
    - **MySQLi/**
        - `Connection.php`: Conexión usando MySQLi (opcional).
    - **PDO/**
        - `Connection.php`: Conexión usando PDO (recomendado).

- **public/**
    - **CSS/**
        - `create.css`: Estilos para la vista de creación.
        - `styles.css`: Estilos generales.
    - `.htaccess`: Configuración para enrutamiento.
    - `index.php`: Punto de entrada principal de la aplicación.

- **resources/**
    - **views/**
        - **incomes/**
            - `create.php`: Vista para crear ingresos.
            - `index.php`: Vista para listar ingresos.
        - **withdrawals/**
            - `create.php`: Vista para crear retiros.
            - `index.php`: Vista para listar retiros.

- **router/**
    - `RouterHandler.php`: Manejador de rutas para los controladores.

- **SQL/**
    - `README.sql`: Scripts SQL para crear la base de datos y tablas.

- **vendor/**: Directorio de Composer con las dependencias.

- `.env`: Archivo para configuración de variables de entorno donde se deben almacenar las variables para la conexion a la base de datos.

- `.gitignore`: Archivo de configuración para ignorar archivos y directorios en Git.

- `composer.json`: Archivo de configuración de Composer.

- `composer.lock`: Archivo generado por Composer para asegurar la consistencia de las versiones.

- `DB Diagram.drawio`: Diagrama de la base de datos (formato Draw.io).


## Funcionalidades

Cada controlador implementa los métodos estándar para realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar):

- **IncomesController.php**: Gestiona los ingresos financieros.
- **WithdrawalsController.php**: Gestiona los retiros financieros.

## Configuración

- **Conexion a Base de Datos**: Se implementa tanto con MySQLi como con PDO. La configuración se realiza mediante variables de entorno en el archivo `.env`.

- **Librerías Externas**: Utiliza Composer para gestionar las dependencias, incluyendo `vlucas/phpdotenv` para la carga de variables de entorno.

## Uso

1. Clona el repositorio a tu máquina local.
2. Crea un archivo `.env` en la raíz del proyecto y configura las variables de entorno necesarias (consultar `.env.example` para referencia).
3. Instala las dependencias utilizando Composer: `composer install`.
4. Crea la base de datos y las tablas utilizando los scripts SQL proporcionados en `SQL/README.sql`.
5. Ejecuta el servidor local (por ejemplo, XAMPP, WampServer, etc.) y accede a la aplicación desde tu navegador.

## Contribuciones

Las contribuciones son bienvenidas. Si deseas mejorar el proyecto, por favor abre un issue o envía un pull request.

## Autor

Creado por EDarkMatter - [edarkmatter.com]()

## Licencia

Este proyecto está licenciado bajo la Licencia MIT. Consulta el archivo `LICENSE` para más detalles.
