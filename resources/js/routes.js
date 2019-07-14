import Dashboard from "./views/Dashboard.jsx";
import UserProfile from "./views/UserProfile.jsx";
import TableList from "./views/TableList.jsx";
import ProductList from "./views/ProductList.jsx";
import InventoryList from "./views/InventoryList.jsx";

import BrandList from "./views/BrandList.jsx";
import EventCategories from "./views/EventCategories.jsx";
import ProductCategories from "./views/ProductCategories.jsx";
import Typography from "./views/Typography.jsx";
import Icons from "./views/Icons.jsx";
import Maps from "./views/Maps.jsx";
import Notifications from "./views/Notifications.jsx";
import Upgrade from "./views/Upgrade.jsx";

import Product from "./views/Product.jsx";
import ProductCreate from "./views/ProductCreate.jsx";
import ImageUpload from "./views/ImageUpload.jsx";
import BrandCreate from "./views/BrandCreate.jsx";
import Brand from "./views/Brand.jsx";
import EventCategory from "./views/EventCategory.jsx";
import EventCategoryCreate from "./views/EventCategoryCreate.jsx";
import ProductCategory from "./views/ProductCategory.jsx";
import ProductCategoryCreate from "./views/ProductCategoryCreate.jsx";
import Inventory from "./views/Inventory.jsx";
import InventoryCreate from "./views/InventoryCreate.jsx";


import UserHome from "./views/UserHome.jsx";
import UserCart from "./views/UserCart.jsx";
import UserProductDetails from "./views/UserProductDetails.jsx";


const dashboardRoutes = [
  {
    path: "/dashboard",
    name: "Dashboard",
    icon: "pe-7s-graph",
    component: Dashboard,
    layout: "/admin"
  },
  // {
  //   path: "/user",
  //   name: "User Profile",
  //   icon: "pe-7s-user",
  //   component: UserProfile,
  //   layout: "/admin"
  // },
  // {
  //   path: "/table",
  //   name: "Table List",
  //   icon: "pe-7s-note2",
  //   component: TableList,
  //   layout: "/admin"
  // },
  {
    path: "/products",
    name: "Products",
    icon: "pe-7s-note2",
    component: ProductList,
    layout: "/admin"
  },
  {
    path: "/inventory",
    name: "Inventory",
    icon: "pe-7s-note2",
    component: InventoryList,
    layout: "/admin"
  },
  {
    path: "/brands",
    name: "Brands",
    icon: "pe-7s-note2",
    component: BrandList,
    layout: "/admin"
  },
  {
    path: "/eventcategories",
    name: "Event Categories",
    icon: "pe-7s-note2",
    component: EventCategories,
    layout: "/admin"
  },
  {
    path: "/productcategories",
    name: "Product Categories",
    icon: "pe-7s-note2",
    component: ProductCategories,
    layout: "/admin"
  },

  {
    path: "/product/create",
    component: ProductCreate,
    layout: "/admin",
    invisible: true
  },
  {
    path: "/product/:id",
    component: Product,
    layout: "/admin",
    invisible: true
  },

  {
    path: "/image",
    component: ImageUpload,
    layout: "/admin",
    invisible: true
  },

  {
    path: "/brand/create",
    component: BrandCreate,
    layout: "/admin",
    invisible: true
  },

  {
    path: "/brand/:id",
    component: Brand,
    layout: "/admin",
    invisible: true
  },

  {
    path: "/eventcategory/create",
    component: EventCategoryCreate,
    layout: "/admin",
    invisible: true
  },

  {
    path: "/productcategory/create",
    component: ProductCategoryCreate,
    layout: "/admin",
    invisible: true
  },

  {
    path: "/eventcategory/:id",
    component: EventCategory,
    layout: "/admin",
    invisible: true
  },

  {
    path: "/productcategory/:id",
    component: ProductCategory,
    layout: "/admin",
    invisible: true
  },

  {
    path: "/item/create",
    component: InventoryCreate,
    layout: "/admin",
    invisible: true
  },

  {
    path: "/item/:id",
    component: Inventory,
    layout: "/admin",
    invisible: true
  },

  

  {
    path: "/home",
    name: "Home",
    icon: "pe-7s-home",
    component: UserHome,
    layout: "/user"
  },

  {
    path: "/cart",
    name: "Cart",
    icon: "pe-7s-cart",
    component: UserCart,
    layout: "/user"
  },

  {
    path: "/item/:id",
    name: "Product Details",
    icon: "pe-7s-cart",
    component: UserProductDetails,
    layout: "/user",
    invisible:true
  },
  // {
  //   path: "/typography",
  //   name: "Typography",
  //   icon: "pe-7s-news-paper",
  //   component: Typography,
  //   layout: "/admin"
  // },
  {
    path: "/icons",
    name: "Icons",
    icon: "pe-7s-science",
    component: Icons,
    layout: "/admin",
    invisible: true
  }
  // {
  //   path: "/maps",
  //   name: "Maps",
  //   icon: "pe-7s-map-marker",
  //   component: Maps,
  //   layout: "/admin"
  // },
  // {
  //   path: "/notifications",
  //   name: "Notifications",
  //   icon: "pe-7s-bell",
  //   component: Notifications,
  //   layout: "/admin"
  // }
  
  // {
  //   upgrade: true,
  //   path: "/upgrade",
  //   name: "Upgrade to PRO",
  //   icon: "pe-7s-rocket",
  //   component: Upgrade,
  //   layout: "/admin"
  // }
];

export default dashboardRoutes;
