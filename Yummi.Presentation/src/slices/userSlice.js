import {createSlice} from "@reduxjs/toolkit";

export const userSlice = createSlice({
    name: 'user',
    initialState: null,
    reducers: {
        setUser: (state, action) => {
            state = action.payload
        },
        unsetUser : (state) => {
            state = null;
        }
    }
})

export const {setUser, unsetUser} = userSlice.actions;

export const selectUser = state => state.user;

export default userSlice.reducer;