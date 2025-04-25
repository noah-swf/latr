# Latr

> A minimalist cross‑platform watchlist

[![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg?style=flat-square&logo=Laravel)](https://laravel.com "Laravel") [![License: MIT](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](LICENSE)

## Table of Contents
- [About the Project](#about-the-project)
- [Key Features](#key-features)
- [Built With](#built-with)
- [Getting Started](#getting-started)
  - [Installation](#installation)
  - [Configuration](#configuration)
  - [Running the App](#running-the-app)
- [Demo](#demo)
- [Roadmap](#roadmap)
- [Learning Outcomes](#learning-outcomes)
- [License](#license)

---

## About the Project

**Latr** is a lightweight watch‑later service that lets you collect videos from multiple platforms— currently YouTube — into a single queue you can open on any device. Mark items as watched to maintain your progress without worrying about browser history sync or lost tabs. The goal is to offer a distraction‑free place to save and consume video content wherever you are.

<div align="center">
  <!-- Add your banner image here -->
</div>

### Key Features
- **Add videos from multiple platforms** — Paste a link and Latr parses & stores the metadata *(additional platforms coming soon)*  
- **Watched history & progress tracking** — Quickly see what you've already seen  
- **Cross‑device experience** — Fully responsive UI so your list is always with you  

## Built With

| Technology | Purpose |
|------------|---------|
| Laravel *(latest)* | Backend framework |
| PHP 8.4 | Core language |
| SQLite | Lightweight relational database |
| Tailwind CSS *(latest)* | Styling |
| Alpine.js & vanilla JS | Front‑end interactivity |

## Getting Started


### Installation
```bash
# 1. Clone the repository
git clone https://github.com/noah-swf/latr.git
cd latr

# 2. Install PHP dependencies
composer install --prefer-dist --no-dev

# 3. Install JS dependencies & compile assets
npm install && npm run build

# 4. Copy .env.example to .env and add a valid YOUTUBE_API_KEY
# obtained from the Google Cloud Console (Link in .env.example).
cp .env.example .env
php artisan key:generate

# 5. Install Laravel Herd: https://herd.laravel.com/ and add the project path to the
# "Herd paths" under the "General" Tab 


```

### Configuration
- **Database:** no extra setup needed — SQLite database file will be created automatically.  
- **Mail & other services:** configure corresponding values in `.env` if/when you integrate them.  

### Running the App
```bash
npm run dev
```
The app will be available at <http://latr.test>.


## Demo

https://github.com/user-attachments/assets/0fa57d89-4c51-4d4d-9e8f-46e6fe2f20d4


## Roadmap
- Support for additional platforms (e.g. Netflix, Disney+)  
- Additional tags + filters

## Learning Outcomes
While building Latr I deepened my understanding of:
- Laravel internals & ecosystem
- Tailwind utility‑first workflows
- Applying **SOLID** principles in PHP

## License
Distributed under the **MIT License**. See `LICENSE` for more information.

