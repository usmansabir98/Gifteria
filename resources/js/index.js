import React from "react";
import ReactDOM from "react-dom";

import { BrowserRouter, Route, Switch, Redirect } from "react-router-dom";

import "bootstrap/dist/css/bootstrap.min.css";
import "./assets/css/animate.min.css";
import "./assets/sass/light-bootstrap-dashboard-react.scss?v=1.3.0";
import "./assets/css/demo.css";
import "./assets/css/pe-icon-7-stroke.css";

import AdminLayout from "./layouts/Admin.jsx";
import User from "./layouts/User.jsx";
import {ProductProvider} from "./context";

import Product from "./views/Product.jsx";


ReactDOM.render(
  <ProductProvider>
  <BrowserRouter>
    <Switch>
      <Route path="/admin" render={props => <AdminLayout {...props} />} />
      <Route path="/user" render={props => <User {...props} />} />

      <Redirect from="/" to="/admin/dashboard" />
    </Switch>
  </BrowserRouter>
  </ProductProvider>,
  document.getElementById("app")
);
