import {sql} from '@vercel/postgres'

export default async () => {
    //consulta para hacer un fresh antes de crear las tablas
    await sql `DROP TABLE IF EXISTS sa_users, sa_posts, sa_likes`

    //Crear extensión para UUID si no existe
    await sql `CREATE EXTENSION IF NOT EXISTS "uuid-ossp"`

    //consulta que creara la tabla usuarios en la base de datos si no existe
    await sql `CREATE TABLE IF NOT EXISTS sa_users(
        user_id UUID DEFAULT uuid_generate_v4() PRIMARY KEY,
        username text,
        name text,
        picture text,
        email text UNIQUE
    )`

    //consulta que ejecutara al navegar a /seed
    await sql`CREATE TABLE IF NOT EXISTS sa_posts(
        post_id UUID DEFAULT uuid_generate_v4() PRIMARY KEY,
        content TEXT,
        url TEXT   
    )`

    //consulta para la tabla de los likes (foreign key)
    await sql`CREATE TABLE IF NOT EXISTS sa_likes(
        user_id UUID,
        post_id UUID
    )`

    //mensaje que devuelve la ruta
    return <p>Database seed the guay</p>
}
