import Image from "next/image";
import { ChatBubbleLeftIcon } from "@heroicons/react/24/outline";
import Link from "next/link";
import Like_Icon from "./like_button";


export default ({post_id, user_id, content, url, isLikedInitial}) => {
  return (
    <div className=" flex flex-col gap-1 max-w-md">
      <div className="flex gap-2">
        <Image
          src="/avatar.png"
          alt="avatar"
          width={24}
          height={24}
          className="rounded-full"
        />
        <span>Andreu</span>
        <span>1 dia</span>
      </div>
      <div>
        <Image src={url} alt="post" width={448} height={448} />
      </div>
      <div>
        <div className="flex gap-2">
          <Like_Icon post_id={post_id} user_id={user_id} isLikedInitial={isLikedInitial} />
          <ChatBubbleLeftIcon className="h-6 w-6" />
        </div>
        <span>1234 Me gusta</span>
      </div>
      <div>
        <p>
          <span className="font-bold">Andreu</span> {content}
        </p>
      </div>
      <div>
        <Link href="#">Ver los 33 comentarios</Link>
      </div>
      <div>
        <input className="w-full dark:bg-neutral-950 outline-0" type="text" placeholder="Add coment..." />
      </div>
    </div>
  );
};
