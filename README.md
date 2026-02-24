## Task 2: Inventory Management System
### Features
- Product management with purchase/selling prices
- Sales transaction with VAT (5%) calculation
- Automatic stock updates
- Inventory logging
- Date-wise financial reports
- Accounting journal entries

### Business Scenario Implemented
- Purchase Price: 100 TK
- Sell Price: 200 TK
- Opening Stock: 50 units
- Sale: 10 units
- Discount: 50 TK
- VAT: 5%
- Payment: 1000 TK (rest due)

### Setup Instructions
1. Clone repository
2. Run `composer install`
3. Configure database in `.env`
4. Run `php artisan migrate`
5. Run `php artisan serve`
6. Access at `http://localhost:8000`

### Testing Steps
1. Create a product with given data
2. Make a sale with specified parameters
3. Check stock updates
4. View financial reports with date filter

## Live Demo Links
- Task 2 (Inventory): [https://www.youtube.com/watch?v=oAzxzF9-f0E]

## Credentials
- Email: info@zavisoft.com
- Password: zavisoft

## Technology Stack
- Laravel 10.x
- MySQL
- Bootstrap 5
- Laravel Sanctum
