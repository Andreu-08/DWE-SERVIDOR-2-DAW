import { db } from '@vercel/postgres'

const client = await db.connect();


//default se utiliza para exportar una sola cosa
export async function listUsers() {
    
    const users = await client.sql`SELECT * FROM a6_users`;
    
    return  users.rows
}