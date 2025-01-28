import { ArrowRightOnRectangleIcon, UserGroupIcon } from "@heroicons/react/24/outline";

export default function LoginPage() {
  return (
    <div className="flex flex-col items-center justify-center min-h-screen w-full bg-slate-50">
      <div className="p-8 bg-white rounded-lg shadow-lg w-full max-w-md">
        <div className="flex justify-center mb-6">
          <UserGroupIcon className="w-20 h-20 text-slate-700" />
        </div>
        <h1 className="text-2xl font-bold text-center mb-4 text-slate-800 tracking-tight">
          Welcome to Social App
        </h1>
        <p className="text-center text-slate-600 mb-8">
          Conéctate y comparte con el mundo
        </p>
        <a
          href="/auth/login"
          className="flex items-center justify-center gap-2 w-full bg-slate-800 text-white py-3 px-4 rounded-lg hover:bg-slate-700 transition-colors font-medium"
        >
          <span>Iniciar Sesión</span>
          <ArrowRightOnRectangleIcon className="w-5 h-5" />
        </a>
      </div>
    </div>
  );
}
