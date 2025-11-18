# Aunt Joy Restaurant – Developer Guide

## Controllers, Views, and Routes

Routing format:

- URL: `index.php?r=module/controller/action`
- Module: `customer`, `admin`, `sales`, `manager`
- Controller class: `Module\\Controllers\\NameController`
- Action method: `actionXxx`

### Example: Customer home page

1. Controller: `customer/controllers/HomeController.php`

   ```php path=null start=null
   <?php

   namespace Customer\Controllers;

   use Core\Components\Controller;

   class HomeController extends Controller
   {
       public function actionIndex(): void
       {
           $this->render('customer/views/home/index.php', [
               'title' => 'Welcome to Aunt Joy Restaurant',
           ]);
       }
   }
   ```

2. View: `customer/views/home/index.php`

   ```php path=null start=null
   <?php /** @var string $title */ ?>
   <h2><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h2>
   <p>This is the customer home page.</p>
   ```

3. URL:

- `http://localhost/AuntJoyRestaurant/index.php?r=customer/home/index`

### Layouts

- Customer: uses default `layout_main.php`.
- Admin: set `$this->layout = 'layout_admin.php';` in your controller.
- Sales: set `$this->layout = 'layout_sales.php';`.
- Manager: set `$this->layout = 'layout_manager.php';`.

### Access control (RBAC)

Use `Core\\Rbac\\AccessControl::requireRole([...])` at the start of actions that should be protected.

Example (admin-only action):

```php path=null start=null
<?php

namespace Admin\Controllers;

use Core\Components\Controller;
use Core\Rbac\AccessControl;

class DashboardController extends Controller
{
    public function actionIndex(): void
    {
        AccessControl::requireRole(['admin']);

        $this->layout = 'layout_admin.php';

        $this->render('admin/views/dashboard.php', [
            'title' => 'Admin Dashboard',
        ]);
    }
}
```
