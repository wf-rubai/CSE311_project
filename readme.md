═══════════════════════════════════════════════════════════════════════
*-- Start by Installing PHP --*

    Install PHP
    │
    ├── For macOS: 
    │   └── Open Terminal and run:
    │       └── brew install php
    │
    ├── For Linux (Ubuntu/Debian-based Systems):
    │   ├── Step 1: Update the package list:
    │   │   └── sudo apt update
    │   └── Step 2: Install PHP:
    │       └── sudo apt install php
    │
    ├── For Linux (Fedora/CentOS/RHEL-based Systems):
    │   ├── Step 1: Update the package list:
    │   │   └── sudo dnf update
    │   └── Step 2: Install PHP:
    │       └── sudo dnf install php
    │
    └── For Windows:
        ├── Step 1: Download PHP:
        │   ├── Visit: https://www.php.net/downloads
        │   ├── Choose the appropriate version (32-bit/64-bit, thread-safe/non-thread-safe).
        │   └── Download the `.zip` file.
        │
        ├── Step 2: Extract PHP:
        │   └── Extract the downloaded `.zip` file to a folder (e.g., `C:\php`).
        │
        └── Step 3: Add PHP to the System PATH:
            ├── Open the **Start Menu**, search for "Environment Variables", and open **Edit 
            │   the system environment variables**.
            ├── In the **System Properties** window, click **Environment Variables**.
            ├── In the **System variables** section, find **Path**, and click **Edit**.
            ├── Click **New**, and add the path to your PHP folder (e.g., `C:\php`).
            └── Click **OK** to save changes.

═══════════════════════════════════════════════════════════════════════
*-- To Verify PHP Installation --*
   Run the following command in **Terminal** or **Command Prompt**:
   
   `php -v`

═══════════════════════════════════════════════════════════════════════
*-- To Start PHP Server --*
   Run this command in **Terminal** or **Command Prompt** to start a PHP server locally:
   
   `php -S localhost:8000`

═══════════════════════════════════════════════════════════════════════