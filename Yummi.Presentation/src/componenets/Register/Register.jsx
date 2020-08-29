import React, {useState} from "react";
import './Register.css';

function Register() {
    const [register, setRegister] = useState({
        username: '',
        email: '',
        name: '',
        lastName: '',
        phone: '',
        street: '',
        numberInStreet: '',
        town: 'Munich',
        password: '',
        password_confirmation: ''
    })

    const setValue = e => {
        let id = e.target.id
        let value = e.target.value
        setRegister({...register, [id]: value})
    }

    const Register = e => {
        e.preventDefault()
        console.log(register)
    }

    return(
        <div className='container-fluid bg-light full-height'>
            <div className='row'>
                <div className='col-4 offset-4 text-center mt-5 p-5'>
                    <h1 className='text-uppercase'>Sign up</h1>
                    <form onSubmit={event => Register(event)} className='text-left'>
                        <p>All fields are required*</p>
                        <label>Username: </label>
                        <input type='text' className='form-control' id='username' onChange={event => setValue(event)} value={register.username} required/>
                        <label>Email: </label>
                        <input type='email' className='form-control' id='email' onChange={event => setValue(event)} value={register.email} required/>
                        <label>Password: </label>
                        <input type='password' className='form-control' id='password' onChange={event => setValue(event)} value={register.password} required/>
                        <label>Confirm password: </label>
                        <input type='password' className='form-control' id='password_confirmation' onChange={event => setValue(event)} value={register.password_confirmation} required/>
                        <label>Name: </label>
                        <input type='text' className='form-control' id='name' onChange={event => setValue(event)} value={register.name} required/>
                        <label>Last Name: </label>
                        <input type='text' className='form-control' id='lastName' onChange={event => setValue(event)} value={register.lastName} required/>
                        <label>Phone: </label>
                        <input type='number' className='form-control' id='phone' onChange={event => setValue(event)} value={register.phone} required/>
                        <label>Street: </label>
                        <input type='text' className='form-control' id='street' onChange={event => setValue(event)} value={register.street} required/>
                        <div className='row'>
                            <div className='col-7'>
                                <label>Town: </label>
                                <input type='text' className='form-control' id='town' onChange={event => setValue(event)} value={register.town} disabled required/>
                            </div>
                            <div className='col-5'>
                                <label>Number in street: </label>
                                <input type='text' className='form-control' id='numberInStreet' onChange={event => setValue(event)} value={register.numberInStreet} required/>
                            </div>
                        </div>
                        <div className='row'>
                            <div className='col-12 text-center'>
                                <button className='btn btn-red mt-3'>Sign up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    )
}

export default Register;