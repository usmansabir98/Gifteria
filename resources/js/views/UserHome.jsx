import React, { Component } from "react";
import { Grid, Row, Col, Table } from "react-bootstrap";
import { Link } from "react-router-dom";
import axios from 'axios';

import Card from "../components/Card/Card.jsx";
import UserProductList from "./UserProductList.jsx";


class UserHome extends Component {
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
      
    });
    
  }

  render() {
    return (
      <div className="content">
        <Grid fluid>
          <Row>
            <Col md={12}>
              <UserProductList />
            </Col>

            
          </Row>
        </Grid>
      </div>
    );
  }
}

export default UserHome;
