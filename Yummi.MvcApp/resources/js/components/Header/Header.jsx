import React, {useEffect} from "react";
import {Link, useHistory} from 'react-router-dom';
import axios from 'axios';
import logo from '../../../images/yummilogo.png';
import cookies from 'react-cookies';
import {useSelector} from "react-redux";
import {NavLink} from "react-router-dom";
import './Header.css';


function Header({admin, moderator}) {
    const history = useHistory();
    const user = useSelector(state => state.user.user)

    useEffect(()=> {
        if (_.isEmpty(user)){
            history.push('/');
        }
    })


    const Logout = e => {
        e.preventDefault();
        axios.post('/api/auth/logout')
            .then(response => {
                cookies.remove('token');
                history.push('/');
            })
            .catch(response => {
                console.log('Unsuccessful logout.');
            })
    }
    return(
        <div className='navbar navbar-expand-lg bg-light shadow pr-5 pl-5'>
            <Link to='/panel'><img src={logo} width='200px' className='navbar-brand' alt='Logo of Yummi Pizza'/></Link>
            <div>
                {
                    admin && <div className='mt-2'>
                        <p>Welcome administrator, <b>{user.username}</b>.</p>
                    </div>
                }
                {
                    moderator && <div className='mt-2'>
                        <p>Welcome moderator, <b>{user.username}</b>.</p>
                    </div>
                }
            </div>
            <div className="collapse navbar-collapse" id="navbarSupportedContent">
                <ul className="navbar-nav ml-auto">
                    <li className="nav-item dropdown">
                        <a className="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Monitoring
                        </a>
                        <div className="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a className="dropdown-item" href="#">Action</a>
                            <a className="dropdown-item" href="#">Another action</a>
                            <div className="dropdown-divider"></div>
                            <a className="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li className="nav-item dropdown">
                        <a className="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pizzas
                        </a>
                        <div className="dropdown-menu" aria-labelledby="navbarDropdown">
                            <NavLink to='/panel/addpizza' activeClassName='active-item' className="dropdown-item">Add pizza</NavLink>
                            <a className="dropdown-item" href="#">Another action</a>
                            <div className="dropdown-divider"></div>
                            <a className="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li className="nav-item dropdown">
                        <a className="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Drinks
                        </a>
                        <div className="dropdown-menu" aria-labelledby="navbarDropdown">
                            <NavLink to='/panel/adddrink' activeClassName='active-item' className="dropdown-item">Add drink</NavLink>
                            <a className="dropdown-item" href="#">Another action</a>
                            <div className="dropdown-divider"></div>
                            <a className="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li className="nav-item dropdown">
                        <a className="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Salads
                        </a>
                        <div className="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a className="dropdown-item" href="#">Action</a>
                            <a className="dropdown-item" href="#">Another action</a>
                            <div className="dropdown-divider"></div>
                            <a className="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li className="nav-item dropdown">
                        <a className="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Users
                        </a>
                        <div className="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a className="dropdown-item" href="#">Action</a>
                            <a className="dropdown-item" href="#">Another action</a>
                            <div className="dropdown-divider"></div>
                            <a className="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li className="nav-item">
                        <a className="nav-link" href="/" onClick={event => Logout(event)}>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    )
}

export default Header;
