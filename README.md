# Aunt Joy Restaurant Web App

This project is a group assignment for a web-based food ordering platform for Aunt Joy Restaurant.

## Modules and Members

See `doc/project_structure_and_responsibilities.md` for the full folder structure and who owns which module.

- Member 1 – Customer module (`customer/`)
- Member 2 – Admin module (`admin/`)
- Member 3 – Sales module (`sales/`)
- Member 4 – Manager module (`manager/`)
- Member 5 – Core & Infrastructure (`core/`, `models/`, `database/`)

## How to Clone and Work on Your Part

1. **Clone the repository**

   ```bash
   cd <your-web-root>   # e.g. C:\xampp\htdocs
   git clone https://github.com/M8Sh3ck01/AuntJoyRestaurant.git
   cd AuntJoyRestaurant
   git checkout main
   ```

2. **Create a feature branch for your module**

   Use one of the following (depending on your role):

   ```bash
   # Customer module
   git checkout -b feature/customer-module

   # Admin module
   git checkout -b feature/admin-module

   # Sales module
   git checkout -b feature/sales-module

   # Manager module
   git checkout -b feature/manager-module

   # Core & Infrastructure
   git checkout -b feature/core-infra
   ```

3. **Work only in your module folders**

- Customer: `customer/controllers`, `customer/views`, `customer/components`
- Admin: `admin/controllers`, `admin/views`, `admin/components`
- Sales: `sales/controllers`, `sales/views`, `sales/components`
- Manager: `manager/controllers`, `manager/views`, `manager/components`
- Core & Infrastructure: `core/components`, `core/db`, `core/rbac`, `core/templates`, `models`, `database`

4. **Commit and push your changes**

   ```bash
   git add .
   git commit -m "Implement <short description>"
   git push -u origin feature/<your-module-branch>
   ```

5. **Open a Pull Request (PR)**

- Go to the GitHub repository page.
- Click **"Compare & pull request"** for your branch.
- Target branch: `main`.
- Describe what you implemented and which files you changed.
- Ask teammates to review and then merge when ready.

6. **Keep your branch updated with `main`**

   ```bash
   git fetch origin
   git checkout main
   git pull origin main
   git checkout feature/<your-module-branch>
   git merge main
   # resolve any conflicts if needed, then
   git add .
   git commit -m "Merge main into feature/<your-module-branch>"
   ```

## Running the Project Locally

1. Install XAMPP (or similar) and start Apache.
2. Ensure this project is under your web root (e.g. `C:\xampp\htdocs\AuntJoyRestaurant`).
3. Open your browser and visit:

   - `http://localhost/AuntJoyRestaurant/`

As modules are implemented and routing is added, you will navigate to URLs like:

- `/customer/...`
- `/admin/...`
- `/sales/...`
- `/manager/...`

