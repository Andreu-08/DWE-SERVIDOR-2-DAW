import { Geist, Geist_Mono } from "next/font/google";
import "./globals.css";
import Navbar from "@/app/ui/nav-bar.jsx";
import { auth0 } from "./lib/auth0";
import LoginPage from "@/app/ui/login-page";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
});

export const metadata = {
  title: "Create Next App",
  description: "Generated by create next app",
};

export default async function RootLayout({ children }) {

  const session = await auth0.getSession();
  
  if(!session){

    return (
      <html lang="en">
        <body
          className={`${geistSans.variable} ${geistMono.variable} antialiased`}
        >
          <LoginPage />
        </body>
      </html>
    )
  }

  return (
    <html lang="en">
      <body
        className={`${geistSans.variable} ${geistMono.variable} antialiased flex`}
      >
        <Navbar userName={session.user.name} />
        {children}
      </body>
    </html>
  );
}
