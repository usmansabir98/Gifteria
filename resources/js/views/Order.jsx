import React, { Component } from "react";
import { Grid, Row, Col, Table, FormGroup, FormControl, ControlLabel, HelpBlock, Checkbox, Button } from "react-bootstrap";
import axios from 'axios';

// import "./css/style.css";


import Card from "../components/Card/Card.jsx";

class Order extends Component {
  constructor (props) {
    super(props);
    this.state = {
      id: 0,
      user_name: '',
      date_of_order: '',
      expected_delivery_date: '',
      billing_address: '',
      items: [],
      total: 0,
      status: 1,
      disabled: true
    };

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  componentDidMount(){
    axios.get(`/api/orders/${this.props.match.params.id}`).then(response => {
      this.setState({
         id: response.data.id,
         user_name: response.data.user_name,
         date_of_order: response.data.date_of_order,
         expected_delivery_date: response.data.expected_delivery_date,
         billing_address: response.data.billing_address,
         items: response.data.items,
         total: response.data.total_cost,
         status: response.data.status

      }, ()=>{
          if(this.state.status==1){
              this.setState({disabled: false});
          }
      });
    //   console.log(response.data);
      
    });

  }

  handleChange(e){
      console.log(e.target.name);
      const target = e.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name;

        this.setState({
            [name]: value
        });
  }

  handleSubmit(e){

      let order = {
        id: this.state.id,
         status: this.state.status
      };

      axios.put(`/api/orders/${this.state.id}`, order)
      .then(response=>{
          console.log(response);
      });

      e.preventDefault();
      this.props.history.push('/admin/orders');

  }

  render() {
    return (
      <div className="content">
        <Grid fluid>
          <Row>
            <Col md={12}>
              <Card
                title="Customer Order"
                category="Take Actions"
                ctTableFullWidth
                ctTableResponsive
                content={
                    <React.Fragment>
                        <div className="container">
                        <p><strong>Customer: </strong>{this.state.user_name}</p>
                        <p><strong>Date of Order: </strong>{this.state.date_of_order}</p>
                        <p><strong>Expected Delivery: </strong>{this.state.expected_delivery_date}</p>
                        <p><strong>Billing Address: </strong>{this.state.billing_address}</p>
                        </div>
                    <Table striped hover>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Count</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        {this.state.items.map((prop, key) => {
                            return (
                            <tr key={key}>
                                <td>{prop.name}</td>
                                <td>{prop.quantity}</td>
                                <td>{prop.subTotal}</td>
                            </tr>
                            );
                        })}
                        </tbody>
                    </Table>
                    <form onSubmit={(values) => this.handleSubmit(values)}>

                        <FormGroup controlId="status">
                            <ControlLabel>Order Status</ControlLabel>
                            <FormControl componentClass="select" placeholder="select" 
                            value={this.state.status} name="status"
                            onChange={this.handleChange}
                            >
                                <option value="1">Created</option>
                                <option value="3">Delivered</option>
                                <option value="4">Cancelled</option>
                            </FormControl>
                        </FormGroup>
                        

                        <Button type="submit" disabled={this.state.disabled}>Update</Button>

                    </form>
                    </React.Fragment>
                }
              />
            </Col>

            
          </Row>
        </Grid>
      </div>
    );
  }
}

export default Order;
