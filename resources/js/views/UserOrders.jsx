import React, { Component } from "react";
import { Grid, Row, Col, Table } from "react-bootstrap";
import { Link } from "react-router-dom";

import Card from "../components/Card/Card.jsx";

import "./css/jquery.dataTables.css";


const $ = require('jquery');
$.DataTable = require('datatables.net');

class UserOrders extends Component {
  componentDidMount(){
    let appState = JSON.parse(localStorage['appState']);
    axios.get(`/api/orders?user=${appState.user.id}`).then(response => {
        this.setState({
          products: response.data
        });
        console.log(response);
        this.$el = $(this.el);
      this.$el.DataTable(
        {
          data: this.state.products,
          "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    var html = JSON.stringify(data);

                    let items = data.map(item => {
                        return `<span>${item.quantity} ${item.name}: Rs. ${item.subTotal}</span>`;
                    });

                    console.log(items);
                    return items;
                },
                "targets": [1]
            },
            {
                "render": function ( data, type, row ) {
                    var html = JSON.stringify(data);
                    html = 'Rs. ' + html;
                    return html;
                },
                "targets": [2]
            }
        ],
          columns: [
              { title: "ID", data: 'id' },
              { title: "Items", data: 'items' },
              { title: "Total", data: 'total_cost' },
              { title: "Order Date", data: 'date_of_order' },
              { title: "Expected Delivery Date", data: 'expected_delivery_date' },
              { title: "Order Status", data: 'status' }

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
                title="Orders"
                category="Track Your Orders"
                ctTableFullWidth
                ctTableResponsive
                content={
                  <div style={{padding: '20px'}}>
                    <table id="orders" className="display" width="100%" ref = { el => this.el=el }>

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

export default UserOrders;
