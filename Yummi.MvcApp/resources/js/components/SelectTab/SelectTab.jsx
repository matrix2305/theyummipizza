import React from "react";
import './SelectTab.css';

function SelectTab() {
    return(
        <div className='container-fluid scale-select-tab'>
            <div className='row'>
                <div className='col-12 text-center text-s-tab'>
                    <p className='mb-0'>Select your pizza! :)</p>
                    <a href='#products'><i className="fas fa-angle-down"></i></a>
                </div>
            </div>
        </div>
    )
}

export default SelectTab;
