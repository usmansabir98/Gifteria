import React, { Component } from "react";
import { Grid, Row, Col, Table } from "react-bootstrap";
import { Link } from "react-router-dom";

import Card from "../components/Card/Card.jsx";

import "./css/jquery.dataTables.css";


const $ = require('jquery');
$.DataTable = require('datatables.net');

class InventoryList extends Component {
  componentDidMount(){
    axios.get('/api/inventory').then(response => {
        this.setState({
          products: response.data
        });
        console.log(response);
        this.$el = $(this.el);
      this.$el.DataTable(
        {
          data: this.state.products,
          columns: [
              { title: "ID", data: 'id' },
              { title: "Batch Code", data: 'batch_code' },
              { title: "Product Name", data: 'name' },
              { title: "Quantity", data: 'quantity' },
              { title: "Price", data: 'price' },
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
                title="Inventory"
                category="List of all inventory items"
                ctTableFullWidth
                ctTableResponsive
                content={

                  // <table id="inventory" className="display" width="100%" ref = { el => this.el=el }>

                  // </table>
                  <div style={{padding: '20px'}}>
                    <Link to='/admin/item/create'><i className='pe-7s-plus' style={{fontSize: '44px', float: 'right', marginBottom: '20px'}} /></Link>
                    <table id="inventory" className="display" width="100%" ref = { el => this.el=el }>

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

export default InventoryList;
