import { configureStore } from '@reduxjs/toolkit';
import ordersReducer from '../slices/ordersSlice';
import drinksReducer from '../slices/drinksSlice';
import pizzasReducer from '../slices/pizzasSlice';
import saladsReducer from '../slices/saladsSlice';
import userReducer from '../slices/userSlice';

export default configureStore({
    reducer: {
        orders: ordersReducer,
        pizzas: pizzasReducer,
        salads: saladsReducer,
        drinks: drinksReducer,
        user: userReducer,
    }
})