import { db } from '@vercel/postgres';


const client = await db.connect();

export async function GET(){

    await client.sql`BEGIN`

    //CREAR TABLA a6_users
    await client.sql`CREATE TABLE a6_users(name text)`

    //introducir valores en la tabla
    await client.sql`INSERT INTO a6_users(name) VALUES('gerard'),('inaki'),('andreu')`

    await client.sql`COMMIT`

    return Response.json({message: 'SEED OK'});
}