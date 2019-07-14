import React, { Component } from 'react';
import {ProductConsumer} from '../context';
import styled from 'styled-components';
import axios from 'axios';

class UserProductDetails extends Component {
    constructor(props) {
        super(props);
        this.state = {
            product: []
        }
    }

    componentDidMount(){
        axios.get(`/api/inventory/${this.props.match.params.id}`)
        .then(res=>{
            // console.log(res.data);
            this.setState({product: res.data});
        });
    }

    render() {
        console.log(this.state.product);

        const {id, price, quantity, inventory_item_name, inventory_item_product_brand, 
            inventory_item_product_category, product_cover_image, product_event_category} = this.state.product;
        let pec = null;
        if(product_event_category!=undefined)
            pec = product_event_category.map(ec => {return <li className="list-group-item">{ec}</li>})
        return (
            <ProductDetailsWrapper>
                <h3>Product Details</h3>
                {/* <h1>{this.props.match.params.id}</h1> */}
                <div className="media">
                    <div className="media-left">
                        <img className="media-object" src={'../../storage/cover_images/' + product_cover_image} alt="..." style={{width: '300px', height:'300px'}}/>
                    </div>
                    <div className="media-body">
                        <h4 className="media-heading">{inventory_item_name}</h4>
                        <p>Brand: {inventory_item_product_brand}</p>
                        <p>Category: {inventory_item_product_category}</p>
                        <ul className="list-group">
                            {
                                pec
                            }
                        </ul>
                        <span className="tag">Rs. {price}/-</span>
                        <span className="tag-quantity">{quantity!=0?'In Stock':'Out of Stock'}</span>

                        <ProductConsumer>
                        {
                            (value) => {
                                let item = value.products.find((item)=>{
                                    return item.id == id;
                                });
                                if(item!=undefined)
                                    return <button className="btn cart-btn btn-primary" 
                                    style={{float: 'right'}}
                                    disabled={item.inCart?true:false}
                                    onClick={()=>value.addToCart(id)}>
                                        {item.inCart?<span>Added</span>:<span>Add to Cart</span>}
                                    </button>
                            }
                        }
                    </ProductConsumer>

                    </div>
                </div>
            </ProductDetailsWrapper>
        );
    }
}

export default UserProductDetails;

const ProductDetailsWrapper = styled.div`
.media{
    padding: 20px;
}
.tag {
	display: inline-block;
  
  width: auto;
	height: 38px;
	
	background-color: #979797;
	-webkit-border-radius: 3px 4px 4px 3px;
	-moz-border-radius: 3px 4px 4px 3px;
	border-radius: 3px 4px 4px 3px;
	
	border-left: 1px solid #979797;

	/* This makes room for the triangle */
	margin-left: 19px;
	
	position: relative;
	
	color: white;
	font-weight: 300;
	font-family: 'Source Sans Pro', sans-serif;
	font-size: 22px;
	line-height: 38px;

	padding: 0 10px 0 10px;
}

.tag-quantity{
    display: inline-block;
  
  width: auto;
	height: 38px;
	
	background-color: #e0e0e0;
	-webkit-border-radius: 3px 4px 4px 3px;
	-moz-border-radius: 3px 4px 4px 3px;
	border-radius: 3px 4px 4px 3px;
	
	border-left: 1px solid #979797;

	/* This makes room for the triangle */
	margin-left: 19px;
	
	position: relative;
	
	color: black;
	font-weight: 300;
	font-family: 'Source Sans Pro', sans-serif;
	font-size: 22px;
	line-height: 38px;

	padding: 0 10px 0 10px;
}

/* Makes the triangle */
.tag:before {
	content: "";
	position: absolute;
	display: block;
	left: -19px;
	width: 0;
	height: 0;
	border-top: 19px solid transparent;
	border-bottom: 19px solid transparent;
	border-right: 19px solid #979797;
}

/* Makes the circle */
.tag:after {
	content: "";
	background-color: white;
	border-radius: 50%;
	width: 4px;
	height: 4px;
	display: block;
	position: absolute;
	left: -9px;
	top: 17px;
}
`