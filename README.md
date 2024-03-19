# cvWeb
Proyecto DAW.

Este es mi Proyecto DAW para el Ciclo Formativo de Grado Superior de Desarrollo de Aplicaciones Web.

**Finalidad del repositorio**: Mejorar el código desarrollado, quitar código duplicado, utilización de enrutamiento, aplicación de patrones de diseño, en definitiva mejorar mis habilidades de programación.

**Aplicación web para la gestión del seguimiento de envío de currículos a ofertas de empleo y/o prácticas en empresa.**

**Tiempo de realización:** 20/10/2023 a 05/12/2023

**Métodología utilizada:** Cascada e Iterativa Incremental.

**Necesidades y finalidad.**
La realización de este proyecto parte de la necesidad de tener en un mismo lugar registradas todas las ofertas de trabajo a las que hemos aplicado por distintos medios, con la finalidad de tenerlas centralizadas para poder ser consultadas.

**Tecnologías y herramientas utilizadas:**

**Front-end:**

* HTML5: Lenguaje de marcado utilizado para la estructura de la aplicación web, que permite organizar el contenido mediante etiquetas que definen el contenido de nuestra web.
* CSS: Como su propio nombre indica es la hoja de estilos en cascada que nos permite añadir estilos gráficos a los documentos escritos en lenguaje de marcado, en nuestro caso HTML5
* Bootstrap 5.3.2: librería multiplataforma de código abierto que mejora el diseño en la aplicación web, haciéndolo más adaptable y responsive. En concreto, los estilos han sido aplicados en forma de clases a las tablas, formularios, botones, también incluye extensiones JavaScript que mejoran el diseño y la usabilidad.
* JavaScript utilizado para dar funcionalidad e interactividad a esta aplicación web, especialmente en el manejo de formularios y envío de información del cliente al servidor

**Backend:**
* XAMPP: paquete de software libre, que me ha permitido tener mi servidor local y alojamiento para la base de datos. Este software incluye:
  *	Apache como servidor local, intérprete de los scripts del lenguaje php
  *	Motor de Base de datos: MariaDb, basada en MySQL.
  *	PhpMyAdmin: gestión eficaz de la base de datos, implementación, diseños y consultas de forma gráfica.
* SQL, creación del modelo conceptual, lógico y físico de la base de datos que alimenta la aplicación web; así como la definición, manipulación y control de datos. 
* php. Se ha utilizado para la generación dinámica de páginas web y acceso a datos, manejando las peticiones del cliente y mostrando las respuestas del servidor. 

**Entorno de Desarrollo Integrado (IDE):**
Visual Studio Code: editor utilizado para la codificación de HTML, CSS, JavaScript y php. Permite la utilización de plugins que facilitan la labor de programación y total integración con Git.

**Requisitos Funcionales**

Los Requisitos Funcionales son los siguientes, agrupados por Casos de Uso
1.	Usuario no registrado puede hacer Registro, pueden registrarse como rol usuario si el usuario no existe y es válido.
2.	Usuario registrado puede iniciar sesión y cerrar sesión. Dos tipos de usuarios registrados por rol: administrador y usuario.
3.	 Rol administrador:  
 a.	Listar usuarios registrados por nombre y correo.  
4.	Rol usuario registrado Ofertas.   
 a.	Ver su listado de ofertas específico.   
 b.	Modificar sus ofertas.   
 c.	Eliminar sus ofertas.   
 d.	Añadir ofertas  
 e.	Filtrar ofertas por estado abierto, cerrado, guardado.   
5.	Rol usuario registrado Envíos  
 a.	Ver listado tipos de envío.  
 b.	Modificar tipo de envíos.  
 c.	Eliminar tipos de envíos si no está relacionado con ofertas.  
 d.	Añadir tipos de envío.  
6.	Rol usuario registrado listado de empresas.  
 a.	Ver listado de empresas.   
 b.	Modificar empresas.   
 c.	Eliminar empresas si no están relacionadas con las ofertas.  
 d.	Añadir empresas.   
7.	Rol usuario registrado Contactos:  
 a.	Ver listado  
 b.	Modificar Contactos.  
 c.	Añadir contactos.  
 d.	Eliminar contactos.  

**Requisitos no funcionales:**

1.	La aplicación deberá manejar y mostrar mensajes de error. 
2.	El diseño general de la aplicación debe ser homogéneo.
3.	La aplicación no mostrará ninguna publicidad.
4.	Los botones y menús utilizados en la aplicación deben ser legibles.
5.	La aplicación debe implementar medidas de seguridad, autentificación de usuarios y administradores para acceder con seguridad a los datos.
6.	Interfaz de usuario intuitiva y fácil de usar.
7.	Código fácil de mantener. 
8.	La aplicación será compatible con los navegadores Google Chrome, Microsoft Edge y Firefox. 
9.	La aplicación empleará CSS flexbox, para la creación de un diseño responsive.

**Pasos seguidos en el desarrollo del proyecto:** 

* Implementación de la base de datos diseñada.
* Realización del apartado de ofertas: listarlas, agregarlas, modificarlas y eliminarlas.
* Añadir Login y Registro a la aplicación.
* Desarrollo del Rol de administrador.
* Apartado de empresas: listarlas, agregarlas, modificarlas y eliminarlas.
* Apartado de envíos: listarlos, agregarlos, modificarlos y eliminarlos.
* Apartado de contactos: listarlos, agregarlos, modificarlos y eliminarlos.
* Revisión de menús, operatividad conjunta y funcionalidad general.

 

