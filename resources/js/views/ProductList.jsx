import React, { Component } from "react";
import { Grid, Row, Col, Table } from "react-bootstrap";

import Card from "../components/Card/Card.jsx";
import { thArray, tdArray } from "../variables/Variables.jsx";

import "./css/jquery.dataTables.css";


const $ = require('jquery');
$.DataTable = require('datatables.net');

class ProductList extends Component {
  componentDidMount(){
    this.$el = $(this.el);
    this.$el.DataTable(
      {
        data: tdArray,
        columns: [
            { title: "ID" },
            { title: "Name" },
            { title: "Salary" },
            { title: "Country" },
            { title: "City" }
        ]
    }
    )
  }

  componentWillUnmount(){

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

                  <table id="products" class="display" width="100%" ref = { el => this.el=el }>

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

export default ProductList;
