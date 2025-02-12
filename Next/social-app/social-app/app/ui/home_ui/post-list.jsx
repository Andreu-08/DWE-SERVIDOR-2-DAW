
import { getPosts, getLikes } from "@/app/lib/data.js";
import Post from "./post.jsx";
import { auth0 } from "@/app/lib/auth0.js";

export default async function PostList() {
  const posts = await getPosts();
  const { user_id } = (await auth0.getSession()).user;
  const likes = await getLikes(user_id);

  return (
    <section className="flex flex-col items-center gap-8 mx-auto my-8">
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
          num_comments={post.num_comments}
          isLikedInitial={likes.some(like => like.post_id === post.post_id)}
        />
      ))}
    </section>
  );
}
