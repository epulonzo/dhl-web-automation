# DHL Smart Incident Reporting System
**DHL APSSC | Digital Automation Challenge 2026**

A modern, automated, and AI-powered incident management system built with **Laravel 12**, **UiPath RPA**, and **Groq (Llama 3.3)**.

## 🚀 Overview

The **DHL Smart Incident Hub** is designed to streamline the reporting, tracking, and resolution of global logistics disruptions. It features a fully automated pipeline where a UiPath bot monitors Google Drive for incident reports, processes the data, and securely pushes it to this web application via REST APIs. 

Once in the system, AI automatically generates executive summaries, verifies priority levels, and checks categorizations.

## ✨ Key Features

- **Premium Dark Theme UI:** Built from the ground up with custom Tailwind CSS and Alpine.js for a sleek, modern, and highly responsive user experience.
- **RPA Automation (UiPath):** Seamlessly integrates with Google Drive to automatically read incoming `.txt` reports, extract tracking numbers via Regex, and push payloads directly to the Laravel API.
- **AI Intelligence (Groq / Llama 3.3):** Automatically analyzes incident descriptions to generate executive summaries, sentiment analysis, and smart priority/category verifications.
- **Role-Based Access Control:** Distinct views and permissions for `Admin` (full access, delete rights) and `Support Staff` (view-only workflow).
- **Timezone Aware:** Fully configured to process and display all incidents in Malaysia Standard Time (`Asia/Kuala_Lumpur`).

## 🛠️ Technology Stack

* **Backend:** Laravel 12 (PHP)
* **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
* **Automation:** UiPath Studio, Google Drive API
* **Database:** MySQL / SQLite
* **AI:** Groq API (Llama 3.3 model)

## 📦 Local Setup Instructions

### 1. Web Application (Laravel)

1. **Install Dependencies:**
   ```bash
   composer install
   npm install
   ```
2. **Environment Setup:**
   Copy the `.env.example` file to `.env` and configure your database and Groq API keys.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. **Database Migration:**
   ```bash
   php artisan migrate --seed
   ```
4. **Run Servers:**
   You will need two terminal windows running simultaneously:
   ```bash
   php artisan serve
   ```
   ```bash
   npm run dev
   ```
   *The application will be accessible at `http://127.0.0.1:8000`*

### 2. UiPath Bot Setup

1. Open the `dhl_automation` project in **UiPath Studio**.
2. Open `Main.xaml`.
3. Inside the **Find Files and Folders** activity, ensure your specific Google Drive Folder ID is configured:
   `"'YOUR_FOLDER_ID' in parents and name contains '.txt' and trashed=false"`
4. Ensure the **POST to Laravel API** activity is pointing to:
   `http://127.0.0.1:8000/api/incidents/store`
5. Run the bot. The bot will automatically clean up processed files (moving them to the trash in Google Drive and deleting local temporary files) to prevent duplicates. https://drive.google.com/drive/folders/1PI1nhHhbufF_HLM4atvADxI1UNzhJwEj?usp=drive_link 

## 🤝 Contributing
Developed for the **DHL APSSC Digital Automation Challenge 2026**.
