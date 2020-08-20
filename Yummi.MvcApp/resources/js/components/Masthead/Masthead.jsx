import React, {useState, useEffect} from "react";
import './Masthead.css';


function Masthead(){
    const [title, setTitle] = useState({text: ''})

    useEffect(() => {
        let render = 'Best pizza in your city!'.split('');
        let int = setInterval(() => {
            if (render.length>0){
                setTitle({...title, text: title.text+=render.shift()})
            }else {
                clearInterval(int)
            }
        }, 150)
    }, [])


    return(
        <div className='masthead'>
            <div className='row'>
                <div className='front-text'>
                    {title.text}
                </div>
            </div>
        </div>
    )
}

export default Masthead;
