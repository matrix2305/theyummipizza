import {createSlice} from "@reduxjs/toolkit";

export const ordersSlice = createSlice({
    name: 'Orders',
    initialState: {
        pizzas: [],
        salads: [],
        drinks: []
    },
    reducers : {
        setPizzaOrder: (state, action) => {
            state.pizzas = [...state.pizzas, action.payload]
        },
        setSaladOrder: (state, action) => {
            state.salads = [...state.salads, action.payload]
        },
        setDrinkOrder: (state, action) => {
            state.drinks = [...state.drinks, action.payload]
        },
        unsetPizzaOrder : (state, action) => {
            // eslint-disable-next-line eqeqeq
            state.pizzas = state.pizzas.filter(pizza => pizza.id!==action.payload)
        },
        unsetSaladOrder : (state, action) => {
            // eslint-disable-next-line eqeqeq
            state.salads = state.salads.filter(salad => salad.id!==action.payload)
        },
        unsetDrinkOrder : (state, action) => {
            state.drinks = state.drinks.filter(drink => drink.id!==action.payload)
        },
        unsetAllOrders : (state) => {
            state = {
                pizzas: [],
                salads: [],
                drinks: []
            }
        }
    }
})


export const {setPizzaOrder, setSaladOrder, setDrinkOrder, unsetPizzaOrder, unsetSaladOrder, unsetDrinkOrder, unsetAllOrders} = ordersSlice.actions;

export const selectOrders = state => state.orders;

export default ordersSlice.reducer;