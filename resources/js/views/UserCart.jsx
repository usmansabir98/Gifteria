import React, { Component } from 'react';
import ReactHtmlParser from 'react-html-parser';

import { ProductConsumer } from "../context";
import Paypal from "./Paypal";

class UserCart extends Component {
    render() {
        return (
            <ProductConsumer>
                {
                    
                    (value) => {
                        let btn = null; let paypal = null;
                        if(value.cart.length!=0){
                            btn = <button className="btn btn-danger" onClick={()=>value.clearCart()}>Clear Cart</button>
                        }
                        if(value.cart.length!=0){
                            paypal = <Paypal total={value.cartTotal} history={this.props.history} clearCart={value.clearCart}/>
                        }
                        return <div className="container">
                            
                                <table className="table table-condensed">
                                    <thead>
                                        <tr>
                                        <th>Name</th>
                                        <th>Brand</th>
                                        <th>Qty</th>
                                        <th>SubTotal</th>
                                        <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    {
                                        value.cart.map(item => {
                                            return <tr>
                                                <td>{ReactHtmlParser(item.name)}</td>
                                                <td>{item.brand}</td>
                                                {/* <td><input type="number" defaultValue="1"/></td> */}
                                                <td>
                                                    <button className="btn btn-danger" onClick={()=>value.decrement(item.id)}>-</button>
                                                    <span style={{padding: '0 20px'}}>{item.count}</span>
                                                    <button className="btn btn-success" onClick={()=>value.increment(item.id)}>+</button>
                                                </td>
                                                <td>{item.total}</td>
                                                {/* <td><button class="btn btn-danger" onClick={()=>value.removeFromCart(item.id)}>Remove</button></td> */}
                                                <td><i class="pe-7s-trash" onClick={()=>value.removeFromCart(item.id)} style={{fontSize: '38px', color: 'red', cursor: 'pointer'}} /></td>
                                            </tr>
                                        })
                                    }
                                    </tbody>
                                </table>
                                    
                                    {btn}
                                    <div><strong>Cart Subtotal: </strong>Rs. {value.cartSubtotal}</div>
                                    <div><strong>Cart Tax: </strong>Rs. {value.cartTax}</div>
                                    <div><strong>Cart Total: </strong>Rs. {value.cartTotal}</div>
                                    {paypal}
                        </div>
                    }
                }

            </ProductConsumer>
        );
    }
}

export default UserCart;
