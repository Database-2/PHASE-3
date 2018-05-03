# PHASE-2
## Building a Relational Database Management System     Due April 5, 11:00am
The most common method to connect to a remote MySQL database from an mobile device, is to put web service into the middle. Since MySQL is usually used together with PHP, the easiest way to build a DBMS is to write a PHP script to manage the database and run this script using HTTP protocol from the Android/iOS application. In this Project you are required to use PHP as the connector between the database and the Android/iOS application. The XAMPP already has the PHP installed for the MySQL database.

This [tutorial](http://www.cs.uml.edu/~cchen/310-S18/guide.html) is designed to give you a very brief overview of accessing a MySQL database using PHP.

Download the sample database to be used for this project from the course [Google Group](https://groups.google.com/forum/#!forum/uml-comp3090-f17).

Queries to be implemented in PHP:
1. Find the post that has the most number of likes
2. Find the person who has the most number of followers
3. Count the number of posts that contains the keyword “flu”, display the location of the users who have made the posts as well (use “GROUP BY location”).
4. User input a person’s twitter name, find all the posts made by that person
5. User input a year, find the person who twits the most in that year
6. After log in, find all the senders of messages to the user
7. After log in, user posts a new twit
8. After log in, user follows/unfollows another user
9. After log in, user adds comment to a post
10. After log in, user deletes a particular comment to a post he/she has created

## ER Digram
![alt text](https://01587775938597608415.googlegroups.com/attach/201bd7d88e862/erd.png?part=0.1&view=1&vt=ANaJVrEuk8mrh1D_3nGj7C-UdJmJEcgUq85BRiTsbyX3Xq0CZHiB5CaefsJ_boCs6PwfvdVYVTcJ-vAiE46kb7nvi2XuMkUUP1HI8mWbKEfDHAXjYC8s0mE)
