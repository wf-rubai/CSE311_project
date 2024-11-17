# Messenger Clone

## Project Description

The **Messenger Clone** project is a highly accurate reproduction of the popular messaging platform, Messenger. This project aims to replicate the core features and user interface of Messenger, providing a similar user experience and functionality.

### Key Features

- **User Authentication**: Secure login and registration system to manage user accounts.
- **Real-Time Messaging**: Instant messaging capabilities with support for one-on-one and group chats.
- **Chat Interface**: A sleek and intuitive chat interface that mirrors Messenger’s design, including message bubbles, timestamps, and user avatars.
- **Notifications**: Real-time notifications for new messages and activity, ensuring users stay updated.
- **User Profile Management**: Options for users to update their profile information, including profile picture and status.
- **Media Sharing**: Ability to share images, videos, and other media within chats.
- **Search Functionality**: Integrated search to find conversations and contacts quickly.
- **Responsive Design**: A responsive layout that adapts to various devices, including desktop and mobile screens.

### Technologies Used

- **Frontend**: Built using modern HTML, CSS, and JavaScript frameworks to ensure a dynamic and responsive user interface.
- **Backend**: Implemented with PHP and a MySQL database to handle user authentication, messaging logic, and data storage.
- **Real-Time Communication**: Utilizes WebSocket or similar technologies to facilitate real-time messaging.

### Purpose

The Messenger Clone project serves as both a learning tool and a demonstration of web development skills. It provides a comprehensive example of how to build a full-featured web application with a focus on real-time communication, user experience, and design fidelity.

By creating this near-perfect clone, developers can gain practical experience in building scalable and interactive web applications, while also exploring the intricacies of real-time data handling and user interface design.

---

Feel free to explore the project and contribute to its development!

---

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
php -S localhost:8000 routing.php
```