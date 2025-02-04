import { getPost } from "@/app/lib/data.jsx";
import Post from "./post.jsx";
import { auth0 } from "@/app/lib/auth0.jsx";
import { getLikes } from "@/app/lib/data.jsx";

export default async function PostList() {

  // obtener los datos
  const { user_id } = (await auth0.getSession()).user;

  //TODO : Lanzar las dos consultas a la vez
  const posts = await getPost();
  const likes = await getLikes(user_id);
  

  return (
    <div className="flex flex-col grow gap-16 mt-16 items-center">
      {posts.map((post) => (
        // Se reemplaza user_id del post por el user_id de la sesión.
        <Post
          key={post.post_id}
          user_id={user_id}
          isLikedInitial={likes.find((like) => like.post_id === post.post_id)}
          post_id={post.post_id}
          content={post.content}
          url={post.url}
        />
      ))}
    </div>
  );
}
