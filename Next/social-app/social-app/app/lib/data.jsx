import { sql } from "@vercel/postgres";


//funciones para manejar los datos en los componentes
export async function getPost(){

    return (await sql`SELECT * FROM sa_posts`).rows

}