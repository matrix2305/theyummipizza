import React from "react";
import ReactDOM from 'react-dom';
import './App.css';
import {Provider} from "react-redux";
import store from '../store/store';
import {BrowserRouter, Route} from "react-router-dom";
import NavBar from "./NavBar/NavBar";
import 'bootstrap/dist/css/bootstrap.min.css';
import Musthead from "./Masthead/Masthead";
import Footer from "./Footer/Footer";
import Login from "./Login/Login";



function App() {
    return(
        <BrowserRouter>
            <Route path='/' exact>
                <NavBar/>
                <Musthead/>
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
        </BrowserRouter>
    )
}

if (document.getElementById('app')){
    ReactDOM.render(
        <Provider store={store}>
        <App/>
        </Provider>
        , document.getElementById('app') );
}
