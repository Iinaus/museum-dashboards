# Museum dashboards

## Table of contents 
  - [About](#about)
  - [Features](#features)
  - [Contributors](#contributors)
  - [Full assignment](#assignment)

## About   

This project is a web-based dashboard designed to visualize data provided by museum cash registers. It was developed as an exercise for the Software Engineering Project course at Vaasa University of Applied Sciences. You can read the full assignment and criteria [below](#assignment).

With this exercise we practised:
- Project work and agile methods
- Developing a full-stack web application
  - Front-end and back-end communication with JSON and AJAX
  - Importing data from API and uploading it to our own database
  - Using sessions
  - Secure login/logout and hashed passwords
- Working with MariaDB and MySQL database
  - SQL queries
- Visualizing data with 3rd party components (Google Charts)

## Features

The museum dashboard offers the following features:

- Separate logins for museums and administrators (company management) to access relevant information.
- Dashboard with graphs illustrating various data.
  - Monthly and yearly sales data for each museum.
  - Combined monthly and yearly sales data for all museums.
  - Sales of different ticket types on a monthly basis (including amounts and percentages).
  - Visits by museum members (Customer ID).
  - Information on the times of day when museums are most visited.
  - Percentages from ticket types
  - Comparison of payment methods
  - Monthly listing of tickets sold by different employees (eid).
- Dashboard filtering with date and museum ID:s.

## Contributors 

This project was a group assignment, and the contributors are [Iina Soikkeli](https://github.com/Iinaus/), [Joona Hokkanen](https://github.com/joonavonh) and Janina K.

## Full assignment

The company has four museums in Ostrobothnia, three in Vaasa and one in Pietarsaari. The company does not have any kind of digital tools in use, and now there would be a need to design and implement web software especially suitable for their purposes.

The cash register system in all museums produces hourly updated information about sold tickets, and uploads the information to the server. File contains following data: 
  mid1, NormTicket 12, 29092022 09:32, eid4, cid417234, debit 
  (Museum id, ticket type, date and time, employee ID, Customer ID, payment method)

Example data can be found in link provided by teacher which can be used as API. The link includes text file with cash register data.

The company needs a web application with at least the following functions:
- Museum-specific ticket sales information on a monthly and yearly basis.
- Combined monthly and yearly sales data for all museums.
- Separate login for museums and administrators (company management). With each museum's username, you can only see the museum's own information. Administrators can see all information.

In addition, it would be great if the following functionalities could be found in the application:
- Monthly sales of different ticket types -> amounts and percentages.
- Visits by museum members (Customer ID).
- Information about what times of the day museums are most visited.
- Graphs from various data -> percentages from, for example, ticket types and comparisons of ticket sales at different museums, payment methods etc…
- Monthly listing of tickets sold by different employees (eid).
