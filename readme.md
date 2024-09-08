# Project Guide

## Start by Installing PHP

### For macOS
1. Open **Terminal** and run:
    ```bash
    brew install php
    ```

### For Linux (Ubuntu/Debian-based Systems)
1. Update the package list:
    ```bash
    sudo apt update
    ```
2. Install PHP:
    ```bash
    sudo apt install php
    ```

### For Linux (Fedora/CentOS/RHEL-based Systems)
1. Update the package list:
    ```bash
    sudo dnf update
    ```
2. Install PHP:
    ```bash
    sudo dnf install php
    ```

### For Windows
1. **Download PHP:**
    - Visit: [PHP Downloads](https://www.php.net/downloads)
    - Choose the appropriate version (32-bit/64-bit, thread-safe/non-thread-safe).
    - Download the `.zip` file.

2. **Extract PHP:**
    - Extract the downloaded `.zip` file to a folder (e.g., `C:\php`).

3. **Add PHP to the System PATH:**
    - Open the **Start Menu**, search for "Environment Variables", and open **Edit the system environment variables**.
    - In the **System Properties** window, click **Environment Variables**.
    - In the **System variables** section, find **Path**, and click **Edit**.
    - Click **New**, and add the path to your PHP folder (e.g., `C:\php`).
    - Click **OK** to save changes.

---

## To Verify PHP Installation

Run the following command in **Terminal** or **Command Prompt**:
```bash
php -v
```
---

## To Start Project Server

Run the following command in **Terminal** or **Command Prompt**:
```bash
php -S localhost:8000
