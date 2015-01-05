keawebshop
==========
- Required PHP 5.5  
- localhost root, or vhost set to a fake domain  
- swiftmailer (run composer install in api dir)
- github url: https://github.com/gebidesign/keawebshop  

----------
Specs
----------

as a **user** I can:
+ sign up
+ get a welcome/password confirmation email
+ login
- logout
- remember me

as an **admin** I can:
- add a product
- see a list of all products
- edit a product
- delete a product
- see a list of all orders
- see a list of partners

as a **partner** I can:
- add a sub-shop by adding a link to my webshop's api
- delete my sub-shop

as a customer I can:
- purchase a product



----------
- when partner uploads link to his json, parse and add all products to db
- activate account
- swift mailer setup
- user dropdown
