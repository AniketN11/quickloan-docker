# 🏦 QuickLoan: Dockerized PHP + MySQL Application on AWS EC2

A loan application website where users submit loan requests that are stored in a database. The app is containerized with Docker Compose and runs on an AWS EC2 (Ubuntu) instance. 🚀

## 🛠️ Tech Stack
- 🐘 **Web:** PHP 8.2 + Apache (custom Dockerfile)
- 🗄️ **Database:** MySQL 8.0
- 🐳 **Orchestration:** Docker Compose
- ☁️ **Hosting:** AWS EC2 (Ubuntu)

## 🏗️ Architecture 

 [QuickLoan architecture on AWS.html](https://github.com/user-attachments/files/34500866/QuickLoan.architecture.on.AWS.html)

- 📦 Two containers: `quickloan-web` and `quickloan-db`
- 🔗 Custom bridge network, so the web container reaches the database by service name `db`
- 🔒 The DB port is **not published** to the host, so the database is reachable only from the web container
- ❤️ MySQL healthcheck: the web container starts only after the DB is healthy
- 💾 Named volume `mysql-data` keeps data after container restarts
- 🔑 Database credentials are passed as environment variables from a `.env` file (not committed to Git)
- 📝 `init.sql` creates the `applications` table on first start

## 📁 Project Structure

    quickloan-docker/
    |-- Dockerfile
    |-- docker-compose.yml
    |-- init.sql
    |-- includes/
    |   `-- db_connect.php
    `-- public/
        |-- index.html
        |-- apply.php
        |-- submit_application.php
        |-- styles.css
        `-- images/

## ▶️ How to Run

1. Install Docker and Docker Compose on the server.
2. Clone the repository.
3. Create a `.env` file in the project folder with these variables and your own passwords:

        MYSQL_DATABASE=quickloan_db
        MYSQL_USER=quickloan_user
        MYSQL_PASSWORD=your_password
        MYSQL_ROOT_PASSWORD=your_root_password

4. Start the containers:

        docker compose up -d --build

5. Open `http://SERVER_IP:8080` in your browser. 🌐
6. On AWS EC2, allow inbound TCP port 8080 in the Security Group.

## ✅ Verify the Data

    docker exec -it quickloan-db mysql -u<MYSQL_USER> -p<MYSQL_PASSWORD> quickloan_db -e "SELECT * FROM applications;"

## 🐞 Troubleshooting
- ⚠️ **Headers already sent:** do not leave blank lines after `?>` in PHP include files.
- 📂 **Wrong include path:** `includes/` sits outside `public/`, so use `__DIR__ . '/../includes/db_connect.php'`.
- 🔄 **Changes not visible:** files are copied into the image, so run `docker compose up -d --build` after editing.

## 🎓 What I Learned
- 🐳 Writing a Dockerfile and setting the Apache document root
- 🔧 Multi-container setup with Docker Compose, networks, volumes, healthchecks
- 🔐 Keeping secrets out of Git with `.env` and `.gitignore`
- 🔍 Debugging PHP and container issues using `docker compose logs`

## 👨‍💻 Author
**Aniket Nerkar** | Cloud & DevOps Enthusiast ☁️
GitHub: [AniketN11](https://github.com/AniketN11)
