"use server";

import { put } from "@vercel/blob";
import { sql } from "@vercel/postgres";
import { redirect } from "next/navigation";
import { revalidatePath } from "next/cache";
import { auth0 } from "./auth0";

//accion para el formulario de crear post
export async function createPost(formData) {

  const user_id = (await auth0.getSession()).user.user_id
  //guardar la imagen en el bucket
  const { url } = await put("media", formData.get("media"), {
    access: "public",
  });

  //variables del contenido
  const content = formData.get("content");
  //guardar el post en la base de datos
  await sql`INSERT INTO sa_posts(content, url, user_id) 

    VALUES(
      ${content}, 
      ${url},
      ${user_id}
      )`

  redirect('/');
}

export async function insertLike(post_id, user_id) {
  //guardar el like en la base de datos
  sql`INSERT INTO sa_likes(post_id, user_id) 
  
  VALUES (
    ${post_id},
    ${user_id} 
    ) `;
}

export async function removeLike(post_id, user_id) {
  //guardar el like en la base de datos
  sql`DELETE FROM sa_likes 
    WHERE post_id = ${post_id} AND user_id = ${user_id}`;
}

//funcion para añadir comentarios
export async function addComment(formData) {
  
  const { user } = await auth0.getSession();
  const content = formData.get("content");
  const post_id = formData.get("post_id");
  const parent_comment_id = formData.get("parent_comment_id") || null;
  
  await sql`INSERT INTO sa_comments(content, user_id, post_id, parent_comment_id)
    VALUES(${content}, ${user.user_id}, ${post_id}, ${parent_comment_id})`;

  // Revalida la ruta para que se refleje el nuevo número de comentarios
  revalidatePath(`/post/${post_id}`);
}
