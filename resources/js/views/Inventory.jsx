import React, { Component } from "react";
import { Grid, Row, Col, Table, FormGroup, FormControl, ControlLabel, HelpBlock, Checkbox, Button } from "react-bootstrap";
import axios from 'axios';

// import "./css/style.css";


import Card from "../components/Card/Card.jsx";

class Inventory extends Component {
  constructor (props) {
    super(props);
    this.state = {
      id: 0,
      name: '',
      batch_code: '',
      quantity: 0,
      price: 0,
      is_expirable: "no",
      expiry_date: new Date()
    };

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleClick = this.handleClick.bind(this);
  }

  componentDidMount(){
    axios.get(`/api/inventory/${this.props.match.params.id}/edit`).then(response => {
      this.setState({
         id: response.data.id,
         name: response.data.name,
         batch_code: response.data.batch_code,
         quantity: response.data.quantity,
         price: response.data.price,
         is_expirable: response.data.is_expirable,
         expiry_date: response.data.expiry_date

      });
    //   console.log(response.data);
      
    });

  }

  handleClick(e){
    if(e.target.id==='delete'){
        axios.get(`/api/inventory/${this.state.id}/delete`)
        .then(res => {
            console.log(res);
        });
    }
  }

  handleChange(e){
      console.log(e.target.name);
      const target = e.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name;

        if(name==='is_expirable' && value==='no'){
            this.setState({
                [name]: value,
                expiry_date: ''
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
        is_expirable: this.state.is_expirable,
        expiry_date: this.state.expiry_date,
        price: this.state.price,
        quantity: this.state.quantity,
      };

      console.log(product);
      
      axios.put(`/api/inventory/${this.state.id}`, product)
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
                            controlId="name">
                            <ControlLabel>Product Name</ControlLabel>
                            <FormControl
                                name="name"
                                type="text"
                                value={this.state.name}
                                placeholder="Enter text"
                                disabled
                                onChange={this.handleChange}
                            />
                            <FormControl.Feedback />
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

                        <FormGroup controlId="is_expirable">
                            <ControlLabel>Is Expirable?</ControlLabel>
                            <FormControl componentClass="select" placeholder="select" 
                            value={this.state.is_expirable} name="is_expirable"
                            onChange={this.handleChange}
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
                                value={this.state.is_expirable==="yes"?this.state.expiry_date:""}
                                disabled={this.state.is_expirable==="no"?true:false}
                                onChange={this.handleChange}
                            />
                            <FormControl.Feedback />
                        </FormGroup>


                        <Button type="submit">Update</Button>
                        <Button id="delete" className="btn btn-danger" onClick={this.handleClick}>Delete</Button>

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

export default Inventory;
