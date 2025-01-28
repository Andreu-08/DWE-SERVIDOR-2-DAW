import {sql} from '@vercel/postgres'


export default async () => {
    //consulta que ejecutara al navegar a /seed
    /*await sql`CREATE TABLE IF NOT EXIST POST(
        id UUID DEFAULT uuid_generate_v4() PRIMARY KEY,
        content TEXT,
        url TEXT   
    )`*/

    //mensaje que devuelve la ruta
    return <p>Database seed the guay</p>
}
