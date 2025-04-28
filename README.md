# 📚 Health Information System
A simulation of a basic Health Information System that allows doctors to manage health programs and client enrollments.
Built to demonstrate software development skills including database design, API exposure, clean code practices, and a well-structured approach.

## Features
- **Create Health Programs** (e.g Malaria, TB, HIV)
- **Register new clients** into the system
- **Enroll clients** into one of more health programs
- **Search for Clients** by ID
- **View Clients Profile** along with their enrolled programs
- **Expose Client Profiles via API** for easy integration with external systems

## Database Schema
- users — Doctors or system users
- clients — Registered patients
- programs — Health programs
- client_programs — Enrollments (many-to-many between clients and programs)

## Technologies Used
- **Backend Language:** PHP
- **Database:** MySQL
- **API Design:** RESTful

## Installation Guide
### Prerequisites
You are expected to have at least each of the following tools installed on your system, or their equivalence, for some cases:
- **Local Web Server** such as XAMPP, LAMPP, WAMPP
- **PHP**, preferrably version 7 or above
- **MySQL**


#### 1. Clone the Repository
```
cd YOUR_LOCAL_SERVER_LOCATION
git clone https://github.com/MOSES-OKOTH/cema
cd cema
```



#### 2. Start the Web Server

Start your local web server, either using the CLI or the GUI, based on your preferences.

#### 3. Set up the Database

You can set up the database for the project by navigating to the `/db` folder and either:
- running the script in `/db/cema.sql` file, or 
- importing the database file via the web server's GUI.

#### 4. Run the project
You can can now access the project locally via your browser using [localhost](http://localhost). The application will default you to the login page where you are supposed to key in the login credentials. Set the `ID` as `12345678` and `Password` as `Password@123` to be able to login.

## Project Structure

```
cema/
├── api/
│   ├── auth/               # Contains the authentication logic
        └──  index.php
│   ├── createProgram/      # Creates the health programs
        └──  index.php
|   ├── enrollProgram/      # Enrolls a client into a health program
        └──  index.php
│   ├── registerPatient/    # Adds a new patient into the system
        └──  index.php
│   ├── viewPatient/        # Exposes the client's profile
│   └── index.php
├── db/
    ├── db.php              # Database connection file
│   └── cema.sql            # MySQL schema
├── login/                  # Login logic
├── signup/                 # Adding a new system user
├── README.md
├── requirements.txt
└── .env.example

```

## API Endpoints
**Method** &nbsp;&nbsp;&nbsp; **Endpoint** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; **Description**

POST &nbsp;&nbsp;&nbsp; `/createProgram` &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Creates a new health program

POST &nbsp;&nbsp;&nbsp; `/enrollProgram` &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Enroll a patient into a health program

POST &nbsp;&nbsp;&nbsp; `/registerPatient` &nbsp;&nbsp;&nbsp; Register a new patient into the system

POST &nbsp;&nbsp;&nbsp; `/viewPatient` &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Expose client details via an API


## Testing
- Unit tests using PHPUnit
- Integration tests for all the API endpoints using Bruno (an offline alternative to postman)

## Security Considerations
- Passwords hashed using industry standard methods
- Input validation and sanitization
- Protection against SQL injections and XSS
- API authentication

## Possible Improvements
- Implementing role-based access control (system admin vs doctors)
- Deploy the application to a cloud host

## Prototype Demonstration
A demonstration of the functionality has been attached below:


# Author
Moses Okoth

[LinkedIn](https://ke.linkedin.com/in/moses-okoth/3a0b32233)
