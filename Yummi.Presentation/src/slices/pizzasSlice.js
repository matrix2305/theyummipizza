import {createSlice} from "@reduxjs/toolkit";

export const pizzaSlice = createSlice({
    name: 'pizzas',
    initialState: [],
    reducers: {
        setPizzas: (state,action) => {
            state = action.payload
        }
    }
})

export const {setPizzas} = pizzaSlice.actions;

export const selectPizzas = state => state.pizzas;

export default pizzaSlice.reducer;