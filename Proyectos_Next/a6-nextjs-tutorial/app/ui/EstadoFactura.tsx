import { CheckIcon, ClockIcon } from "@heroicons/react/24/outline";
import clsx from "clsx";


export default function EstadoFactura({estado}){

    return(
        <span className={clsx(
            "inline-flex items-center rounded px-2 py-1",
            {
                "text-gray-500 bg-gray-300": estado ==="pendiente",
                "text-white bg-green-500": estado ==="pagada"
            }
            
        )}
        >
            {estado === "pagada" ? ( 
            <>
            Pagada 
            <CheckIcon className="ml-1 w-4 text-white"/>
            </>)
            : null}

            {estado === "pendiente" ? ( 
            <>
            Pendiente
            <ClockIcon className="ml-1 w-4 text-black"/>
            </>) 
            : null} 
        </span>
    );
}
    
    