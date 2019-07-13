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
                                        <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    {
                                        value.cart.map(item => {
                                            return <tr>
                                                <td>{ReactHtmlParser(item.name)}</td>
                                                <td>{item.brand}</td>
                                                <td><input type="number" defaultValue="1"/></td>
                                                <td><button class="btn btn-danger" onClick={()=>value.removeFromCart(item.id)}>Remove</button></td>

                                            </tr>
                                        })
                                    }
                                    </tbody>
                                </table>
                            
                            
                        </div>
                    }
                }

            </ProductConsumer>
        );
    }
}

export default UserCart;
