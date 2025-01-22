import Image from "next/image";
import { HeartIcon, ChatBubbleLeftIcon } from "@heroicons/react/24/outline";
import Link from "next/link";
export default () => {
  return (
    <div className=" flex flex-col gap-1 max-w-sm">
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
        <Image src="/astronauta.jpg" alt="post" width={384} height={384} />
      </div>
      <div>
        <div className="flex gap-2">
          <HeartIcon className="h-6 w-6" />
          <ChatBubbleLeftIcon className="h-6 w-6" />
        </div>
        <span>1234 Me gusta</span>
      </div>
      <div>
        <p>
          <span className="font-bold">Andreu</span> Lorem ipsum dolor, sit amet
          consectetur
        </p>
      </div>
      <div>
        <Link href="#">Ver los 33 comentarios</Link>
      </div>
      <div>
        <input className="w-full dark:bg-neutral-950 outline-0" type="text" placeholder="Add coment" />
      </div>
    </div>
  );
};
