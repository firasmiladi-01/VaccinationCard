# Vaccination Card Website

This is a PHP project that serves as a vaccination card website, allowing users to keep track of their vaccination status, countries visited, and diseases in different countries. The website also includes user accounts, doctor accounts, and officer accounts to manage the vaccination process efficiently.

## Features

### User Account:

- Each user has a unique VC (Vaccination Card) code for identification.
- Users can view their vaccination history, including the vaccines they have received and the countries they have visited.
- Users can also view information about diseases in different countries.

### Doctor Account:

- Doctors can add vaccines to a user's vaccination history.
- Doctors can also update the vaccination status of a user.

### Officer Account:

- Officers can verify the vaccination status of a user.
- Officers can determine whether a user is allowed to travel to a certain country based on their vaccination history.

## Installation

To use this project on your local machine, follow these steps:

1. Clone the repository to your local machine using `git clone` command.
2. Install a local server (e.g., XAMPP or WAMP) to run the PHP project.
3. Create a database in your local server and import the provided SQL file (vaccination_card.sql) to set up the database.
4. Update the database connection details in the config.php file, including the host, username, password, and database name.
5. Start the local server and open the project in your preferred web browser.

## Contributing

If you would like to contribute to this project, feel free to fork the repository and submit a pull request with your changes. Please ensure that your changes are well-documented and tested before submitting the pull request.
