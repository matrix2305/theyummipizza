import {createSlice} from "@reduxjs/toolkit";

export const contentSlice = createSlice({
    name: 'content',
    initialState: {},
    reducers: {
        setContent: (state, action) => {
            state = action.payload;
        }
    }
})

export const {setContent} = contentSlice.actions;

export const selectContent = state => state.content;

export default contentSlice.reducer;
