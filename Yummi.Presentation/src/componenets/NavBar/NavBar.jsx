import React from "react";
import {NavLink, Link} from "react-router-dom";
import logo from '../../images/yummilogo.png';
import './NavBar.css';

function NavBar(){
    return(
        <nav className='navbar navbar-expand-lg navbar-light bg-nav sticky-top pr-5 pl-5'>
            <Link className='navbar-brand' to='/' exact><img src={logo} alt='logo' width='150px'/></Link>
            <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span className="navbar-toggler-icon"></span>
            </button>
            <div className='collapse navbar-collapse'>
                <ul className='nav navbar-nav ml-auto'>
                    <li className='nav-item'>
                        <NavLink activeClassName='nav-active text-white' className='nav-link t-b' to='/' exact>Home</NavLink>
                    </li>
                    <li className='nav-item'>
                        <NavLink activeClassName='nav-active text-white' className='nav-link t-b' to='/products' exact>Menu of products</NavLink>
                    </li>
                    <li className='nav-item'>
                        <NavLink activeClassName='nav-active text-white' className='nav-link t-b' to='/aboutus' exact>About Us</NavLink>
                    </li>
                    <li className='nav-item'>
                        <NavLink activeClassName='nav-active text-white' className='nav-link t-b' to='/login' exact>Login</NavLink>
                    </li>
                    <li className='nav-item'>
                        <NavLink activeClassName='nav-active text-white' className='nav-link t-b' to='/register' exact>Register</NavLink>
                    </li>
                </ul>
            </div>
        </nav>
    )
}

export default NavBar;
