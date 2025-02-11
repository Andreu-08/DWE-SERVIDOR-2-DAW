import { getPosts, getLikes } from "@/app/lib/data.js";
import Post from "./post.jsx";
import { auth0 } from "@/app/lib/auth0.js";

export default async function PostList() {

  // obtener los datos de posts y los likes del usuario
  const posts = await getPosts();
  const { user_id } = (await auth0.getSession()).user;
  const likes = await getLikes(user_id);

  return (
    <div className="flex flex-col grow gap-16 mt-16 items-center">
      {posts.map(post => (
        <Post 
          key={post.post_id} 
          user_id={user_id} 
          post_id={post.post_id} 
          content={post.content} 
          url={post.url}
          username={post.username}
          picture={post.picture}
          num_likes={post.num_likes}
          num_comments={post.num_comments}  // se añade el prop num_comments
          isLikedInitial={likes.some(like => like.post_id === post.post_id)}
        />
      ))}
    </div>
  );
}
