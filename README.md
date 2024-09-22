### Prerequisites:
1. **XAMPP, WAMP, or MAMP** installed for a local PHP development environment.
2. **MySQL** (usually bundled with XAMPP, WAMP, or MAMP).
3. **PHP** version as required by the project.
4. A text editor (such as VSCode) to edit configuration files.

### Installation Steps:

1. **Download and Install XAMPP/WAMP:**
   - Download and install [XAMPP](https://www.apachefriends.org/index.html) or [WAMP](http://www.wampserver.com/en/) if you don't have one installed.
   - Ensure both **Apache** and **MySQL** services are running in XAMPP/WAMP.

2. **Move Project to Local Server Directory:**
   - After extracting the project files, move the project folder (`STUDENT_MANAGER` or a custom name you prefer) to the `htdocs` folder for **XAMPP** or the `www` folder for **WAMP**:
     - **For XAMPP:** `C:\xampp\htdocs\`
     - **For WAMP:** `C:\wamp64\www\`

3. **Create a MySQL Database:**
   - Open **phpMyAdmin** by going to `http://localhost/phpmyadmin/`.
   - Create a new database (for example, `student_manager_db`).
   - Inside `phpMyAdmin`, click on the **Import** tab and import the SQL file (if available) from your project to set up the necessary database schema and tables.

4. **Configure Database Connection (db.php):**
   - Open the `config/db.php` file in your project.
   - Ensure the database connection details are correct:
     ```php
     <?php
     $host = 'localhost';
     $username = 'root'; // default MySQL username
     $password = ''; // leave blank for XAMPP, WAMP default
     $dbname = 'student_manager_db'; // your database name
     
     // Create connection
     $conn = new mysqli($host, $username, $password, $dbname);

     // Check connection
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
     ?>
     ```

5. **Configure `index.php`:**
   - Ensure that the base URL is set properly in the project files if required (usually, no additional configuration for base URL is needed in core PHP).

6. **Run the Project:**
   - Open your browser and navigate to `http://localhost/STUDENT_MANAGER/` (replace `STUDENT_MANAGER` with your project folder name).
   - This should load the login or main page of your application.

7. **Test the Application:**
   - Register a new user or log in if an admin user exists in the database.
   - Navigate through the features (add student, delete, export, etc.) to ensure everything works properly.

### Optional - Fixing File Permissions (Linux/Mac):
If you're on Linux/Mac, ensure the project folder has proper permissions. Run the following commands in your terminal:
```bash
sudo chmod -R 755 /path/to/your/project/
sudo chown -R www-data:www-data /path/to/your/project/
