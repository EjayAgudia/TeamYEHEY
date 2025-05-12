## Creators

This project was proudly developed by:

- **Agudia, Ejay**
- **Foronda, Emmanuel**
- **Andres, Paul Raynee**
- **Ocampo, Dwayne**
- **Oboob, Christian**

---
# Shoplift E-Commerce Website

## Overview

**Shoplift** is a responsive, user-friendly e-commerce web application designed to showcase and sell premium products such as watches, clothing, shoes, and headphones. The project is built using PHP, MySQL, Bootstrap, and JavaScript, offering users a smooth shopping experience with features like user authentication, product browsing, and cart management.

---

## Features

- 🛒 **Product Catalog**: Browse a variety of premium products with detailed images and pricing.
- 🔐 **User Authentication**: Secure login and signup functionality with error handling and modals.
- 🛍️ **Add to Cart**: Users can add products to their cart and manage their orders.
- 🎨 **Responsive Design**: Built with Bootstrap for mobile and desktop compatibility.
- 💬 **Error Handling**: Friendly modals and alerts for login/signup errors.
- 🖼️ **Dynamic Categories**: Interactive sections for Watches, Clothing, Shoes, and Headphones.
- ⚙️ **Admin Panel (phpMyAdmin)**: Manage products and pricing directly via the database.

---

## Technologies Used

- **Frontend**:  
  - HTML5, CSS3, Bootstrap 4  
  - Font Awesome, Google Fonts  
  - JavaScript & jQuery

- **Backend**:  
  - PHP  
  - MySQL (phpMyAdmin)

- **Design Enhancements**:  
  - Custom CSS for hover effects and UI polish  
  - Modals for error handling and login alerts

---

## How to Run

1. Clone the repository to your server's directory.
2. Set up the database using phpMyAdmin:
   - Import the SQL file provided to create the necessary tables and data.
3. Update your `db_connect.php` file with your database credentials.
4. Run the application through your local server (XAMPP, WAMP, etc.).
5. Explore the site and enjoy shopping!

---

## Creators

This project was proudly developed by:

- **Agudia, Ejay**
- **Foronda, Emmanuel**
- **Andres, Paul Raynee**
- **Ocampo, Dwayne**
- **Oboob, Christian**

---

## License

This project is for educational purposes only. No commercial use intended.

## Admin Panel Instructions

### Accessing the Admin Panel
1. Navigate to `http://localhost/Shoplift/admin_login.php`
2. Login using your admin credentials:
   - Email: admin@shoplift.com
   - Password: admin123

### Admin Features

#### 1. Product Management
- **View Products**
  - Access all products in the system
  - View product details including name, price, category, and image

- **Add New Product**
  - Click "Add Product" button
  - Fill in the required fields:
    - Product Name
    - Price (in PHP)
    - Category (Watches, Clothing, Shoes, Headphones)
    - Product Image (upload from your computer)
    - Description (optional)
  - Click "Add" to save the new product

- **Edit Product**
  - Find the product you want to edit
  - Click the "Edit" button
  - Modify any of the following:
    - Product Name
    - Price
    - Category
    - Image
    - Description
  - Click "Save Changes" to update

- **Delete Product**
  - Find the product you want to remove
  - Click the "Delete" button
  - Confirm deletion when prompted

#### 2. Order Management
- **View Orders**
  - Access all customer orders
  - View order details including:
    - Order ID
    - Customer Information
    - Products Ordered
    - Total Amount
    - Order Status

- **Update Order Status**
  - Find the order you want to update
  - Click "Update Status"
  - Select new status:
    - Pending
    - Processing
    - Shipped
    - Delivered
    - Cancelled
  - Click "Update" to save changes

#### 3. User Management
- **View Users**
  - Access all registered users
  - View user details including:
    - Name
    - Email
    - Registration Date
    - Account Status

- **Manage User Roles**
  - Find the user you want to modify
  - Click "Edit Role"
  - Select role:
    - User (regular customer)
    - Admin (administrator access)
  - Click "Update" to save changes

### Security Guidelines
1. **Password Management**
   - Change your admin password regularly
   - Use strong passwords (combination of letters, numbers, and special characters)
   - Never share your admin credentials

2. **Session Management**
   - Always log out after completing admin tasks
   - Don't leave the admin panel unattended
   - Clear browser cache regularly

3. **Data Protection**
   - Regularly backup the database
   - Keep product images organized
   - Monitor for suspicious activities

### Troubleshooting
1. **Login Issues**
   - Ensure you're using the correct email and password
   - Check if your account is active
   - Clear browser cache and cookies if needed

2. **Product Management Issues**
   - Verify image file size (max 2MB)
   - Ensure all required fields are filled
   - Check file permissions for image uploads

3. **Order Management Issues**
   - Verify order status updates are saved
   - Check customer contact information
   - Ensure order totals are correct

### Support
For technical support or questions about the admin panel, please contact:
- Email: support@shoplift.com
- Phone: (123) 456-7890

### System Requirements
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Modern web browser (Chrome, Firefox, Safari, Edge)
- Minimum screen resolution: 1024x768

### Regular Maintenance
1. **Daily Tasks**
   - Check for new orders
   - Update order statuses
   - Monitor user registrations

2. **Weekly Tasks**
   - Review product inventory
   - Update product information
   - Check system logs

3. **Monthly Tasks**
   - Backup database
   - Review user accounts
   - Update admin passwords
