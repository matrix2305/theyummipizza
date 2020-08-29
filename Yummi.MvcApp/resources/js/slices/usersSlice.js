import {createSlice} from "@reduxjs/toolkit";

export const userSlice = createSlice({
   name: 'users',
   initialState: [],
   reducers: {
       setUsers: (state, action) => {
           state = action.payload;
       }
   }
});

export const {setUsers} = userSlice.actions;

export const selectUsers = state => state.users;

export default userSlice.reducer;
