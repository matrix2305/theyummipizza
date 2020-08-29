import {createSlice} from "@reduxjs/toolkit";

export const pizzasSlice = createSlice({
   name: 'pizzas',
   initialState: [],
   reducers: {
       setPizzas: (state, action) => {
           state = action.payload;
       }
   }
});

export const {setPizzas} = pizzasSlice.actions;

export const selectPizzas = state => state.pizzas;

export default pizzasSlice.reducer;
