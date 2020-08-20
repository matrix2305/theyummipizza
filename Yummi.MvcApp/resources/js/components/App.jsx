import React from "react";
import ReactDOM from 'react-dom';
import './App.css';
import {Provider} from "react-redux";
import store from '../store/store';
import {BrowserRouter, Route} from "react-router-dom";
import NavBar from "./NavBar/NavBar";
import 'bootstrap/dist/css/bootstrap.min.css';
import Musthead from "./Masthead/Masthead";
import SelectTab from "./SelectTab/SelectTab";
import Footer from "./Footer/Footer";



function App() {
    return(
        <BrowserRouter>
            <Route to='/' exact>
                <NavBar/>
                <Musthead/>
                <SelectTab/>
                <Footer/>
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
