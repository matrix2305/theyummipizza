import React from "react";
import ReactDOM from 'react-dom';
import './App.css';
import {Provider} from "react-redux";
import store from '../store/store';
import {BrowserRouter, Route} from "react-router-dom";
import 'bootstrap/dist/css/bootstrap.min.css';



function App() {
    return(
        <BrowserRouter>
            <Route path='/' exact>
                <h1>This is a backend.</h1>
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
