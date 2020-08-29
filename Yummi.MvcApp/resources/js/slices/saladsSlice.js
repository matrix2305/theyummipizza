import {createSlice} from "@reduxjs/toolkit";

export const saladsSlice = createSlice({
   name: 'salads',
   initialState: [],
   reducers: {
       setSalads : (state, action) => {
            state = action.payload;
       }
   }
});

export const {setSalads} = saladsSlice.actions;

export const selectSalads = state => state.salads;

export default saladsSlice.reducer;
