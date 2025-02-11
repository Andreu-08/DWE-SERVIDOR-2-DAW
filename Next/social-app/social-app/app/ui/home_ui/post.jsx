import Image from "next/image";
import { ChatBubbleLeftIcon } from "@heroicons/react/24/outline";
import Link from "next/link";
import Like_Icon from "./like_button";
import { addComment } from "../../lib/action";

export default ({
    post_id, 
    user_id, 
    content, 
    url, 
    username,
    picture,
    isLikedInitial,
    num_likes,
    num_comments       
  }) => {

  return (
    <div className=" flex flex-col gap-1 max-w-md">
      <div className="flex gap-2">
        <Image
          src={picture}
          alt="avatar"
          width={24}
          height={24}
          className="rounded-full"
        />
        <span>{username}</span>
        <span>1 dia</span>
      </div>
      <div>
        <Link href={`/post/${post_id}`}>
        <Image src={url} alt="post" width={448} height={448} />
        </Link>
      </div>
      <div>
        <div className="flex gap-2">
          <Like_Icon post_id={post_id} user_id={user_id} isLikedInitial={isLikedInitial} />
          <ChatBubbleLeftIcon className="h-6 w-6" />
        </div>
        <span>{num_likes} Me gusta</span>
      </div>
      <div>
        <p>
          <span className="font-bold">Andreu</span> {content}
        </p>
      </div>
      <div>
        <Link href={`/post/${post_id}`}>Ver los {num_comments} comentarios</Link>
      </div>
      <div>
        <form action={addComment} method="post" className="flex gap-2">
          <input type="hidden" name="post_id" value={post_id} />
          <input name="content" className="w-full dark:bg-neutral-950 outline-0" type="text" placeholder="Add coment..." />
          <button type="submit">Enviar</button>
        </form>
      </div>
    </div>
  );
};
