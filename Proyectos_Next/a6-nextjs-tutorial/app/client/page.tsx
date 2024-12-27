'use client'//el codigo lo ejecuta el cliente
import { useState, useEffect } from "react"


export default  function Page() {

    const [users, setUsers] = useState([])

    useEffect( () => {

        async function fetchUsers(){

        const data= await fetch('http://localhost:3000/api')
        const usersData = await data.json()
        setUsers(usersData)
        }

        fetchUsers()
    } , []);

    

     return (<>
    {
        users.map((user)=>{
            return <p key={user.name}>{user.name}</p>
        })
    }
  </>)
}
