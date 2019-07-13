import React, { Component } from "react";
import { Grid, Row, Col, Table, FormGroup, FormControl, ControlLabel, HelpBlock, Checkbox, Button } from "react-bootstrap";
import axios from 'axios';

// import "./css/style.css";


import Card from "../components/Card/Card.jsx";

class Product extends Component {
  constructor (props) {
    super(props);
    this.state = {
      id: 0,
      name: '',
      description: '',
      brand: '',
      event_category: [],
      product_category: '',
      image1: '',
      image2: '',
      image3: '',
      cover_image: '',
      product_categories: [],
      event_categories: [],
      brands: [],

      checkedItems: {}
    };

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleCheck = this.handleCheck.bind(this);
  }

  componentDidMount(){
    axios.get(`/api/products/${this.props.match.params.id}/edit`).then(response => {
      this.setState({
         id: response.data.id,
         name: response.data.name,
         brand: response.data.brand,
         event_category: response.data.event_category,
         product_category: response.data.product_category,
         description: response.data.description

      });
    //   console.log(response.data);
      
    });

    axios.get(`/api/all/productcategories`).then(response => {
        this.setState({
            product_categories: response.data
        });
        // console.log(this.state.product_categories);
    });

    axios.get(`/api/all/brands`).then(response => {
        this.setState({
            brands: response.data
        });
        // console.log(this.state.product_categories);
    });
    
    axios.get(`/api/all/eventcategories`).then(response => {
        let eventcat = response.data;

        let obj = {};

        eventcat.map(e => {
            obj[e.name] = false;
        })

        
        // console.log(this.state.product_categories);

        this.state.event_category.map(e => {
            obj[e] = true;
        })

        this.setState({
            event_categories: response.data,
            checkedItems: obj
        });
    });
  }

  componentWillUnmount(){
    
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

  handleCheck(e){
    console.log(e.target.name);
    const item = e.target.name;
    const isChecked = e.target.checked;
    this.setState({ checkedItems: { ...this.state.checkedItems, [item]: isChecked } });

    // console.log(this.state.checkedItems)
  }

  handleSubmit(e){
        let keys = Object.keys(this.state.checkedItems);
        let categories = [];

        keys.map( k => {
        if(this.state.checkedItems[k]){
            categories.push(k);
        }
        });

      let product = {
        name: this.state.name,
        description: this.state.description,
        brand: this.state.brand,
        event_category: categories,
        product_category: this.state.product_category
      };

      console.log(product);
      
      axios.put(`/api/products/${this.state.id}`, product)
      .then(response=>{
          console.log(response);
      });

      e.preventDefault();
  }

  render() {
    let pc= {name:'select'}; // product category
    let b= {name:'select'}; // brand
    let ec= {name:'select'}; // event categories

    if(this.state.product_categories.length!=0){
        pc = this.state.product_categories.find((cat)=>{
            return cat.name==this.state.product_category
        })
    }

    if(this.state.brands.length!=0){
        b = this.state.brands.find((b)=>{
            return b.name==this.state.brand
        })
    }

    // if(this.state.event_categories.length!=0){
    //     ec = this.state.event_categories.find((cat)=>{
    //         return cat.name==this.state.product_category
    //     })
    // }

    return (
      <div className="content">
        <Grid fluid>
          <Row>
            <Col md={12}>
              <Card
                title="Striped Table with Hover"
                category="Here is a subtitle for this table"
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
                                onChange={this.handleChange}
                            />
                            <FormControl.Feedback />
                        </FormGroup>

                        <FormGroup
                            controlId="description">
                            <ControlLabel>Product Description</ControlLabel>
                            <FormControl
                                name="description"
                                type="textarea"
                                value={this.state.description}
                                placeholder="Enter text"
                                onChange={this.handleChange}
                            />
                            <FormControl.Feedback />
                        </FormGroup>

                        <FormGroup controlId="brand">
                            <ControlLabel>Brand</ControlLabel>
                            <FormControl componentClass="select" placeholder="select" 
                            value={b.name} name="brand"
                            onChange={this.handleChange}
                            >
                            {
                                    this.state.brands.map( b => {
                                        return <option key={b.id} value={b.name}>{b.name}</option>
                                    })
                                }
                            </FormControl>
                        </FormGroup>
                        
                        <FormGroup controlId="product_category">
                            <ControlLabel>Product Category</ControlLabel>
                            <FormControl componentClass="select" placeholder="select" 
                            value={pc.name} name="product_category"
                            onChange={this.handleChange}
                            >
                            {
                                    this.state.product_categories.map( cat => {
                                        return <option key={cat.id} value={cat.name}>{cat.name}</option>
                                    })
                                }
                            </FormControl>
                        </FormGroup>

                        {/* <FormGroup controlId="event_categories">
                            <ControlLabel>Event Category</ControlLabel>
                            {
                                this.state.event_categories.map( cat => {
                                    return <div><label>{cat.name}: <input type="checkbox" key={cat.id} value={cat.name} /></label></div>
                                })
                            }

                        </FormGroup> */}

                        <FormGroup controlId="event_categories">
                            {
                                this.state.event_categories.map(item => (
                                    <div key={item.id}>
                                    
                                    {/* <Checkbox name={item.name} onChange={this.handleCheck} /> */}
                                    <input type="checkbox" name={item.name} checked={this.state.checkedItems[item.name]} onChange={this.handleCheck} />
                                    {item.name}
                                    </div>
                                ))
                            }
                        </FormGroup>



                        <Button type="submit">Update</Button>


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

export default Product;
