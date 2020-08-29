import React from "react";
import './App.css';
import {BrowserRouter, Route} from "react-router-dom";
import NavBar from "./NavBar/NavBar";
import 'bootstrap/dist/css/bootstrap.min.css';
import Masthead from "./Masthead/Masthead";
import Footer from "./Footer/Footer";
import Login from "./Login/Login";
import Register from "./Register/Register";



function App() {
    return(
        <BrowserRouter>
            <Route path='/' exact>
                <NavBar/>
                <Masthead/>
                <div className='container-fluid'>
                    <div className='row mt-5'>
                        <Footer/>
                    </div>
                </div>
            </Route>
            <Route path='/login' exact>
                <NavBar/>
                <Login/>
            </Route>
            <Route path='/register' exact>
                <NavBar/>
                <Register/>
            </Route>
        </BrowserRouter>
    )
}

export default App;