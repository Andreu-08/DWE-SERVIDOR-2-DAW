import { listUsers } from "../lib/data";

export async function GET(){

    const users = await listUsers();

    return Response.json(users);
}