import { auth0 } from "@/app/lib/auth0";
import { getPost, getLike } from "@/app/lib/data";
import Post from "@/app/ui/home_ui/post";

export default async ({params}) => {

    const post_id = (await params).post_id
    const user_id = (await auth0.getSession()).user.user_id;

    const post = (await getPost(post_id))[0];
    const like = await getLike(user_id, post_id);

    return (
        <>
        <div className="flex flex-col items-center gap-8 mx-auto my-8">

            <Post 
                user_id = {user_id}
                post_id={post.post_id}
                content={post.content}
                url={post.url} 
                isLikedInitial={like.length > 0}
                picture={post.picture}
                username = {post.username}
                num_likes={post.num_likes}
                num_comments={post.num_comments} 
            />
        </div>
        </>
    )
}