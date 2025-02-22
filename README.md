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

4️⃣ Open the Project 🍽️
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
Built with ❤️, PHP, Tailwind CSS, and way too much pizza. 🍕

Now go forth, code, and enjoy the cheesiest web project ever! 🚀🔥
