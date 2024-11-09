# 📁 Proyecto5_Drive

**Proyecto5_Drive** es una aplicación sencilla de almacenamiento de archivos, diseñada para que puedas gestionar y compartir tus documentos en línea de forma rápida y organizada. Aquí puedes subir, descargar, organizar y hasta compartir enlaces para que otros vean tus archivos. Todo, en una interfaz clara y funcional con ayuda de **Laravel** y **Bulma CSS**.

## Funcionalidades Principales

- **Subida y descarga de archivos**: Guarda tus archivos y recupéralos fácilmente cuando los necesites.
- **Organización inteligente**: Clasifica tus archivos en públicos o privados. Además, marca los que más usas como "Favoritos" para encontrarlos rápidamente.
- **Compartición simplificada**: Genera enlaces compartibles para archivos públicos. Comparte tus archivos con un solo clic.
- **Vistas previas**: Visualiza imágenes y archivos de texto directamente en la aplicación, sin necesidad de descargarlos.
- **Etiquetas de colores**: Los archivos muestran una etiqueta de color según su extensión, ayudando a identificarlos visualmente.
- **Límite de almacenamiento**: Cada usuario tiene un espacio de 100MB, así que puedes subir lo esencial sin preocupaciones.
- **Confirmación de eliminaciones**: Evita eliminar archivos por accidente gracias a las confirmaciones de acción.

## Control de Auditoría

Para mantener el orden, el administrador de la aplicación puede revisar un registro de las acciones realizadas, como subidas y eliminaciones de archivos. Esto ayuda a tener una vista general del uso de la plataforma.

## ¿Qué hay detrás?

**Proyecto5_Drive** está desarrollado con el framework **Laravel** y estilizado con **Bulma CSS** para lograr una interfaz intuitiva y profesional. Cada funcionalidad está pensada para ofrecer una experiencia de usuario fluida y amigable, con notificaciones de éxito y error para cada acción importante.

---

## 📂 Archivos Principales

Para facilitar la navegación por el proyecto, aquí tienes un acceso rápido a los archivos clave:

- **Rutas principales** - `routes/web.php`: Define las rutas de la aplicación, incluyendo las rutas protegidas y de compartición de archivos.
- **Controlador de Archivos** - `app/Http/Controllers/FicheroController.php`: Gestiona las funcionalidades de subida, descarga, y eliminación de archivos.
- **Controlador de Auditoría** - `app/Http/Controllers/AuditController.php`: Controla el registro de acciones para la revisión del administrador.
- **Política de Acceso a Archivos** - `app/Policies/FicheroPolicy.php`: Define las reglas de acceso y permisos para que los usuarios gestionen sus archivos.
- **Modelo de Archivo** - `app/Models/Fichero.php`: Representa la estructura de los archivos en la base de datos.
- **Modelo de Auditoría** - `app/Models/Audit.php`: Define el modelo para almacenar los registros de actividades de los usuarios.
- **Vista Principal** - `resources/views/welcome.blade.php`: La interfaz principal para la gestión de archivos, que incluye el formulario de subida, la lista de archivos y sus opciones.

---

¡Bienvenido a Proyecto5_Drive, tu nuevo espacio para almacenar y gestionar archivos en la web!