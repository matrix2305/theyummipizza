import React, {useState} from "react";
import LayoutHOC from "../../services/LayoutHOC/LayoutHOC";
import FlashMessage from "../../services/FlashMessage/FlashMessage";

function AddDrink(){
    const [drink, setDrink] = useState({
        name: '',
        image: '',
        price: 0,
    });
    const [flashMsg, setFlashMsg] = useState({message: '', status: null});

    const setValue = e => {
        let id = e.target.id;
        let value = e.target.value;
        setDrink({...drink, [id]: value})
    }

    const UploadImage = e => {
        let file = e.target.files[0];
        let reader = new FileReader();
        reader.onload = e => {
            setDrink({...drink, image: e.target.result})
        }
        reader.readAsDataURL(file);
    }

    const AddDrink = e => {
        e.preventDefault();
        axios.put('/api/addOrUpdate/drink', drink)
            .then(response => {
                console.log(response.data)
                setFlashMsg({message: response.data.message, status: response.data.status});
            })
            .catch(response => {
                console.log("Unsuccessful request.");
            })
    }

    return(
        <div>
            <h2>Add drink</h2>
            <form onSubmit={event => AddDrink(event)} className='form-group'>
                <FlashMessage message={flashMsg} duration={5000}/>
                <img src={drink.image} width='200px' alt='Upload image!'/>
                <input type='file' onChange={event => UploadImage(event)}  className='form-control-file'/>
                <label>Name</label>
                <input type='text' id='name' onChange={event => setValue(event)} value={drink.name} className='form-control'/>
                <label>Price</label>
                <input type='number' id='price' onChange={event => setValue(event)} value={drink.price} className='form-control'/>
                <button className='btn btn-red mt-3'>Add drink</button>
            </form>
        </div>
    )
}

export default LayoutHOC(AddDrink);
