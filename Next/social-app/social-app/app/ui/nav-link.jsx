"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import clsx from "clsx";

export default function NavLink({ ruta, texto, Icon }) {
  const path = usePathname();

  return (
    <Link
      href={ruta}
      className={clsx("flex gap-2 hover:bg-slate-500 py-2 ps-2 pe-4 rounded w-full items-center subpixel-antialiased", {
        "font-bold pointer-events-none" : path === ruta,
      })}
    >
      <Icon className="w-6 min-w-6" />
      <span className="hidden sm:block w-16">{texto}</span>
    </Link>
  );
}
