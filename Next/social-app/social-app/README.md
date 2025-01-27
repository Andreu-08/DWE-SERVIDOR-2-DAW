# Social App

La aplicación tiene como objetivo simular las funcionalidades básicas de una red social, permitiendo la interacción entre usuarios a través de comentarios, "likes" y la visualización de publicaciones.

---

## Tecnologías utilizadas

- ![Next.js](https://img.shields.io/badge/Next.js-000000?style=flat&logo=next.js&logoColor=white) **Next.js**: Framework de React para renderizado híbrido y desarrollo web moderno.
- ![React](https://img.shields.io/badge/React-61DAFB?style=flat&logo=react&logoColor=black) **React**: Biblioteca de JavaScript para construir interfaces de usuario.
- ![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=flat&logo=tailwind-css&logoColor=white) **Tailwind CSS**: Framework CSS para diseño rápido y eficiente.
- ![Node.js](https://img.shields.io/badge/Node.js-339933?style=flat&logo=node.js&logoColor=white) **Node.js**: Entorno de ejecución de JavaScript para desarrollo backend.

---

## Estructura del proyecto

La estructura principal del proyecto está organizada de la siguiente manera:

### Rutas principales (pages)

- **[`/`](./app/page.jsx)**: Página principal que muestra el feed de publicaciones.
- **[`/create`](./app/create/page.jsx)**: Página para crear nuevas publicaciones.
- **[`/profile`](./app/profile/page.jsx)**: Página de perfil del usuario, que incluye:
  - **[`comments`](./app/profile/comments/page.jsx)**: Sección de comentarios.
  - **[`likes`](./app/profile/likes/page.jsx)**: Sección de publicaciones con "me gusta".
- **[`/search`](./app/search/page.jsx)**: Página para buscar usuarios o publicaciones.

---

### Componentes

Los componentes principales se encuentran organizados dentro de la carpeta `app/ui` y `app/profile_ui`. Aquí están los más relevantes:

#### UI General

- **[`post-list.jsx`](./app/ui/home_ui/post-list.jsx)**: Renderiza una lista de publicaciones.
- **[`post.jsx`](./app/ui/home_ui/post.jsx)**: Representa una publicación individual.

#### Perfil del usuario

- **[`nav-bar.jsx`](./app/ui/profile_ui/nav-bar.jsx)**: Barra de navegación del perfil del usuario.
- **[`nav-link.jsx`](./app/ui/profile_ui/nav-link.jsx)**: Componente de enlace dentro de la barra de navegación del perfil.

---

## Instalación y configuración

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/tu_usuario/social-app.git
   cd social-app
   ```

2. **Instalar dependencias:**
   ```bash
   npm install
   ```

3. **Ejecutar el proyecto:**
   ```bash
   npm run dev
   ```

4. **Abrir en el navegador:**
   Visita `http://localhost:3000` para ver la aplicación en funcionamiento.

---

## Funcionalidades principales

- **Feed de publicaciones:** Muestra las publicaciones más recientes.
- **Perfil de usuario:** Visualiza los comentarios realizados y las publicaciones que recibieron "me gusta".
- **Interacción social:** Permite realizar acciones como dar "me gusta" y comentar publicaciones.
- **Búsqueda:** Facilita encontrar usuarios o publicaciones específicas.

---

## Estilo y diseño

Este proyecto utiliza **Tailwind CSS** para un diseño moderno y responsive, asegurando una experiencia de usuario fluida en diferentes dispositivos.

---

¡Explora la aplicación y aprende más sobre cómo se construyen aplicaciones sociales modernas con estas tecnologías!

