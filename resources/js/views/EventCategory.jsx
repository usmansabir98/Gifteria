import React, { Component } from "react";
import { Grid, Row, Col, Table, FormGroup, FormControl, ControlLabel, HelpBlock, Checkbox, Button } from "react-bootstrap";
import axios from 'axios';

// import "./css/style.css";


import Card from "../components/Card/Card.jsx";

class EventCategory extends Component {
  constructor (props) {
    super(props);
    this.state = {
      name: '',
      description: '',
    };

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleClick = this.handleClick.bind(this);

  }

  componentDidMount(){
    axios.get(`/api/eventcategories/${this.props.match.params.id}`).then(response => {
      this.setState({
        id: response.data.id,
         name: response.data.name,
         description: response.data.description
      });
      
    });
  }

  handleClick(e){
    if(e.target.id==='delete'){
        axios.get(`/api/eventcategories/${this.state.id}/delete`)
        .then(res => {
            console.log(res);
        });
    }
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

   axios.put(`/api/eventcategories/${this.state.id}`, this.state)
   .then(response=>{
       console.log(response);
   });

      e.preventDefault();
      this.props.history.push('/admin/eventcategories');

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
                    <form onSubmit={(values) => this.handleSubmit(values)}>
                        <FormGroup
                            controlId="name">
                            <ControlLabel>Event Category Name</ControlLabel>
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
                            <ControlLabel>Event Category Description</ControlLabel>
                            <FormControl
                                name="description"
                                type="textarea"
                                value={this.state.description}
                                placeholder="Enter text"
                                onChange={this.handleChange}
                            />
                            <FormControl.Feedback />
                        </FormGroup>

                        <Button type="submit">Update</Button>
                        {/* <Button id="delete" className="btn btn-danger" onClick={this.handleClick}>Delete</Button> */}

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

export default EventCategory;
