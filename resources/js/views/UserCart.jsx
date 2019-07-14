import React, { Component } from 'react';
import ReactHtmlParser from 'react-html-parser';

import { ProductConsumer } from "../context";

class UserCart extends Component {
    render() {
        return (
            <ProductConsumer>
                {
                    (value) => {
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
                                    <div><strong>Cart Subtotal: </strong>Rs. {value.cartSubtotal}</div>
                                    <div><strong>Cart Tax: </strong>Rs. {value.cartTax}</div>
                                    <div><strong>Cart Total: </strong>Rs. {value.cartTotal}</div>
                            
                        </div>
                    }
                }

            </ProductConsumer>
        );
    }
}

export default UserCart;
