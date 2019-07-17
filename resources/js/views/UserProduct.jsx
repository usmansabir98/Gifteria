import React, { Component } from 'react';
import styled from 'styled-components';
import {Link} from 'react-router-dom';
import ReactHtmlParser from 'react-html-parser';

import { ProductConsumer } from "../context";

class UserProduct extends Component {
    render() {
        // console.log(this.props.product);
        const {id, name, brand, cover_image, price, inCart} = this.props.product;
        return (
            <ProductWrapper className="col-9 mx-auto col-md-6 col-lg-3 my-3">
                <div className="card">
                    <div className="img-container p-5">
                        <Link to={'item/'+id}>
                            <img src={'../storage/cover_images/'+cover_image} alt="image" className="card-img-top img-responsive" />
                        </Link>
                        
                    </div>
                    <div className="card-footer d-flex justify-content-between" style={ {display: "flex", justifyContent: "space-between"} }>
                        <p className="align-self-center mb-0">{ReactHtmlParser(name)}</p>
                        <h5 className="italic mb-0">Rs. {price}</h5>
                    </div>
                    <ProductConsumer>
                        {
                            (value) => {
                                let appState = JSON.parse((localStorage['appState']));
                                if(appState.isLoggedIn){
                                    return <button className="btn cart-btn btn-block btn-primary" disabled={inCart?true:false}
                                onClick={()=>value.addToCart(id)}>
                                    {inCart?<span>Added</span>:<span>Add to Cart</span>}
                                </button>
                                }

                                return null;
                                
                            }
                        }
                    </ProductConsumer>
                    
                </div>
            </ProductWrapper>
        );
    }
}

export default UserProduct;

const ProductWrapper = styled.div`
    .card{
        border-color: transparent;
        transition: all 0.2s linear;
    }

    .card-footer{
        background: transparent;
        border-top: transparent;
        transition: all 0.2s linear;
    }

    &:hover{
        .card{
            border: 0.04rem solid rgba(0,0,0,0.7);
            box-shadow: 2px 2px 5px 0 rgba(0,0,0,0.2);
        }
        .card-footer{
            background: rgba(0,128,128,0.1);
        }
    }

    .card-img-top{}
`
