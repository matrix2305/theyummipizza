import {createSlice} from "@reduxjs/toolkit";

export const drinksSlice = createSlice({
    name: 'drinks',
    initialState: [],
    reducers: {
        setDrinks: (state, action) => {
            state = action.payload
        }
    }
})

export const {setDrinks} = drinksSlice.actions;

export const selectSlice = state => state.drinks;

export default drinksSlice.reducer;