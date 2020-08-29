import React, {useState, useEffect} from "react";
import './Masthead.css';


function Masthead(){
    const [title, setTitle] = useState({text: ''})

    useEffect(() => {
        let render = 'Best pizza in your city!'.split('');
        let int = setInterval(() => {
            if (render.length>0){
                setTitle({text: title.text+=render.shift()})
            }else {
                clearInterval(int)
            }
        }, 150)
    }, [])


    return(
        <div className='masthead'>
            <div className='row'>
                <div className='col-4 offset-4 text-center text-white mt-200'>
                    <div className='front-text'>
                        {title.text}
                    </div>
                </div>
            </div>
            <div className='row p-0 m-0'>
                <div className='col-12 text-center text-select-tab text-uppercase pt-3 pb-3 bg-light'>
                    <p className='mb-0'>Select your pizza! :)</p>
                    <a href='#products'><i className="fas fa-angle-down"></i></a>
                </div>
            </div>
        </div>
    )
}

export default Masthead;
