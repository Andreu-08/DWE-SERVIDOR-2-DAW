"use client";

import NavLink from "./nav-link";
import { HomeIcon, MagnifyingGlassIcon, PlusCircleIcon, UserIcon, ArrowLeftOnRectangleIcon } from "@heroicons/react/24/outline";

export default ({ userName }) => {
  return (
    <nav className="flex flex-col gap-3 sticky top-0 h-dvh border-e p-6">
      <p className="hidden sm:block text-2xl font-bold text-center mb-6 font-sans tracking-tight text-slate-500">Social App</p>
      <NavLink ruta="/" texto="Home" Icon={HomeIcon} />
      <NavLink ruta="/search" texto="Search" Icon={MagnifyingGlassIcon} />
      <NavLink ruta="/create" texto="Create" Icon={PlusCircleIcon} />
      <NavLink ruta="/profile" texto={userName} Icon={UserIcon} />
      <div className="flex-grow" />
      <a
        href="/auth/logout"
        className="flex gap-2 items-center py-2 ps-2 pe-4 text-slate-600 hover:font-bold rounded transition-all"
      >
        <ArrowLeftOnRectangleIcon className="w-6" />
        <span className="hidden sm:block">Logout</span>
      </a>
    </nav>
  );
};
