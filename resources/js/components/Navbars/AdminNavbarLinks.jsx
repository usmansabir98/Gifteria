import React, { Component } from "react";
import { NavItem, Nav, NavDropdown, MenuItem } from "react-bootstrap";

class AdminNavbarLinks extends Component {
  render() {
    const notification = (
      <div>
        <i className="fa fa-globe" />
        <b className="caret" />
        <span className="notification">5</span>
        <p className="hidden-lg hidden-md">Notification</p>
      </div>
    );

    // console.log(this.props);
    let navbar = null;
    let appState = JSON.parse(localStorage['appState']);
    if(appState.isLoggedIn){
      
      navbar = <NavDropdown
          eventKey={2}
          title="Account"
          id="basic-nav-dropdown-right"
        >
          <MenuItem eventKey={2.1}>{appState.user.name}</MenuItem>
          {/* <MenuItem eventKey={2.2}>Another action</MenuItem>
          <MenuItem eventKey={2.3}>Something</MenuItem>
          <MenuItem eventKey={2.4}>Another action</MenuItem>
          <MenuItem eventKey={2.5}>Something</MenuItem> */}
          <MenuItem divider />
          <MenuItem eventKey={2.5} onClick={()=>{
            this.props.logoutUser();
            this.props.history.push('/user/home');
          }}>Log Out</MenuItem>
        </NavDropdown>
    }
    else{
      navbar = <NavItem eventKey={3} onClick={()=>this.props.history.push('/login')}>
            Log In
          </NavItem>
    }
    return (
      <div>
        <Nav>
          <NavItem eventKey={1} href="#">
            <i className="fa fa-dashboard" />
            <p className="hidden-lg hidden-md">Dashboard</p>
          </NavItem>
          <NavDropdown
            eventKey={2}
            title={notification}
            noCaret
            id="basic-nav-dropdown"
          >
            <MenuItem eventKey={2.1}>Notification 1</MenuItem>
            <MenuItem eventKey={2.2}>Notification 2</MenuItem>
            <MenuItem eventKey={2.3}>Notification 3</MenuItem>
            <MenuItem eventKey={2.4}>Notification 4</MenuItem>
            <MenuItem eventKey={2.5}>Another notifications</MenuItem>
          </NavDropdown>
          <NavItem eventKey={3} href="#">
            <i className="fa fa-search" />
            <p className="hidden-lg hidden-md">Search</p>
          </NavItem>
        </Nav>
        <Nav pullRight>
          {/* <NavItem eventKey={1} href="#">
            Account
          </NavItem> */}
          {navbar}
          
        </Nav>
      </div>
    );
  }
}

export default AdminNavbarLinks;
