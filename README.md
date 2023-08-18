# Task description for this Code Review:

You love animals and think it is time to adopt one. You like all sorts of animals: small animals, large animals, you may like reptiles and birds and may be open to adopting animals of any age. 

Let's then create an animal adoption platform to connect users (people interested in adopting pets) and animals (pets interested in being adopted). 

All users must introduce their first_name and last_name, email, phone_number, address, picture and password in order to register on the platform.

All animals must have a name, a photo and live at a specific location(a single line like “Praterstrasse 23” is enough). They also have a description, size, age, vaccinated, must belong to a breed and have a status "Adopted" or "Available".

For this CodeReview, you need to create a structure using PHP and MySQL (apart from HTML, CSS, JS, etc) that will display all data from the animals.

## For this CodeReview, the following criteria will be graded:

- Create a database (BE19_CR5_animal_adoption_yourname) initially with 2 tables: user and animal. Add sufficient test data in the animal table: at least 10 records in total between small animals and large animals. Remember that animals have their age so make sure there are at least 4 senior animals in the DB (older than 8 years old).
- Display all animals on a single web page (home.php). Make sure a nice GUI is presented here (only backenders exempt)
- There should be a link on the navbar "Senior" that will display all senior animals (animals older than 8 years old). Here you can decide whether to create a filter on the home page ($GET method) and reorganize the result from the query or create a new page senior.php and the link should lead to it.
- Create a show more/show details button that will lead to a new page (details.php) with only the information from that specific record/animal.
- Create a registration and login system for the user. The user should be able to see at least their email and picture when logged in.
- Create separate sessions for normal users and administrators.

Normal Users:

They will be able ONLY to see(read) and access all data. No action buttons (create, edit or delete) should be available for the animals (CRUD)

Admin:

Only the admin is able to create, update and delete data about animals (CRUD) within the admin panel, therefore an Admin Panel/Dashboard  should be created. Normal users MUST NOT access this page if they try.

- Pet Adoption: In order to accomplish this task, a new table pet_adoption will need to be created. This table should hold the user_id and the pet_id (as foreign keys) plus other information that you may think is relevant i.e: adoption_date. Each Pet information/card should have a button "Take me home" that, when clicked, will "adopt" the pet. When it does, a new record should be created in the table pet_adoption.
