import React from "react";

const LayoutHOC = MainComponent => {
    function LayoutWithComponent(){
        return (
            <div className='container mt-5 shadow bg-light'>
                <MainComponent/>
            </div>
        )
    }

    return LayoutWithComponent;
}

export default LayoutHOC;
