# Sales, Inventory & CRM System

This is a comprehensive business application built with **Laravel** and **Tailwind CSS**. It was developed as part of a technical assessment to demonstrate clean architecture, robust database design, and the implementation of core business logic.

## 🚀 Features

### 1. Sales & Inventory Management
* **Product Management:** Full CRUD interface for a product catalog, tracking names, SKUs, prices, and available stock quantities.
* **Inventory Control:** Secure, transaction-based sales recording. Stock is automatically deducted upon a successful sale, and validation prevents sales if stock is insufficient.

### 2. Customer Relationship Management (CRM)
* **Purchase History:** Administrators and assigned employees can view detailed, itemized purchase histories for every customer, along with their lifetime value and total purchase count.
* **Lost Customer Detection:** A dedicated portal automatically flags "lost" customers who haven't made a purchase in over 90 days.
* **Employee Assignment:** Administrators can assign these lost customers to specific sales employees for targeted follow-up.
* **Customer Re-engagement:** A one-click promotion system allows sending beautifully crafted HTML discount emails to inactive customers to win them back.
* **KPI Tracking:** If an assigned lost customer makes a new purchase, the system automatically increments the assigned employee's KPI score.

### 3. Bonus Features Implemented
* **Email Invoices:** Upon a successful purchase, a professionally formatted HTML invoice is automatically emailed to the customer.
* **E-Commerce REST API:** A secure, Sanctum-protected API endpoint (`/api/v1/products`) exposes the product catalog (SKU, Name, Price, Available Stock) for third-party integrations.

---

## 🏗️ Architectural Decisions

* **Design Pattern:** The core sales logic is abstracted into a dedicated `SaleService`. This keeps the controllers thin and ensures that the complex transaction (creating the sale, generating sale items, deducting stock, updating KPIs, and firing emails) is completely atomic and reusable.
* **Role-Based Portals:** The application features two completely separate, restricted portals for `admin` and `employee` roles, ensuring secure access to data.
---

## ⚙️ Setup Instructions

Follow these steps to get the application running locally.

### Prerequisites
* PHP 8.2+
* Composer
* Node.js & NPM
* MySQL Database

### 1. Clone & Install
```bash
git clone <your-repo-url>
cd sales-crm-system
composer install
npm install
```

### 2. Environment Configuration
Copy the `.env.example` file to create your local `.env`:
```bash
cp .env.example .env
php artisan key:generate
```

Configure your **Database** credentials in the `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

Configure your **Mailtrap** credentials in the `.env` file for email testing (Invoices and Promotions):
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="Sales CRM"
```

### 3. Database Migration & Seeding
The application comes with highly realistic seed data (Products, Customers, Users, and a mix of active/lost Sales) so you can test it immediately.

```bash
php artisan migrate:fresh --seed
```

### 4. Build Assets & Run
Compile the Tailwind CSS assets and start the local development server:

```bash
npm run dev
php artisan serve
```

---

## 🧪 Testing the Application

Once the application is running and seeded, you can log in using the following test credentials:

**Administrator Account:**
* **Email:** admin@example.com
* **Password:** 12345678

**Employee Account:**
* **Email:** employee@example.com
* **Password:** 12345678

*(Note: The `DatabaseSeeder` also generates 5 additional employee accounts you can find in the database).*
