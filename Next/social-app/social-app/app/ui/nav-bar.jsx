"use client";

import NavLink from "./nav-link";
import { HomeIcon, MagnifyingGlassIcon, PlusCircleIcon, UserIcon } from "@heroicons/react/24/outline";

export default () => {
  return (
    <nav className="flex flex-col gap-3 sticky top-0 h-dvh border-e p-6">
      <p className="hidden sm:block text-2xl font-bold text-center mb-6 font-sans tracking-tight text-slate-500">Social App</p>
      <NavLink ruta="/" texto="Home" Icon={HomeIcon} />
      <NavLink ruta="/search" texto="Search" Icon={MagnifyingGlassIcon} />
      <NavLink ruta="/create" texto="Create" Icon={PlusCircleIcon} />
      <NavLink ruta="/profile" texto="Profile" Icon={UserIcon} />
    </nav>
  );
};
