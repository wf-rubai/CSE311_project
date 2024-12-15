# Advising Assistant

## Project Description

The **Advising Assistant** project is an academic planning platform designed for university students. It simplifies the advising process by providing tools to manage personal profiles, generate optimized schedules, and explore faculty reviews. The platform ensures an efficient and user-friendly experience for academic management.

### Key Features

- **User Authentication**  
  Secure login and registration system to access personalized profiles.
  
- **Profile Management**  
  Manage university information and update editable fields like name and profile picture.
  
- **Routine Generation**  
  Generate schedules based on preferred courses, credit limits, and desired days of the week.
  
- **Detailed Routine View**  
  View weekly schedules with class times. Clicking on a class cell opens a popup with course details and available sections for that time slot.
  
- **Custom Routine Creation**  
  Design and save custom schedules according to personal preferences.
  
- **Faculty Reviews**  
  View faculty ratings and submit feedback to help other students make informed decisions.
  
- **Responsive Design**  
  Ensures the platform adapts seamlessly to both desktop and mobile devices.

### Technologies Used

- **Frontend**: HTML and Extreme JS for dynamic user interfaces.  
- **Backend**: PHP to handle authentication, routine logic, and faculty review functionalities.  
- **Database**: MySQL for securely storing user profiles, course data, and reviews.  

---

## Installation Guide

### Install PHP

#### For macOS
1. Open **Terminal** and run:
    ```bash
    brew install php
    ```

#### For Linux (Ubuntu/Debian-based Systems)
1. Update the package list:
    ```bash
    sudo apt update
    ```
2. Install PHP:
    ```bash
    sudo apt install php
    ```

#### For Linux (Fedora/CentOS/RHEL-based Systems)
1. Update the package list:
    ```bash
    sudo dnf update
    ```
2. Install PHP:
    ```bash
    sudo dnf install php
    ```

#### For Windows
1. **Download PHP**  
   Visit: [PHP Downloads](https://www.php.net/downloads)  
   Choose the appropriate version (32-bit/64-bit, thread-safe/non-thread-safe) and download the `.zip` file.

2. **Extract PHP**  
   Extract the downloaded `.zip` file to a folder (e.g., `C:\php`).

3. **Add PHP to the System PATH**  
   - Open the **Start Menu**, search for "Environment Variables", and open **Edit the system environment variables**.  
   - In the **System Properties** window, click **Environment Variables**.  
   - In the **System variables** section, find **Path**, and click **Edit**.  
   - Click **New**, and add the path to your PHP folder (e.g., `C:\php`).  
   - Click **OK** to save changes.

---

### Verify PHP Installation

Run the following command in **Terminal** or **Command Prompt**:
```bash
php -v
---

## To Start Project Server

Run the following command in **Terminal** or **Command Prompt**:
```bash
php -S localhost:8000 routing.php
```