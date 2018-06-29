# ShopFunnels

This app creates custom cart code specific to clickfunnels, and the cart shows products from a shopify store.

When an order is placed on clickfunnels, a webhook is sent to the app and it processes the items ordered into a shopify order (via api).

There is a backend dashboard that is protected with a login.

The first step is you are prompted for a store name.  The user enters a storename (storename.myshopify.com is the format to find your store name).

The app then looks up the store name, and sees if there is an entry in its DB.

IF store DOES EXIST, and has granted permissions:
GOTO APP DASHBOARD

IF store DOESN'T EXIST:

Redirect to shopify login for THAT STORE

User then logs in using their shopify store credentials.

They are then prompted with an OAuth permissions screen.

Permissions Asked for are:


After user clicks allow, they are redirected to the app dashboard.


APP DASHBOARD:
On the app dashboard, the user can see already created product forms, or create a new product form.

The other navigation options are:
-Orders <- This shows orders received from Shopify, and their status of being sent to shopify as an order

-Products <- All Products From Shopify Store Displayed (Or Only Products Added from a Dynamic Form?)

-Webhook Logs <- Shows 
