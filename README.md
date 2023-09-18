# Farmium Plant Tracker

#### Description:

Plant Tracker is a web application built using HTML, CSS, JavaScript, AJAX, jQuery, Node.js, and MySQL to help plant enthusiasts monitor and manage their plants' health and watering schedule. This comprehensive platform simplifies plant care, making it easier for users to ensure the well-being of their plants. It is designed to be user-friendly to new beginners.

Key Features:

- **User Registration and Login**: Secure user registration and login functionality allows users to create accounts and access their personalized plant care dashboard.
- **Plants Dashboard**: The intuitive dashboard provides an overview of all the user's plants, presenting essential information such as the last watering date and the overall health of each plant.
- **Plant Scanning**: By leveraging an advanced plant scanning API, users can identify their plants by uploading images. The app uses intelligent algorithms to analyze the images and provide accurate species identification.
- **Plant Information**: Integrated with the GPT-3 engine, the app retrieves comprehensive plant information, including care difficulty, sun exposure requirements, watering schedules, and potential dangers of the plant.
- **Log Watering**: With a simple click, users can log watering sessions, and the app records the date. Utilizing GPT-3, it also provides approximate recommendations for the next watering session.
- **Plant Health Check**: By capturing and uploading plant pictures, users can assess the health of their plants. The app employs cutting-edge image analysis algorithms to determine the health percentage, giving valuable insights into the overall condition.
- **Settings**: The settings page enables users to personalize their accounts by modifying their names and passwords. It also provides a convenient log-out option.

To see Plant Tracker in action, please watch the video demo linked above.

## Technologies Used

- HTML, CSS, JavaScript for the front-end
- AJAX and jQuery for seamless data retrieval and updates
- PHP and Node.js for server-side scripting and running the application
- MySQL for database management

Feel free to explore the codebase and make any necessary modifications to suit your requirements.

Enjoy using Plant Tracker and ensuring the health of your plants!

## Project Files

- **index.php**: The `index.php` file serves as the entry point of the application. It contains the login and signup forms, allowing users to create their accounts and securely log in to access their personalized plant care dashboard. The index page provides a seamless and intuitive user experience.

- **index.js**: The `index.js` file contains JavaScript functions and behaviors that enhance the user interface and handle various interactions within the web app. It utilizes AJAX, jQuery, and other libraries to provide dynamic and responsive features, ensuring a smooth user experience.

- **node_modules/**: The `node_modules/` folder contains all the dependencies installed for the project. These dependencies are essential libraries and modules required for the app to leverage additional functionality and external APIs. Node.js and npm are used to manage these dependencies efficiently.

- **package-lock.json**: The `package-lock.json` file is automatically generated by npm and contains detailed information about the installed dependency versions. It ensures consistent installations across different environments, providing stability and reliability to the project.

- **email.php**: The `email.php` file handles the email functionality when a user forgets their password. It executes the necessary steps to send an email with a new password to the user. This feature enhances the security and convenience of the app, allowing users to regain access to their accounts seamlessly.

- **pages/**: The `pages/` folder contains various pages of the app, each providing specific functionality and information to the users.

  - **cname.php**: The `cname.php` file facilitates the process of updating the user's name in the database when they decide to change it through the settings page. It ensures that the user's account accurately reflects the updated information, providing a personalized experience.

  - **cpwd.php**: The `cpwd.php` file allows users to modify their account password through the settings page. It securely updates the user's password in the database, ensuring the integrity and confidentiality of their login credentials.

  - **health.php**: The `health.php` file encompasses essential functionalities such as the log watering feature and the plant health check. Users can easily log their watering sessions through a simple interface, and the app records the date using PHP and MySQLi. Additionally, the plant health check leverages an API to scan the uploaded plant image and determine its health percentage. This valuable information is then displayed to the user, aiding them in understanding the condition of their plant.

  - **info.php**: The `info.php` file serves as an information hub for each plant in the user's collection. It leverages the power of GPT-3, to search for comprehensive plant information. By inputting the plant's name as a prompt, the app retrieves valuable details regarding care difficulty, sun exposure requirements, watering guidelines, and potential dangers. Users can access this information to ensure they provide the best care for their plants.

  - **settings.php**: The `settings.php` file provides users with the ability to personalize their accounts and tailor the app to their preferences. Through this page, users can change their name and password. The page also displays the user's email address and provides a convenient option to log out of their account

- **.htaccess**: The `.htaccess` file plays a crucial role in enhancing the user experience by configuring URL rewriting. It removes the '.php' extension from the URLs, resulting in cleaner and more user-friendly URLs. This feature not only improves the aesthetics of the web app but also contributes to better search engine optimization practices.

- **img/**: The `img/` folder contains all the images used in the web application.

- **log/**: The `log/` folder contains essential PHP files that handle the execution and logging of watering information into the database, as well as the plant scanning and health assessment functionalities.

  - **log-watering.php**: The `log-watering.php` file is responsible for updating the database when the user logs a watering session for their plant. By utilizing PHP and MySQLi, this file securely stores the relevant information, including the date of the watering session. It ensures accurate tracking of plant care activities, helping users maintain an effective watering routine.

  - **plant-health.php**: The `plant-health.php` file utilizes an API that scans the user's uploaded plant image and determines its health percentage. This feature enables users to assess the condition of their plants visually. The obtained health percentage serves as a valuable indicator, ranging from 0% indicating poor health to 100% indicating optimal health. Users can rely on this information to identify potential issues and take appropriate actions to ensure the well-being of their plants.

- **start/**: The `start/` folder contains the necessary files to facilitate the onboarding process for new users.

  - **scan.php**: The `scan.php` file plays a vital role during the initial setup. It enables users to add plants to their collection by utilizing the plant scanning API once again. By uploading an image of a plant, the app automatically identifies the plant type and allows users to assign a personalized nickname. This feature simplifies the process of adding and managing plants within the app.

  - **start.php**: The `start.php` file guides users to the log watering page after successfully adding their plants during the onboarding process. This seamless transition ensures that users can immediately begin tracking their watering sessions and taking advantage of the app's comprehensive plant care features.

These files collectively create a robust and user-friendly web application that empowers plant enthusiasts to effortlessly track their plant health, maintain watering schedules, access relevant plant information, and customize their experience according to their needs and preferences.
