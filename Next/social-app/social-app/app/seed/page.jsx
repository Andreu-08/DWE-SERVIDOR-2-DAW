import {sql} from '@vercel/postgres'

export default async () => {

    // Se eliminan las tablas respetando las dependencias
    await sql `DROP TABLE IF EXISTS sa_comments, sa_likes, sa_posts, sa_users CASCADE`

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
        url TEXT,
        user_id UUID REFERENCES sa_users(user_id)   
    )`

    //consulta para la tabla de los likes (foreign key)
    await sql`CREATE TABLE IF NOT EXISTS sa_likes(
        user_id UUID REFERENCES sa_users(user_id),
        post_id UUID REFERENCES sa_posts(post_id),
        PRIMARY KEY(user_id, post_id)
    )`

    //consulta para la tabla de comentarios mejorada
    await sql `CREATE TABLE IF NOT EXISTS sa_comments(
        comment_id UUID DEFAULT uuid_generate_v4() PRIMARY KEY,
        content TEXT NOT NULL,
        user_id UUID NOT NULL REFERENCES sa_users(user_id) ON DELETE CASCADE,
        post_id UUID NOT NULL REFERENCES sa_posts(post_id) ON DELETE CASCADE,
        parent_comment_id UUID REFERENCES sa_comments(comment_id) ON DELETE CASCADE
        
    )`

    //mensaje que devuelve la ruta
    return <p>Database seed the guay</p>
}
