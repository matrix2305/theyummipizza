import React, {useEffect, useState} from "react";
import {useHistory} from 'react-router-dom';
import cookies from 'react-cookies';
import logo from '../../../images/yummilogo.png';
import axios from 'axios';
import FlashMessage from "../../services/FlashMessage/FlashMessage";
import {setUser} from '../../slices/userSlice';
import {useDispatch} from "react-redux";
import './Login.css';

function Login() {
    const [login, setLogin] = useState({username: '' , password: ''});
    const [flashMsg, setFlashMsg] = useState({message: '', status: null})
    const dispatch = useDispatch()
    const history = useHistory()

    useEffect(() => {
            axios.post('/api/auth/refresh')
                .then(response => {
                    if (response.data.user.userType === 2){
                        setFlashMsg({message: "You don't have permission for login to administrator panel!", status: false})
                        return;
                    }
                    cookies.save('token', response.data.access_token, {path: '/'})
                    dispatch(setUser(response.data.user))
                    history.push('/panel')
            }).catch(response => {
                console.log('Unauthorized')
            })
    }, [])

    const Login = e => {
        e.preventDefault();
        axios.post('/api/auth/login', login)
            .then(response => {
                if(response.data.status){
                    if (response.data.user.userType === 2){
                        setFlashMsg({message: "You don't have permission for login to administrator panel!", status: false})
                        return;
                    }
                    cookies.save('token', response.data.token, {path: '/'});
                    dispatch(setUser(response.data.user))
                    history.push('/panel');
                }else {
                    setFlashMsg({message: response.data.message, status: response.data.status});
                }
            })
            .catch(response => {
                console.log(response)
            })
    }

    return(
        <div className='container-fluid'>
            <div className='row'>
                <div className='col-4 offset-4 bg-light shadow p-3 mt-5'>
                    <div className='row'>
                        <div className='col-8 offset-2 text-center'>
                            <img src={logo} alt='Logo The Yummi Pizza' className='logo-image'/>
                            <h2 className='text-uppercase pt-3 text-title' >Sign in on panel</h2>
                        </div>
                    </div>
                    <FlashMessage message={flashMsg} duration={5000}/>
                    <form onSubmit={event => Login(event)} className='form-group text-left'>
                        <label>Username or email: </label>
                        <input type='text' className='form-control' onChange={event => setLogin({...login, username: event.target.value})} value={login.username} required/>
                        <label>Password: </label>
                        <input type='password' className='form-control' onChange={event => setLogin({...login, password: event.target.value})} value={login.password} required/>
                        <div className='row'>
                            <div className='col-12 text-center'>
                                <button className='btn btn-red mt-3'>Sign in</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    )
}

export default Login;
