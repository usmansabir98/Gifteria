import React, { Component } from "react";
import { Grid, Row, Col, Table, FormGroup, FormControl, ControlLabel, HelpBlock, Checkbox, Button } from "react-bootstrap";
import axios from 'axios';

// import "./css/style.css";


import Card from "../components/Card/Card.jsx";

class ProductCategoryCreate extends Component {
  constructor (props) {
    super(props);
    this.state = {
      name: '',
      description: '',
    };

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }


  handleChange(e){
      console.log(e.target.name);
      const target = e.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name
    
        this.setState({
          [name]: value
        });
  }

  handleSubmit(e){
    console.log(JSON.stringify(this.state));

   axios.post(`/api/productcategories`, this.state)
   .then(response=>{
       console.log(response);
   });

      e.preventDefault();
      this.props.history.push('/admin/productcategories');

  }

  render() {

    return (
      <div className="content">
        <Grid fluid>
          <Row>
            <Col md={12}>
              <Card
                title="Product Categories"
                category=""
                ctTableFullWidth
                ctTableResponsive
                content={
                    <form onSubmit={(values) => this.handleSubmit(values)}>
                        <FormGroup
                            controlId="name">
                            <ControlLabel>Product Category Name</ControlLabel>
                            <FormControl
                                name="name"
                                type="text"
                                value={this.state.name}
                                placeholder="Enter text"
                                onChange={this.handleChange}
                                required
                            />
                            <FormControl.Feedback />
                        </FormGroup>

                        <FormGroup
                            controlId="description">
                            <ControlLabel>Product Category Description</ControlLabel>
                            <FormControl
                                name="description"
                                type="textarea"
                                value={this.state.description}
                                placeholder="Enter text"
                                onChange={this.handleChange}
                                required
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

export default ProductCategoryCreate;
