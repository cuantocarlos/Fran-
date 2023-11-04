# Fran-Kevin-Pablo

<!-- 
Desarrollo de Aplicación Web para Intercambio de Servicios en PHP
En esta práctica, crearéis una aplicación de intercambio de servicios entre usuarios. Los usuarios de nuestra aplicación podrán:
    • Registrarse en nuestra página
    • Iniciar sesión
    • Modificar algunos de sus campos del perfil de Usuario
    • Gestión de Servicios. Los usuarios pueden crear los servicios que estén dispuestos a ofrecer a otros usuarios.
    • Búsqueda de servicios disponibles utilizando varios filtros, como palabras clave, categorías, …
    • Solicitud de Servicios. Los usuarios podrán enviar solicitudes a otros usuarios para utilizar sus servicios.
    •  Los propietarios de los servicios deben recibir notificaciones de las solicitudes y poder aceptar o rechazarlas.
    • Calificaciones y Comentarios. Los usuarios deben poder calificar y dejar comentarios sobre los servicios que han utilizado.
La práctica se divide en varias fases, que incluyen la creación de formularios, almacenamiento en ficheros de texto,  la gestión de cookies y sesiones, el acceso a bases de datos y la implementación de servicios web. La aplicación contará con dos tipos de usuarios: "administrador" y "usuario genérico" que podrán realizar acciones diferentes en la aplicación.
Además, se incorporarán medidas de seguridad, como la autenticación de la cuenta de correo electrónico y el uso de tokens para prevenir ataques CSRF. 
La práctica la realizaréis en grupos de dos personas. Para mejorar el trabajo en equipo crearéis un repositorio en GITHUB, el nombre del repositorio estará compuesto por vuestros nombre (pablo_juan). Desde el inicio me invitaréis para poder realizar el seguimiento. Una vez finalizada cada una de las fases subiréis el resultado a AULES.
Fase 1: Formularios (0,5 puntos)
En esta fase, os centraréis en la creación y procesamiento de los formularios que permitan a los usuarios registrarse, iniciar sesión,  modificar sus perfiles y dar de alta servicios a compartir.
No se deben incluir validaciones del lado cliente ni con HTML5 ni con JS.
Usaremos las funciones de sanitización y validación vistas en clase.
Crearemos de manera dinámica todos los controles tipo radio, check o select.
Tareas a realizar en la Fase 1
Antes de crear los formularios planifica el mapa de la aplicación completa y crea unos sencillos mockups. Súbelos también a GITHUB.
Formulario de Registro
Los usuarios deben poder registrarse proporcionando los siguientes datos:
    • Nombre completo. (obligatorio)
    • Dirección de correo electrónico. (obligatorio)
    • Contraseña. (obligatorio)
    • Fecha de nacimiento. Sólo permitiremos el registro de mayores de edad. (obligatorio)
    • Foto de perfil (campo voluntario)
    • Idioma preferente (campo voluntario) Daremos a los usuarios una lista de idiomas para que seleccionen uno o más de uno.
    • Descripción personal (campo voluntario)
Formulario de Inicio de Sesión
   Los usuarios registrados iniciarán sesión en la aplicación utilizando su dirección de correo electrónico y contraseña.
 Formulario de Perfil de Usuario
   Cada usuario puede modificar la información de algunos de los campos de su perfil:
    • Contraseña. 
    • Foto de perfil 
    • Idioma preferente 
    • Descripción personal 
Formulario Alta servicio
    •     Título`: Título o nombre del servicio. (obligatorio)
    •     Categoría:  Categoría a la que pertenece el servicio, les daremos una lista de categorías para que el usuario elija en la categoría que pertenece. (obligatorio)
    •    Descripcion: Descripción detallada del servicio. (obligatorio)
    • Tipo: El usuario elije si es servicio para intercambio o de pago (obligatorio)
    •     Precio_por_hora: Precio por hora del servicio, en caso de que sea de pago. (voluntario)
    •     Ubicacion: Ubicación del servicio. (obligatorio)
    •     Disponibilidad: Información sobre la disponibilidad del servicio. Ofreceremos diferentes opciones, por ejemplo mañanas, tardes, noches, completa, fines de semana, ... (obligatoria)
    •     Foto del servicio: Foto referente al servicio (voluntario)
 -->