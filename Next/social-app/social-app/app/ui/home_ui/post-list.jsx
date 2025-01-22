import Post from "./post.jsx";

export default function PostList() {
  return (
    <div className="flex flex-col grow gap-16 mt-16 items-center">
      <Post />
      <Post />
      <Post />
      <Post />
      <Post />
    </div>
  );
}
