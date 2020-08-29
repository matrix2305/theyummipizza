import React, {useState} from "react";
import LayoutHOC from "../../services/LayoutHOC/LayoutHOC";
import FlashMessage from "../../services/FlashMessage/FlashMessage";

function AddPizza() {
    const [pizza, setPizza] = useState({
        name: '',
        description: '',
        image: '',
        price: {
            cm24: 0,
            cm32: 0,
            cm50: 0
        }
    });
    const [flashMsg, setFlashMsg] = useState({message: '', status: null});

    const setValue = e => {
        let id = e.target.id;
        let value = e.target.value;
        setPizza({...pizza, [id]: value})
    }

    const AddPizza = e => {
        e.preventDefault();
        if (pizza.name === '' | pizza.description === '' | pizza.image === '' | pizza.price.cm24 === 0 || pizza.price.cm32 === 0 | pizza.price.cm50 === 0){
            setFlashMsg({message: 'You have to fill all fields!', status: false});
            return;
        }
        axios.put('/api/addOrUpdate/pizza', pizza)
            .then(response => {
                console.log(response.data)
                setFlashMsg({message: response.data.message, status: response.data.status});
            })
            .catch(response => {
                console.log("Unsuccessful request.");
            })
    }

    const UploadImage = e => {
        let file = e.target.files[0];
        let reader = new FileReader();
        reader.onload = e => {
            setPizza({...pizza, image: e.target.result})
        }
        reader.readAsDataURL(file);
    }

    return(
        <div>
            <h2>Add pizza</h2>
            <form onSubmit={event => AddPizza(event)} className='form-group'>
                <FlashMessage message={flashMsg} duration={5000}/>
                <img src={pizza.image} width='200px' alt='Upload image!'/>
                <input type='file' onChange={event => UploadImage(event)}  className='form-control-file'/>
                <label>Name</label>
                <input type='text' id='name' onChange={event => setValue(event)} value={pizza.name} className='form-control'/>
                <label>Description</label>
                <textarea id='description' onChange={event => setValue(event)} value={pizza.description} className='form-control'> </textarea>
                <label>Price € - 24cm size</label>
                <input type='number' onChange={event => setPizza({...pizza, price: {...pizza.price, cm24: event.target.value}})} value={pizza.price.cm24} className='form-control'/>
                <label>Price € - 32cm size</label>
                <input type='number' onChange={event => setPizza({...pizza, price: {...pizza.price, cm32: event.target.value}})} value={pizza.price.cm32} className='form-control'/>
                <label>Price € - 50cm size</label>
                <input type='number' onChange={event => setPizza({...pizza, price: {...pizza.price, cm50: event.target.value}})} value={pizza.price.cm50} className='form-control'/>
                <button className='btn btn-red mt-3'>Add pizza</button>
            </form>
        </div>
    )
}


export default LayoutHOC(AddPizza);
