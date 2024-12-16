import { db } from '@vercel/postgres'

const client = await db.connect();

export default async function Page() {

  const users = await client.sql`SELECT * FROM a6_users`

  return (
    <>
      <h1>Estos son los Customers</h1>
      {
        users.rows.map((user) => (
          <p key={user.name}>{user.name}</p>
        ))
      }
    </>
  )
}