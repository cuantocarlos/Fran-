Fase 1: Formularios

En la fase 1 del desarrollo de la aplicación para el Intercambio de Servicios en PHP, nos centramos en la creación y procesamiento de formularios que permiten a los usuarios llevar a cabo diversas acciones. A continuación, se detallan las características principales de esta fase:

Formulario de Registro:

Los usuarios pueden registrarse proporcionando la siguiente información:

    Nombre completo (obligatorio)
    Dirección de correo electrónico (obligatorio)
    Contraseña (obligatorio)
    Fecha de nacimiento (obligatorio para mayores de edad)
    Foto de perfil (opcional)
    Idioma preferente (opcional)
    Descripción personal (opcional)

Formulario de Inicio de Sesión:

Usuarios registrados acceden a la aplicación utilizando su dirección de correo electrónico y contraseña.

Formulario de Perfil de Usuario:

Cada usuario puede modificar la información de algunos campos de su perfil, incluyendo:

    Contraseña
    Foto de perfil
    Idioma preferente
    Descripción personal

Formulario Alta Servicio:

Usuarios pueden dar de alta servicios para compartir proporcionando los siguientes datos:

    Título: Título o nombre del servicio (obligatorio)
    Categoría: Categoría a la que pertenece el servicio (obligatorio)
    Descripción: Descripción detallada del servicio (obligatorio)
    Tipo: El usuario elige si es un servicio para intercambio o de pago (obligatorio)
    Precio por hora: Precio por hora del servicio (opcional)
    Ubicación: Ubicación del servicio (obligatorio)
    Disponibilidad: Información sobre la disponibilidad del servicio (obligatorio)
    Foto del servicio (opcional)

Seguridad:

La aplicación incorpora medidas de seguridad, como autenticación de la cuenta de correo electrónico y el uso de tokens para prevenir ataques CSRF.

Trabajo en Equipo:

La práctica se realiza en grupos de dos personas, se crea un repositorio en GitHub con el nombre compuesto por los nombres de los miembros del equipo (por ejemplo, pablo_juan). El profesor se invita desde el inicio para realizar el seguimiento, y se sube el resultado de cada fase a AULES.

Mockups:

Antes de crear los formularios, se planifica el mapa de la aplicación completa y se crean mockups para una mejor visualización y diseño.

Fase 2: Ficheros

En la fase 2 del desarrollo de la aplicación, nos enfocamos en el almacenamiento de datos en ficheros de texto y otras funcionalidades. A continuación, se describen las tareas a realizar en esta fase:

    En los formularios de registro y alta de servicio, una vez los datos son correctos, se almacenan en los ficheros usuarios.txt y servicios.txt, respectivamente. Cada línea del fichero contiene la información de un usuario o servicio, añadiendo la fecha de alta.
    Se crea un fichero logLogin.txt donde se almacenan el usuario, la contraseña y la fecha cuando se produce un fallo de autentificación en el login.
    Se implementa la funcionalidad de login, verificando si el usuario y la contraseña son correctos.
    Después de iniciar sesión, el usuario accede a una página privada que muestra todos los servicios disponibles y al menos un enlace para dar de alta un nuevo servicio.
    En la página inicial de la aplicación, aparece una lista con el título de los servicios. Además, el usuario puede registrarse y acceder a su cuenta.

Estas tareas sientan las bases para el manejo de datos y la interacción con la aplicación en las siguientes fases del desarrollo.
