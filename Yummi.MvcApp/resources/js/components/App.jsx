import React, {useEffect, useState} from "react";
import ReactDOM from 'react-dom';
import './App.css';
import {Provider, useSelector} from "react-redux";
import store from '../store/store';
import {BrowserRouter, Route} from "react-router-dom";
import 'bootstrap/dist/css/bootstrap.min.css';
import Login from "./Login/Login";
import Header from "./Header/Header";
import AddPizza from "./AddPizza/AddPizza";
import AddDrink from "./AddDrink/AddDrink";


function App() {
    const [admin, setAdmin] = useState(false);
    const [moderator, setModerator] = useState(false);
    const user = useSelector(state => state.user.user);

    useEffect(() => {
        if (user.userType === 1){
            setModerator(true)
        }else if (user.userType === 0){
            setAdmin(true)
        }
    })


    return(
        <BrowserRouter>
            <Route path='/' exact>
                <Login/>
            </Route>
            <Route path='/panel'>
                <Header admin={admin} moderator={moderator}/>
            </Route>
            <Route path='/panel/addpizza' exact>
                <AddPizza/>
            </Route>
            <Route path='/panel/adddrink' exact>
                <AddDrink/>
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
