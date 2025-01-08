# Laravel Comentarios

Este proyecto es una aplicación básica en Laravel para la gestión de comentarios, implementando operaciones CRUD (Crear, Leer, Actualizar, Eliminar) mediante rutas simples de Laravel. En lugar de usar una base de datos, los comentarios se almacenan en una sesión PHP, y la protección CSRF está desactivada para facilitar las pruebas.

## Descripción General

La aplicación permite crear, ver, editar y eliminar comentarios utilizando rutas básicas de Laravel. La persistencia de los comentarios se realiza en una sesión PHP, en un array de strings, para simplificar el manejo de datos y eliminar la necesidad de una base de datos.

## Rutas

A continuación se detallan las rutas implementadas en el proyecto, con el método HTTP correspondiente, la URL, el método del controlador, y una breve descripción de su funcionalidad:

1. **GET /comments**
    - **Método del controlador**: `index()`
    - **Descripción**: Llama al método `index` en `CommentController` y retorna un array de todos los comentarios almacenados en la sesión.
2. **GET /comments/create**
    - **Método del controlador**: `create()`
    - **Descripción**: Llama al método `create` y retorna un formulario HTML para crear un nuevo comentario. Este formulario incluye un campo de texto y un botón de envío que realiza una petición POST a `/comments`.
3. **POST /comments**
    - **Método del controlador**: `store(Request $request)`
    - **Descripción**: Llama al método `store`, agrega un nuevo comentario al array de comentarios en la sesión y retorna el array actualizado.
4. **GET /comments/{commentid}**
    - **Método del controlador**: `show(string $commentid)`
    - **Descripción**: Llama al método `show` para obtener y retornar el comentario en la posición especificada por `{commentid}` en el array.
5. **GET /comments/{commentid}/edit**
    - **Método del controlador**: `edit(string $commentid)`
    - **Descripción**: Llama al método `edit` y retorna un formulario HTML para editar el comentario en la posición `{commentid}`. Este formulario envía una petición PATCH a `/comments/{commentid}`.
6. **PATCH /comments/{commentid}**
    - **Método del controlador**: `update(Request $request, string $commentid)`
    - **Descripción**: Llama al método `update`, modifica el comentario en la posición `{commentid}` en el array y retorna el array de comentarios actualizado.
7. **DELETE /comments/{commentid}**
    - **Método del controlador**: `destroy(string $commentid)`
    - **Descripción**: Llama al método `destroy`, elimina el comentario en la posición `{commentid}` y retorna el array de comentarios actualizado.

## Gestión de Sesión

Los comentarios se almacenan en la sesión utilizando un array de strings. Esto permite mantener los datos durante la sesión del usuario sin necesidad de configurar una base de datos. Para más detalles sobre el manejo de sesiones en Laravel.

## Requisitos

Para ejecutar este proyecto, necesitarás instalar:

- **PHP** (versión 8.0 o superior)
- **Composer** (gestor de dependencias para PHP)
- **Laravel** (instalable a través de Composer)