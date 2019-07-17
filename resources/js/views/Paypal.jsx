import React from 'react';
import PaypalExpressBtn from 'react-paypal-express-checkout';

import axios from 'axios';

export default class MyApp extends React.Component {
    render() {
		const onSuccess = (payment) => {
			// 1, 2, and ... Poof! You made it, everything's fine and dandy!
					console.log("Payment successful!", payment);

					let address = `${payment.address.line1}, ${payment.address.city}, ${payment.address.state}.`;
					let postal = payment.address.postal_code;
					let total = this.props.total;
					let cart = JSON.parse(localStorage['cart']);
					let user = JSON.parse(localStorage['appState']);
					user = user.user.id;

					let inventories = cart.map(item=>{
						return {id: item.id, count: item.count, total: item.total};
					});
					
					let order = {
						address: address,
						postal: postal,
						total: total,
						user: user,
						inventories: inventories
					};

					console.log(order);

					axios.post(`/api/orders/`, order)
						.then(response=>{
							console.log(response);
							this.props.clearCart();
		                    this.props.history.push('/user/orders');
						});

                    // this.props.clearCart();
                    // this.props.history.push('/user/home');
            		// You can bind the "payment" object's value to your state or props or whatever here, please see below for sample returned data
		}

		const onCancel = (data) => {
			// The user pressed "cancel" or closed the PayPal popup
			console.log('Payment cancelled!', data);
			// You can bind the "data" object's value to your state or props or whatever here, please see below for sample returned data
		}

		const onError = (err) => {
			// The main Paypal script could not be loaded or something blocked the script from loading
			console.log("Error!", err);
			// Because the Paypal's main script is loaded asynchronously from "https://www.paypalobjects.com/api/checkout.js"
			// => sometimes it may take about 0.5 second for everything to get set, or for the button to appear
		}

		let env = 'sandbox'; // you can set this string to 'production'
		let currency = 'USD'; // you can set this string from your props or state  
		let total = 1;  // this is the total amount (based on currency) to charge
		// Document on Paypal's currency code: https://developer.paypal.com/docs/classic/api/currency_codes/

		const client = {
			sandbox:    'AdC2ftNXL0smuqWhyeEhbqDF_kvpVWIL0M4c871wtWC9RcFKfFPkY0-SFrIEv-kMLIJb-hZBK5LuCtId',
			production: 'YOUR-PRODUCTION-APP-ID',
		}
		// In order to get production's app-ID, you will have to send your app to Paypal for approval first
		// For your sandbox Client-ID (after logging into your developer account, please locate the "REST API apps" section, click "Create App" unless you have already done so):
		//   => https://developer.paypal.com/docs/classic/lifecycle/sb_credentials/
		// Note: IGNORE the Sandbox test AppID - this is ONLY for Adaptive APIs, NOT REST APIs)
		// For production app-ID:
		//   => https://developer.paypal.com/docs/classic/lifecycle/goingLive/

		// NB. You can also have many Paypal express checkout buttons on page, just pass in the correct amount and they will work!
        return (
            <PaypalExpressBtn env={env} client={client} currency={currency} total={this.props.total} onError={onError} onSuccess={onSuccess} onCancel={onCancel} />
        );
    }
}