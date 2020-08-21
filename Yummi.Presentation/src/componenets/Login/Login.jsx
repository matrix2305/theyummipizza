import React, {useState} from "react";
import axios from 'axios';

function Login() {
    const [login, setLogin] = useState({username : '' , password: ''});

    const Login = e => {
        e.preventDefault();
        axios.post('/api/auth/login', login)
            .then(response => {
                console.log(response.data)
            })
            .catch(response => {
                console.log(response)
            })
    }

    return (
        <div className='container-fluid bg-light full-height'>
            <div className='row'>
                <div className='col-4 offset-4 text-center mt-5 p-5'>
                    <h1 className='text-uppercase'>Sign in</h1>
                    <form onSubmit={event => Login(event)}>
                        <label>Username or email: </label>
                        <input type='text' className='form-control' onChange={event => setLogin({...login, username: event.target.value})} value={login.username} required/>
                        <label>Password: </label>
                        <input type='password' className='form-control' onChange={event => setLogin({...login, password: event.target.value})} value={login.password} required/>
                        <button className='btn btn-red mt-3'>Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    )
}

export default Login;
