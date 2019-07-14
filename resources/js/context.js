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
            cart: [],
            cartSubtotal: 0,
            cartTax: 0,
            cartTotal: 0
        }

        this.handleDetail = this.handleDetail.bind(this);
        this.addToCart = this.addToCart.bind(this);
        this.removeFromCart = this.removeFromCart.bind(this);
        this.decrement = this.decrement.bind(this);
        this.increment = this.increment.bind(this);
        this.addTotals = this.addTotals.bind(this);

    }

    componentDidMount(){
        if(localStorage["cart"]==undefined)
            localStorage["cart"] = JSON.stringify([]);
        axios.get('/api/inventory').then(res => {
           let products = [];
           let cart = localStorage["cart"];
           cart = JSON.parse(cart);

           res.data.map(product=>{
                let inCart = false;
                let p = cart.find(item => {
                    return item.id == product.id
                });
                if(p){
                    inCart = p.inCart;
                }
               products.push({...product, inCart: inCart, count: 0, total: 0})
           });

           
           this.setState(
            {
               products: products,
               cart: cart
            },
            ()=>{
            this.addTotals();
            }
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

        let products = this.state.products.map(product=> {
            if(product.id==id){
                product.inCart = false;
                product.count = 0;
                product.total = 0;
            }
            return product;
        });
        
        this.setState({products: products, cart: cart}, ()=>{
            console.log(this.state.cart);
            localStorage["cart"] = JSON.stringify(this.state.cart);
            this.addTotals();

        });
    }
    
    addToCart(id){
        console.log("hello from add to cart: ", id);
        // let product = this.state.products.find(item => item.id === id);
        let cart = [...this.state.cart];
        // cart.push(product);
        // this.setState({cart: cart}, ()=>console.log(this.state.cart));

        let products = this.state.products.map(product=> {
            if(product.id==id){
                product.inCart = true;
                product.count = 1;
                product.total = product.price;
                cart.push(product);
            }
            return product;
        });

        this.setState({products: products, cart: cart}, ()=>{
            localStorage["cart"] = JSON.stringify(this.state.cart);
            this.addTotals();
        });
    }

    increment(id){
        // console.log('increment');
        let cart = [...this.state.cart];
        let item = cart.find(i => {return i.id===id});
        let index = cart.indexOf(item);
        const product = cart[index];
        product.count += 1;
        product.total = product.count * product.price;

        this.setState({cart: [...cart]}, ()=>{
            localStorage["cart"] = JSON.stringify(this.state.cart);
            this.addTotals();
        });
    }

    decrement(id){
        // console.log('decrement');
        let cart = [...this.state.cart];
        let item = cart.find(i => {return i.id===id});
        let index = cart.indexOf(item);
        const product = cart[index];
        product.count -= 1;

        if (product.count===0) {
            this.removeFromCart(id);
        } else {
            product.total = product.count * product.price;    
            this.setState({cart: [...cart]}, ()=>{
                localStorage["cart"] = JSON.stringify(this.state.cart);
                this.addTotals();
            });        
        }
        
    }

    addTotals(){
        let subTotal = 0;
        this.state.cart.map(item => {subTotal+=item.total});
        let tax = subTotal*0.17;
        tax = parseFloat(tax.toFixed(2));
        let total = subTotal + tax;

        this.setState({cartSubtotal: subTotal, cartTax: tax, cartTotal: total});
    }

    render() {
        return (
            <ProductContext.Provider value={
                {...this.state, handleDetail: this.handleDetail, addToCart: this.addToCart, 
                    removeFromCart: this.removeFromCart, increment: this.increment, decrement: this.decrement}
                }>
                {this.props.children}
            </ProductContext.Provider>
        );
    }
}

// export default ProductProvider;
const ProductConsumer = ProductContext.Consumer;

export {ProductConsumer, ProductProvider};
