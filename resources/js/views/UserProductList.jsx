import React, { Component } from 'react';
import UserProduct from './UserProduct';
import {ProductConsumer} from '../context';


class UserProductList extends Component {
    render() {
        return (
            <div>
                <h3>Product List</h3>

                <ProductConsumer>
                    {
                        (value) => {
                            console.log(value);
                            return value.products.map( product => {
                                return <UserProduct key={product.id} product={product} />
                            });
                        }
                    }
                </ProductConsumer>
            </div>
        );
    }
}

export default UserProductList;
