'use client'

import { insertLike, removeLike } from "@/app/lib/action";
import { HeartIcon } from "@heroicons/react/24/outline";
import clsx from "clsx";
import { useState } from "react";


export default ({ post_id, user_id }) => {
    
    let [isLiked, setIsLiked ]= useState(false);
    
    function togleLike() {

        if(isLiked){
            removeLike(post_id, user_id)
            setIsLiked(false)
            
        }else{

            insertLike(post_id, user_id)
            setIsLiked(true)
        }
    }

  return (
    <HeartIcon
      onClick={togleLike}
      className={clsx("h-6 w-6", { "text-red-500": isLiked })}
    />
  );
};
