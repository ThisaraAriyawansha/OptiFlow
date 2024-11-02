# OptiFlow

**OptiFlow** is an efficient and scalable ERP system powered by PHP and MySQL, designed to streamline business processes and improve operational efficiency.



## Features
- User-friendly interface for easy navigation
- Comprehensive modules for managing various business processes
- Customizable settings to fit your business needs
- Secure authentication and authorization system

## Prerequisites
Before you begin, ensure you have the following installed:
- [XAMPP](https://www.apachefriends.org/index.html)
- Web Browser (e.g., Chrome, Firefox)

## Installation
1. **Download the Source Code**
   - Clone the repository or download the latest release from GitHub.

   ```bash
   git clone https://github.com/ThisaraAriyawansha/OptiFlow.git
   ```

2. **Install XAMPP**
   - Download and install XAMPP from [Apache Friends](https://www.apachefriends.org/index.html).

3. **Start XAMPP**
   - Launch the XAMPP Control Panel and start the Apache and MySQL services.

4. **Setup Database**
   - Open your web browser and navigate to `http://localhost/phpmyadmin`.
   - Create a new database named `optiflow_db`.
   - Import the SQL file located in the Database folder (`optiflow.sql`):
     - Click on your newly created database.
     - Go to the **Import** tab.
     - Click on **Choose File** and select the `optiflow.sql` file.
     - Click on **Go** to import the database schema and data.

5. **Configure Database Connection**
   - Open the configuration file  and set the database connection parameters:

   ```php
   $dbHost = 'localhost';
   $dbUser = 'root'; // Your MySQL username
   $dbPass = ''; // Your MySQL password (if any)
   $dbName = 'optiflow';
   ```

6. **Access the Application**
   - Open your web browser and go to `http://localhost/OptiFlow/optiFlow` to start using the ERP system.


