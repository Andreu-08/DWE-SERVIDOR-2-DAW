import { getPost } from "@/app/lib/data.jsx";
import Post from "./post.jsx";
import { auth0 } from "@/app/lib/auth0.jsx";

export default async function PostList() {

  // obtener los datos
  const posts = await getPost();

  const { user_id } = (await auth0.getSession()).user;

  return (
    <div className="flex flex-col grow gap-16 mt-16 items-center">
      {posts.map(post => (
        // Se reemplaza user_id del post por el user_id de la sesión.
        <Post key={post.post_id} user_id={user_id} post_id={post.post_id} content={post.content} url={post.url}/>
      ))}
    </div>
  );
}
