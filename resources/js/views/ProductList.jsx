import React, { Component } from "react";
import { Grid, Row, Col, Table } from "react-bootstrap";
import { Link } from "react-router-dom";
import axios from 'axios';

import Card from "../components/Card/Card.jsx";

import "./css/jquery.dataTables.css";


const $ = require('jquery');
$.DataTable = require('datatables.net');

class ProductList extends Component {
  constructor () {
    super()
    this.state = {
      products: []
    }
  }

  componentDidMount(){
    axios.get('/api/products').then(response => {
      this.setState({
        products: response.data
      });
      console.log(response.data);
      this.$el = $(this.el);
    this.$el.DataTable(
      {
        data: this.state.products,
        columns: [
            { title: "ID", data: 'id' },
            { title: "Name", data: 'name' },
            // { title: "Description", data: 'description' },
            { title: "Brand", data: 'brand' },
            { title: "Product Category", data: 'product_category' },
            { title: "Event Category", data: 'event_category' }
        ]
    }
    )
    });
    
  }

  componentWillUnmount(){
    this.$el.DataTable().destroy(true);
  }

  render() {
    return (
      <div className="content">
        <Grid fluid>
          <Row>
            <Col md={12}>
              <Card
                title="Products"
                category="List of all the products"
                ctTableFullWidth
                ctTableResponsive
                content={
                  <div style={{padding: '20px'}}>
                    <Link to='/admin/product/create'><i className='pe-7s-plus' style={{fontSize: '44px', float: 'right', marginBottom: '20px'}} /></Link>
                    <table id="products" className="display" width="100%" ref = { el => this.el=el }>

                    </table>
                  </div>
                  
                  
                }
              />
            </Col>

            
          </Row>
        </Grid>
      </div>
    );
  }
}

export default ProductList;
