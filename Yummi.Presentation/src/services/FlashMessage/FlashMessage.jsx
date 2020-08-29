import React, {useEffect, useState} from "react";
import './FlashMessage.css';

function FlashMessage({message, duration = 5000}) {
    const [flashMsg, setFlashMsg] = useState({message: '', status: null})

    useEffect(() => {
        setFlashMsg({message: message.message, status: message.status})
        setTimeout(() => {
            setFlashMsg({message: '', status: null})
        }, duration)
    }, [message])

    return(
        <div className={flashMsg.status+'-flash-msg'}>
            <p>{flashMsg.message}</p>
        </div>
    )
}

export default FlashMessage;