import React, { Component } from "react";
import { Grid, Row, Col, Table, FormGroup, FormControl, ControlLabel, HelpBlock, Checkbox, Button } from "react-bootstrap";
import axios from 'axios';

// import "./css/style.css";


import Card from "../components/Card/Card.jsx";

class InventoryCreate extends Component {
  constructor (props) {
    super(props);
    this.state = {
      product_id: 0,
      batchcode: '',
      quantity: 0,
      price: 0,
      isexpirable: "no",
      expirydate: "",

      products: []
    };

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  componentDidMount(){
    axios.get(`/api/products?edit=1`).then(response => {
      this.setState({
         products: response.data

      });
    //   console.log(response.data);
      
    });

  }

  componentWillUnmount(){
    
  }

  handleChange(e){
      console.log(e.target.name);
      const target = e.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name;

        if(name==='isexpirable' && value==='no'){
            this.setStte({
                [name]: value,
                expirydate: ''
            });
        }

        else{
            this.setState({
                [name]: value
            });
        }
  }

  handleSubmit(e){

      let product = {
        isexpirable: this.state.isexpirable,
        expirydate: this.state.expirydate,
        price: this.state.price,
        quantity: this.state.quantity,
        batchcode: this.state.batchcode,
        product_id: this.state.product_id
      };

      console.log(product);
      
      axios.post(`/api/inventory/`, product)
      .then(response=>{
          console.log(response);
      });

      e.preventDefault();

      this.props.history.push('/admin/inventory');
  }

  render() {
    return (
      <div className="content">
        <Grid fluid>
          <Row>
            <Col md={12}>
              <Card
                title="Inventory"
                category=""
                ctTableFullWidth
                ctTableResponsive
                content={
                    <form onSubmit={(values) => this.handleSubmit(values)}>

                        <FormGroup
                            controlId="batchcode">
                            <ControlLabel>Batch Code</ControlLabel>
                            <FormControl
                                name="batchcode"
                                type="text"
                                value={this.state.batchcode}
                                placeholder="Enter batch"
                                onChange={this.handleChange}
                            />
                            <FormControl.Feedback />
                        </FormGroup>

                        <FormGroup controlId="product_id">
                            <ControlLabel>Product</ControlLabel>
                            <FormControl componentClass="select" placeholder="select" 
                            value={this.state.product_id} name="product_id"
                            onChange={this.handleChange}
                            >
                                <option value="0">select</option>
                            {
                                this.state.products.map( p => {
                                    return <option key={p.id} value={p.id}>{p.name}</option>
                                })
                            }
                            </FormControl>
                        </FormGroup>


                        <FormGroup
                            controlId="quantity">
                            <ControlLabel>Quantity</ControlLabel>
                            <FormControl
                                name="quantity"
                                type="number"
                                min={0}
                                value={this.state.quantity}
                                placeholder="Enter quantity"
                                onChange={this.handleChange}
                            />
                            <FormControl.Feedback />
                        </FormGroup>

                        <FormGroup
                            controlId="price">
                            <ControlLabel>Price</ControlLabel>
                            <FormControl
                                name="price"
                                type="number"
                                value={this.state.price}
                                placeholder="Enter price"
                                onChange={this.handleChange}
                            />
                            <FormControl.Feedback />
                        </FormGroup>

                        <FormGroup controlId="isexpirable">
                            <ControlLabel>Is Expirabe?</ControlLabel>
                            <FormControl componentClass="select" placeholder="select" 
                            value={this.state.isexpirable} name="isexpirable"
                            onChange={this.handleChnge}
                            >
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </FormControl>
                        </FormGroup>
                        
                        <FormGroup
                            controlId="expiry_date">
                            <ControlLabel>Expiry Date</ControlLabel>
                            <FormControl
                                name="expiry_date"
                                type="date"
                                value={this.state.expirydate}
                                disabled={this.state.isexpirable==="no"?true:false}
                                onChange={this.handleChnge}
                            />
                            <FormControl.Feedback />
                        </FormGroup>


                        <Button type="submit">Create</Button>


                    </form>
                }
              />
            </Col>

            
          </Row>
        </Grid>
      </div>
    );
  }
}

export default InventoryCreate;
