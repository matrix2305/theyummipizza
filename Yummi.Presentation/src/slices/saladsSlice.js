import {createSlice} from "@reduxjs/toolkit";

export const saladsSlice = createSlice({
    name: 'salads',
    initialState: [],
    reducers: {
        setSalads: (slice, action) => {
            slice = action.payload
        }
    }
})

export const {setSalads} = saladsSlice.actions;

export const selectSalads = state => state.salads;

export default saladsSlice.reducer;