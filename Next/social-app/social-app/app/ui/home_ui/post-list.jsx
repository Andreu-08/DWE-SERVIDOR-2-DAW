import { getPost } from "@/app/lib/data.jsx";
import Post from "./post.jsx";

export default async function PostList() {

  //obtener los datos
  const posts = await getPost();

  return (
    <div className="flex flex-col grow gap-16 mt-16 items-center">
      {posts.map( post => (
        <Post key={post.id} content={post.content} url={post.url}/>
      ))}
    </div>
  );
}
