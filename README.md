# ShopFunnels

This app creates custom cart code specific to clickfunnels, and the cart shows products from a shopify store.

When an order is placed on clickfunnels, a webhook is sent to the app and it processes the items ordered into a shopify order (via api).

There is a backend dashboard that is protected with a login.

The first step is you are prompted for a store name.  The user enters a storename (storename.myshopify.com is the format to find your store name).

The app then looks up the store name, and sees if there is an entry in its DB.
