import "../globals.css";
import SideNav from "../ui/SideNav";

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="en">
      <body className="flex">
        {/* Sidebar */}
        <SideNav />
        {/* Main Content */}
        <main className="flex-1 p-8 bg-gray-100">{children}</main>
      </body>
    </html>
  );
}

