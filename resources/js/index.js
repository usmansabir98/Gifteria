import React from "react";
import ReactDOM from "react-dom";

import { BrowserRouter, Route, Switch, Redirect, withRouter } from "react-router-dom";

import "bootstrap/dist/css/bootstrap.min.css";
import "./assets/css/animate.min.css";
import "./assets/sass/light-bootstrap-dashboard-react.scss?v=1.3.0";
import "./assets/css/demo.css";
import "./assets/css/pe-icon-7-stroke.css";

import AdminLayout from "./layouts/Admin.jsx";
import User from "./layouts/User.jsx";
import {ProductProvider} from "./context";



//authenticate
import Home from "./layouts/Home";
import Login from "./layouts/Login";
import Register from "./layouts/Register";

import axios from "axios";
import $ from "jquery";



// For Authenticate

class App extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      isLoggedIn: false,
      user: {}
    };

    this._loginUser = this._loginUser.bind(this);
    this._registerUser = this._registerUser.bind(this);
    this._logoutUser = this._logoutUser.bind(this);
  }
  _loginUser(email, password){
    $("#login-form button")
      .attr("disabled", "disabled")
      .html(
        '<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span class="sr-only">Loading...</span>'
      );
    var formData = new FormData();
    formData.append("email", email);
    formData.append("password", password);

    axios
      .post("/api/user/login/", formData)
      .then(response => {
        console.log(response);
        return response;
      })
      .then(json => {
        if (json.data.success) {
          alert("Login Successful!");
          const { name, id, email, auth_token } = json.data.data;

          let userData = {
            name,
            id,
            email,
            auth_token,
            timestamp: new Date().toString()
          };
          let appState = {
            isLoggedIn: true,
            user: userData
          };
          // save app state with user date in local storage
          localStorage["appState"] = JSON.stringify(appState);
          this.setState({
            isLoggedIn: appState.isLoggedIn,
            user: appState.user
          });
        } else alert("Login Failed!");

        $("#login-form button")
          .removeAttr("disabled")
          .html("Login");
      })
      .catch(error => {
        alert(`An Error Occured! ${error}`);
        $("#login-form button")
          .removeAttr("disabled")
          .html("Login");
      });
  };

  _registerUser(name, email, password){
    $("#email-login-btn")
      .attr("disabled", "disabled")
      .html(
        '<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span class="sr-only">Loading...</span>'
      );

    var formData = new FormData();
    formData.append("type", "email");
    formData.append("username", "usernameee");
    formData.append("password", password);
    formData.append("phone", 33322212231);
    formData.append("email", email);
    formData.append("address", "address okoko");
    formData.append("name", name);
    formData.append("id", 76);

    //my addition
    formData.append("role_id", 1);


    axios
      .post("/api/user/register", formData)
      .then(response => {
        console.log(response);
        return response;
      })
      .then(json => {
        if (json.data.success) {
          alert(`Registration Successful!`);
          const { name, id, email, auth_token } = json.data.data;
          let userData = {
            name,
            id,
            email,
            auth_token,
            timestamp: new Date().toString()
          };
          let appState = {
            isLoggedIn: true,
            user: userData
          };
          // save app state with user date in local storage
          localStorage["appState"] = JSON.stringify(appState);
          this.setState({
            isLoggedIn: appState.isLoggedIn,
            user: appState.user
          });
          // redirect home
          //this.props.history.push("/");
        } else {
          alert(`Registration Failed!`);
          $("#email-login-btn")
            .removeAttr("disabled")
            .html("Register");
        }
      })
      .catch(error => {
        alert("An Error Occured!" + error);
        console.log(`${formData} ${error}`);
        $("#email-login-btn")
          .removeAttr("disabled")
          .html("Register");
      });
  };

  _logoutUser(){
    let appState = {
      isLoggedIn: false,
      user: {}
    };
    // save app state with user date in local storage
    localStorage["appState"] = JSON.stringify(appState);
    this.setState(appState);
  };

  componentDidMount() {
    // console.log("component did mount");
    let state = localStorage["appState"];
    if (state) {
      let AppState = JSON.parse(state);
      console.log(AppState);
      this.setState({ isLoggedIn: AppState.isLoggedIn, user: AppState });
    }
  }

  render() {
    // console.log(this.state.isLoggedIn);
    console.log("path name: " + this.props.location.pathname);
    if (
      !this.state.isLoggedIn &&
      this.props.location.pathname !== "/login" &&
      this.props.location.pathname !== "/register"
    ) {
      console.log(
        "you are not loggedin and are not visiting login or register, so go to login page"
      );
      // this.props.history.push("/user");
    }
    if (
      this.state.isLoggedIn &&
      (this.props.location.pathname === "/login" ||
        this.props.location.pathname === "/register")
    ) {
      console.log(
        "you are either going to login or register but youre logged in"
      );

      this.props.history.push("/");
    }
    return (
      <Switch data="data">
        <div id="main">
          {/* <Route
            exact
            path="/"
            // render={props => (
            //   <User
            //     {...props}
            //     logoutUser={this._logoutUser}
            //     user={this.state.user}
            //   />
            // )}
          ><Redirect from="/" to="/user/home" /></Route> */}
          <Route exact path="/" render={() => <Redirect to="/user/home" />} />

          <Route
            path="/login"
            render={props => <Login {...props} loginUser={this._loginUser} />}
          />

          <Route
            path="/register"
            render={props => (
              <Register {...props} registerUser={this._registerUser} />
            )}
          />

          <Route path="/admin" render={props => <AdminLayout {...props} />} />
          <Route path="/user" render={props => <User {...props } logoutUser={this._logoutUser}
                user={this.state.user} loginUser={this._loginUser} />} />
          {/* <Redirect from="/" to="/user/home" /> */}
        </div>
      </Switch>
    );
  }
}


const AppContainer = withRouter(props => <App {...props} />);
// console.log(store.getState())
ReactDOM.render(
  <ProductProvider>
  <BrowserRouter>
    <AppContainer />
  </BrowserRouter>
  </ProductProvider>,

  document.getElementById("app")
);




// ReactDOM.render(
//   <ProductProvider>
//   <BrowserRouter>
//     <Switch>
//       <Route path="/admin" render={props => <AdminLayout {...props} />} />
//       <Route path="/user" render={props => <User {...props} />} />

//       <Redirect from="/" to="/admin/dashboard" />
//     </Switch>
//   </BrowserRouter>
//   </ProductProvider>,
//   document.getElementById("app")
// );
