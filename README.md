<a id="readme-top"></a>


<div align="center">
  <a href="https://github.com/MPSBeats/ChallengeWeb_CollabDoor.git">
    <img src="public/assets/img/logoCollabdoor.svg" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">Collabdoor</h3>

  <p align="center">
    Collaboration between artists has never been easier!
    <br />
    <a href="https://github.com/MPSBeats/ChallengeWeb_CollabDoor"><strong>Explore the docs »</strong></a>
    <br />
    <br />
  </p>
</div>


<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->
## About The Project

Our project, Collabdoor, is a web application designed to facilitate collaboration between artists.
It allows users to create profiles, showcase their work, and connect with other artists.
The platform also features a messaging system, allowing users to communicate with each other easily.
Collabdoor aims to provide a space for artists to share their ideas, collaborate on projects, and learn from one another.

This project is a personnal project and we used the web development challenge to improve our skills, learn new things and structure our ideas to modify it to a real project in the future.


<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Built With

This project was built using the following technologies:

* [![HTML][html]][html-url]
* [![CSS][css]][css-url]
* [![Ajax][ajax]][ajax-url]
* [![Javascript][js]][js-url]



<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- GETTING STARTED -->
## Getting Started

To get a local copy up and running follow these simple steps.

### Prerequisites

Make sure you have the following installed on your machine:

1. **PHP 8.2 or higher**
   - To install PHP 8.2, follow the instructions below based on your operating system:

     **On Windows:**
     - Download the PHP installer from [php.net](https://windows.php.net/download/).
     - Follow the installer instructions.

     **On macOS:**
     - Use Homebrew to install PHP:
       ```sh
       brew install php@8.2
       ```

     **On Linux:**
     - Use your package manager to install PHP:
       ```sh
       sudo apt update
       sudo apt install php8.2
       ```

2. **PostgreSQL**
   - To install PostgreSQL, follow the instructions below based on your operating system:

     **On Windows:**
     - Download the PostgreSQL installer from [postgresql.org](https://www.postgresql.org/download/windows/).
     - Follow the installer instructions.

     **On macOS:**
     - Use Homebrew to install PostgreSQL:
       ```sh
       brew install postgresql
       ```

     **On Linux:**
     - Use your package manager to install PostgreSQL:
       ```sh
       sudo apt update
       sudo apt install postgresql postgresql-contrib
       ```

3. **pgAdmin 4**
   - To install pgAdmin 4, follow the instructions below based on your operating system:

     **On Windows:**
     - Download the pgAdmin 4 installer from [pgadmin.org](https://www.pgadmin.org/download/pgadmin-4-windows/).
     - Follow the installer instructions.

     **On macOS:**
     - Download the pgAdmin 4 installer from [pgadmin.org](https://www.pgadmin.org/download/pgadmin-4-macos/).
     - Follow the installer instructions.

     **On Linux:**
     - Use your package manager to install pgAdmin 4:
       ```sh
       sudo apt update
       sudo apt install pgadmin4
       ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Installation

1. **Clone the repository:**
   ```sh
   git clone https://github.com/MPSBeats/ChallengeWeb_CollabDoor
   cd ChallengeWeb_CollabDoor
   ```

2. **Change the database password in the config.ini file:**
    - Open the `config.ini` file located in the root of the project.
    - Update the `password` field with your PostgreSQL password.

3. **Create the database:**
    - Open pgAdmin 4.
    - Connect to your PostgreSQL server.
    - Right-click on the `Databases` node and select `Create > Database...`.
    - Enter `collabdoor` as the database name and click `Save`.

4. **Create the database tables:**
    - Open the `collabdoor.sql` file located in the root of the project.
    - Copy the contents of the file.
    - In pgAdmin 4, open the Query Tool.
    - Paste the contents into the Query Tool and execute the query to create the tables.

5. **Start a local PHP server in the public directory:**
    ```sh
    php -S localhost:8000 -t public
    ```

6. **Open your browser and navigate to:**
    ```
    http://localhost:8000
    ```


<p align="right">(<a href="#readme-top">back to top</a>)</p>

[html]: https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=fff&style=flat-square
[html-url]: https://developer.mozilla.org/en-US/docs/Web/HTML
[css]: https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=fff&style=flat-square
[css-url]: https://developer.mozilla.org/en-US/docs/Web/CSS
[ajax]: https://img.shields.io/badge/AJAX-0095D5?logo=ajax&logoColor=fff&style=flat-square
[ajax-url]: https://developer.mozilla.org/en-US/docs/Web/Guide/AJAX
[js]: https://shields.io/badge/JavaScript-F7DF1E?logo=JavaScript&logoColor=000&style=flat-square
[js-url]: https://developer.mozilla.org/en-US/docs/Web/JavaScript
[tailwindcss.com]: https://img.shields.io/badge/Tailwind_CSS-grey?style=flat-square&logo=tailwind-css&logoColor=38B2AC
[tailwindcss-url]: https://tailwindcss.com