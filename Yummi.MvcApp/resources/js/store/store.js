import { configureStore } from '@reduxjs/toolkit';
import userReducer from '../slices/userSlice';
import contentReducer from '../slices/contentSlice';
import drinksReducer from '../slices/drinksSlice';
import ordersReducer from '../slices/ordersSlice';
import usersReducer from '../slices/usersSlice';
import pizzasReducer from '../slices/pizzasSlice';
import saladsReducer from '../slices/saladsSlice';

export default configureStore({
    reducer: {
        user: userReducer,
        users: usersReducer,
        content: contentReducer,
        orders: ordersReducer,
        salads: saladsReducer,
        pizzas: pizzasReducer,
        drinks: drinksReducer,
    }
})
