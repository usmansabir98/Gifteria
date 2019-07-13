import React, { Component } from "react";
import { Grid, Row, Col, Table } from "react-bootstrap";

import Card from "../components/Card/Card.jsx";
import { thArray, tdArray } from "../variables/Variables.jsx";

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
                title="Striped Table with Hover"
                category="Here is a subtitle for this table"
                ctTableFullWidth
                ctTableResponsive
                content={

                  <table id="inventory" className="display" width="100%" ref = { el => this.el=el }>

                  </table>
                  // <Table striped hover>
                  //   <thead>
                  //     <tr>
                  //       {thArray.map((prop, key) => {
                  //         return <th key={key}>{prop}</th>;
                  //       })}
                  //     </tr>
                  //   </thead>
                  //   <tbody>
                  //     {tdArray.map((prop, key) => {
                  //       return (
                  //         <tr key={key}>
                  //           {prop.map((prop, key) => {
                  //             return <td key={key}>{prop}</td>;
                  //           })}
                  //         </tr>
                  //       );
                  //     })}
                  //   </tbody>
                  // </Table>
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
