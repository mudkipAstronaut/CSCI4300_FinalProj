# CSCI4300_FinalProj

This is a repository containig the final project for UGA's 
CSCI4300 Class for the fall semsester of 2021. Created by 
Daniel Gyorfi, Kyle Orth, Philip Kim, and Andres Rodriguez.

The repository contains a website named WooHoo for a 
user-generated database of travel locations, reviews and advice.

## Usage

The entry point to the website is the `index.php` file


Users can login, register, edit and delete their accounts. They can add
travel locations to the database along with pictures and reviews.
Reviews can be edited, and both reviews and pictures can be deleted
by users who posted them. The admin account(User-ID of 1) can delete
places, pictures, and reviews. Users will be redirected to index.php from 
pages they shouldn't have access to such as the delete place page, and if 
not logged in the wishlist and profile page. Users that are logged in will
be redirected from the register account page. If a user enters a 
url for a place that does not exist in the database, a 404 page will be 
displayed instead. 

This website has been tested on Firefox for Ubuntu 20.04 and Windows 10, Chrome for Windows 10.

We used the XAMPP Framework to test and develop the website locally.

Our database accessor (found in `database.php`) was based on the class assignment 13
but modified to fit our needs and our specific database.

## Folder Structure

the main folder contains all the php files and forms. The `place_imgs` folder
contains all the images that the webpage uses that are directly connected to places
in the website.
In the `css` folder we also have a `style.css` file that contains the main style for all the pages.
