'use client'
import { useRef } from "react";
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
  const commentInputRef = useRef(null);

  return (
    <div className="flex flex-col mx-auto w-full max-w-3xl">
      {/* Encabezado centrado */}
      <div className="flex gap-2 items-center">
        <Image src={picture} alt="avatar" width={24} height={24} className="rounded-full" />
        <span>{username}</span>
        <span>1 dia</span>
      </div>
      {/* Imagen centralizada */}
      <div className="my-2">
        <Link href={`/post/${post_id}`}>
          <Image src={url} alt="post" width={600} height={600} />
        </Link>
      </div>
      {/* Controles del post */}
      <div className="flex flex-col gap-2">
        <div className="flex gap-2 items-center">
          <Like_Icon post_id={post_id} user_id={user_id} isLikedInitial={isLikedInitial} />
          <ChatBubbleLeftIcon 
            className="h-6 w-6 cursor-pointer" 
            onClick={() => commentInputRef.current && commentInputRef.current.focus()}
          />
        </div>
        <span>{num_likes} Me gusta</span>
        <p>
          <span className="font-bold">{username}</span> {content}
        </p>
        <Link href={`/post/${post_id}`}>Ver los {num_comments} comentarios</Link>
      </div>
      {/* Formulario de comentario centrado con ancho igual a la imagen */}
      <div className="my-2">
        <form action={addComment} method="post" className="w-[600px] mx-auto flex items-center gap-2">
          <input type="hidden" name="post_id" value={post_id} />
          <input 
            name="content" 
            ref={commentInputRef}
            className="flex-1 min-w-0 dark:bg-neutral-950 outline-0" 
            type="text" 
            placeholder="Add coment..." 
          />
          <button type="submit" className="px-3 py-1 text-white">Enviar</button>
        </form>
      </div>
    </div>
  );
};
