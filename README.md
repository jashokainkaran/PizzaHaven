🍕 Pizza Haven 🍕
The cheesiest place on the web! 🧀

Welcome to Pizza Haven, where great code meets great pizza! 🍕🔥 If you’re here, you're either a developer hungry for some Tailwind styling or a pizza lover who got lost on GitHub. Either way, let’s get your local setup cooking!

🚀 Getting Started
Follow these steps, and you’ll have the project running faster than a pizza delivery! 🚗💨

1️⃣ Clone the Repo
First, grab the code:

git clone https://github.com/jashokainkaran/pizzaHaven.git

Then, navigate into the folder:

cd pizzaHaven


2️⃣ Install Dependencies
Since node_modules isn’t included (because it's HUGE and nobody wants that 🍕➡️🐘), you’ll need to install everything fresh:

npm install

This will set up Tailwind CSS and any other dependencies! 🎨✨

3️⃣ Build Tailwind (If Needed)
If styling looks weird (or non-existent 😱), generate the output.css file with:

npx tailwindcss -i ./assets/css/input.css -o ./assets/css/output.css --watch

Now Tailwind will watch for any changes and re-style everything in real-time. It’s like having your own personal web designer… kinda. 😆

4️⃣ Setting Up the MySQL Database
To serve up those pizzas, we need a database! Here’s how to set it up:

Create a New Database:

Open phpMyAdmin.
Create a new database (e.g., PizzaHavenDB).
Import the MySQL File:

Find the pizzahaven.sql file in the project folder.

Go to phpMyAdmin, select your newly created database, and click on the Import tab.
Choose the pizzahaven.sql file and click Go to run the script to set up the necessary tables and data.

5️⃣ Configure the Database Connection
To connect to the database, you need to specify the database name in the db.php file. Here’s how to do it:

Locate the db.php File:

Go to the src folder in your project directory.
Then open the includes folder.
Open db.php:

Open the db.php file in your preferred code editor.

Change the Database Name:

Find the line that specifies the database name. It will look something like this:

$dbname = 'your_database_name';
Replace 'your_database_name' with the name of the database you created (e.g., PizzaHavenDB).
Save the Changes:

Also if you have a different username and password for your databse other than the default, change that as well.

Save the file after making the changes.

6️⃣ Open the Project 🍽️
Fire up your favorite browser and open the main PHP file in a local server. If you're using XAMPP, MAMP, or another PHP server, drop the project inside the correct folder (e.g., htdocs for XAMPP) and start the server.

🎯 Troubleshooting
❓ Styles not working?

Make sure output.css exists and is linked in your HTML.
Run npx tailwindcss -i ./assets/css/input.css -o ./assets/css/output.css --watch to regenerate styles.
❓ Getting weird Git errors?

Try git pull origin main to update your local repo.
🏆 Contributing
Want to improve Pizza Haven? 🍕 Fork it, tweak it, and send in a pull request. Just don’t replace pizza with pineapple. That’s controversial. 🍍🚫

🤝 Credits

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat&logo=javascript&logoColor=black)
![MySQL](https://img.shields.io/badge/MySQL-005E9C?style=flat&logo=mysql&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-06B6D4?style=flat&logo=tailwind-css&logoColor=white)

Built with ❤️, PHP, Tailwind CSS, MySQL and way too much pizza. 🍕

Now go forth, code, and enjoy the cheesiest web project ever! 🚀🔥
