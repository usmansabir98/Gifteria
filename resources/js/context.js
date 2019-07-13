import React, { Component } from 'react';
import { storeProducts, detailProduct } from "./data";
import axios from 'axios';

const ProductContext = React.createContext();

class ProductProvider extends Component {
    constructor(props) {
        super(props);
        this.state = {
            products: storeProducts,
            detailProduct: detailProduct,
            cart: []
        }

        this.handleDetail = this.handleDetail.bind(this);
        this.addToCart = this.addToCart.bind(this);
        this.removeFromCart = this.removeFromCart.bind(this);

    }

    componentDidMount(){

        axios.get('/api/products').then(res => {
           let products = [];

           res.data.map(product=>{
               products.push({...product, inCart: false, count: 0, total: 0})
           });
           this.setState(
            {
               products:products
            },
            ()=>{console.log(this.state.products)}
        ) 
        });

    }

    handleDetail(){
        console.log("hello from handle detail");
    }

    removeFromCart(id){
        console.log("hello from remove from cart: ", id);

        var cart = this.state.cart.filter(x => {
            return x.id != id;
          })
        
        this.setState({cart: cart}, ()=>console.log(this.state.cart));
    }
    
    addToCart(id){
        console.log("hello from add to cart: ", id);
        let product = this.state.products.find(item => item.id === id);
        let cart = this.state.cart;
        cart.push(product);
        this.setState({cart: cart}, ()=>console.log(this.state.cart));

        let products = this.state.products.map(product=> {
            if(product.id==id){
                product.inCart = true;
            }
            return product;
        });

        this.setState({products: products});
    }

    render() {
        return (
            <ProductContext.Provider value={
                {...this.state, handleDetail: this.handleDetail, addToCart: this.addToCart, removeFromCart: this.removeFromCart}
                }>
                {this.props.children}
            </ProductContext.Provider>
        );
    }
}

// export default ProductProvider;
const ProductConsumer = ProductContext.Consumer;

export {ProductConsumer, ProductProvider};
