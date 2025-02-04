import { sql } from "@vercel/postgres";


//funciones para manejar los datos en los componentes
export async function getPost(){

    return (await sql`SELECT * FROM sa_posts`).rows

}

export async function getLikes(user_id){

    return (await sql`SELECT post_id FROM sa_likes WHERE user_id = ${user_id}`).rows
}