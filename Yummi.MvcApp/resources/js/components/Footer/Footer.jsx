import React from "react";
import './Footer.css';

function Footer() {
    return(
        <div className='container-fluid'>
            <div className='row'>
                <div className='col-10 offset-1 bg-light text-center footer mb-5 shadow'>
                    <div className='row p-3'>
                        <div className='col-4'>
                            <h3 className='font-weight-bold text-uppercase'>The Yummi Piza</h3>
                            <p></p>
                        </div>
                        <div className='col-4'>
                            <h3 className='font-weight-bold text-uppercase'>Contact info</h3>
                            <p></p>
                        </div>
                        <div className='col-4'>
                            <h3 className='font-weight-bold text-uppercase'>Contact us</h3>
                            <p></p>
                        </div>
                    </div>
                    <p>Copyrights &copy; All rights reserved by <a href='https://matrix2305.github.io/'>Srdjan Radosavljevic</a>.</p>
                </div>
            </div>
        </div>
    )
}

export default Footer;
