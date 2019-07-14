import React, { Component } from "react";
import { Grid, Row, Col, Table } from "react-bootstrap";
import { Link } from "react-router-dom";

import axios from 'axios';

import Card from "../components/Card/Card.jsx";

import "./css/jquery.dataTables.css";


const $ = require('jquery');
$.DataTable = require('datatables.net');

class BrandList extends Component {
  constructor () {
    super()
    this.state = {
      products: []
    }
  }

  componentDidMount(){
    axios.get('/api/brands').then(response => {
      this.setState({
        products: response.data.data
      });
      console.log(response);
      this.$el = $(this.el);
    this.$el.DataTable(
      {
        data: this.state.products,
        "columnDefs": [
          {
              // The `data` parameter refers to the data for the cell (defined by the
              // `data` option, which defaults to the column being worked with, in
              // this case `data: 0`.
              "render": function ( data, type, row ) {
                  var html = $.parseHTML(data);
                  console.log(html);
                  return html[0].data;
              },
              "targets": [1]
          },
          // { "visible": true,  "targets": [ 3 ] }
      ],
        columns: [
            { title: "ID", data: 'id' },
            { title: "Name", data: 'name' },
            { title: "Description", data: 'description' },
            { title: "Created At", data: 'created_at' },
            { title: "Updated At", data: 'updated_at' }
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
                title="Brands"
                category="List of all the brands"
                ctTableFullWidth
                ctTableResponsive
                content={

                  <div style={{padding: '20px'}}>
                    <Link to='/admin/brand/create'><i className='pe-7s-plus' style={{fontSize: '44px', float: 'right', marginBottom: '20px'}} /></Link>
                    <table id="brands" className="display" width="100%" ref = { el => this.el=el }>

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

export default BrandList;
