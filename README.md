<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


<img width="1296" height="833" alt="image" src="https://github.com/user-attachments/assets/9754e1b2-c18a-4cdd-ba28-b2303f35a654" />
<img width="1358" height="790" alt="image" src="https://github.com/user-attachments/assets/5775b9cd-e33d-4aed-a3bd-e359222c00c1" />
<img width="1306" height="642" alt="image" src="https://github.com/user-attachments/assets/95bc5c31-77d6-4e14-93f3-414eb51906ea" />
<img width="1310" height="742" alt="image" src="https://github.com/user-attachments/assets/3f16a545-6157-4756-8768-fcf45da85cb2" />
<img width="1396" height="791" alt="image" src="https://github.com/user-attachments/assets/218b382c-6b50-49ee-84c2-b9b4470cbf3f" />



Music Musings is a music review website designed in a similar vein to Rate Your Music with adjustments made to enhance the UX of the existing Rate Your Music site. Developed as an interactive prototype for the Web Application Development module (CSC-348 Assignment 3b) during my undergraduate study at Swansea University, the platform allows a community of music enthusiasts to browse and rate their favourite albums. 

---

## Features

* **Album Reviews & Ratings:** Users can search for albums and submit detailed reviews containing a title, written comment, and a score out of 10.
* **Spotify API Integration:** Utilises the Spotify Web API to dynamically search for artists, retrieve album artwork, and fetch accurate track listings.
* **User Authentication & Profiles:** Users must create an account and log in to leave a review. Once registered, users can favourite albums and manage their personal profiles.
* **Community Interaction:** Features a community forum showing recent reviews. Users can read community posts, and those with admin privileges can moderate comments and reviews.
* **Accessibility Focused:** Evaluated against Web Content Accessibility Guidelines (WCAG) 2. The interface utilises alternative text for screen readers and passes WCAG AA and AAA color contrast standards.

---

## Tech Stack

This application is built upon the Model-View-Controller (MVC) architecture, utilizing the following technologies:

* **Backend Framework:** Laravel (PHP).
* **Frontend:** Tailwind CSS for responsive styling and Laravel Livewire for dynamic search components.
* **Database:** Eloquent ORM, handling complex entity relationships between Artists, Albums, Songs, Users, and Reviews.
* **External Services:** Spotify Web API (managed via a Laravel Service Container to handle dependency injection and authentication tokens).

---

## Setup & Installation Instructions

To run this project locally, you will need to utilise Laravel Sail and provide your own Spotify Developer credentials.

1. **Clone the repository** and install dependencies.
2. **Configure Environment Variables:** Duplicate the `.env.example` file to `.env`. For the application's search features and database seeders to function, you must register an app with Spotify and add your credentials:
   ```env
   SPOTIFY_CLIENT_ID=your_client_id_here
   SPOTIFY_CLIENT_SECRET=your_client_secret_here
   ```
   > **Note:** The `AppServiceProvider` registers these keys to authenticate with the API.

3. **Start the Application:** Boot up the Docker containers using Laravel Sail: 
   ```bash
   sail up -d
   ```
4. **Compile Frontend Assets:** It is important that you compile the assets to view the website with the correct styling: 
   ```bash
   sail npm run dev
   ```
5. **Run Migrations & Seeders:** Run the database migrations and seeders. The custom `SpotifySeeder` will automatically connect to the Spotify API and populate the database with a selection of target artists, albums, and tracks.
