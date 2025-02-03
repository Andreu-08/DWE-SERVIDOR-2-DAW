import { Auth0Client } from "@auth0/nextjs-auth0/server"
import { sql } from "@vercel/postgres"
import { NextResponse } from "next/server" 


export const auth0 = new Auth0Client({

    async onCallback(error, context, session){

        if (error) {
            return NextResponse.redirect(
              new URL(`/error?error=${error.message}`, process.env.APP_BASE_URL)
            )
          }

        console.log(session)
        const {nickname, name, picture, email} = session.user
        try{

            await sql `INSERT INTO sa_users(username, name, picture, email) 
                VALUES(
                    ${nickname},
                    ${name},
                    ${picture},
                    ${email}
                )`
        }catch(e){
            console.log(e)
        }

     // complete the redirect to the provided returnTo URL
     return NextResponse.redirect(
        new URL(context.returnTo || "/", process.env.APP_BASE_URL)
      )
    }
})