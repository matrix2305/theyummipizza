import {createSlice} from "@reduxjs/toolkit";

export const ordersSlice = createSlice({
   name: 'orders',
   initialState: {},
   reducers: {
       setOrders: (state, action) => {
           state = action.payload;
       }
   }
});

export const {setOrders} = ordersSlice.actions;

export const selectOrders = state => state.orders;

export default ordersSlice.reducer;
