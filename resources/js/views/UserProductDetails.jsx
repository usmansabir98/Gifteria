import React, { Component } from 'react';
import axios from 'axios';

class UserProductDetails extends Component {
    constructor(props) {
        super(props);
        this.state = {
            product: []
        }
    }

    componentDidMount(){
        axios.get(`/api/products/${this.props.match.params.id}`)
        .then(res=>{
            // console.log(res.data);
            this.setState({product: res.data});
        });
    }

    render() {
        console.log(this.state.product);

        const {id, name, product_brand, product_category, product_cover_image, product_event_category} = this.state.product;
        let pec = null;
        if(product_event_category!=undefined)
            pec = product_event_category.map(ec => {return <li className="list-group-item">{ec}</li>})
        return (
            <div>
                <h3>Product Details</h3>
                {/* <h1>{this.props.match.params.id}</h1> */}
                <div className="media">
                    <div className="media-left">
                        <img className="media-object" src={'../../storage/cover_images/' + product_cover_image} alt="..." style={{width: '300px', height:'300px'}}/>
                    </div>
                    <div className="media-body">
                        <h4 className="media-heading">{name}</h4>
                        <p>Brand: {product_brand}</p>
                        <p>Category: {product_category}</p>
                        <ul className="list-group">
                            {
                                pec
                            }
                        </ul>
                    </div>
                </div>
            </div>
        );
    }
}

export default UserProductDetails;
