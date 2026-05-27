This is a personal php project I made in my spare time because I hated my calendar app and wanted something more useful for how I use it. 
It has many little quality of life functions such as bringing back uncompleted tasks to the current day until they are completed, 
removing events that are too far in the past that don't repeat, setting events that repeat every 14 days to repeat every 2 weeks, etc. 
This is my first time making something like this so it is a little unorganized and asanine in places but I wanted to upload proof that I made it.


This is a personal php project I made in my spare time because I hated my calendar app and wanted something more useful for how I use it. 
It has many little quality of life functions such as bringing back uncompleted tasks to the current day until they are completed, 
removing events that are too far in the past that don't repeat, setting events that repeat every 14 days to repeat every 2 weeks, etc. 
This is my first time making something like this so it is a little unorganized and asanine in places but I wanted to upload proof that I made it.


Setup instructions:

1. Host database of structure:

CREATE TABLE `Event` (
  `name` varchar(100) DEFAULT NULL,
  `moment` datetime DEFAULT NULL,
  `repeatType` varchar(6) DEFAULT NULL,
  `repeatDuration` int(11) DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `isDeadline` tinyint(1) DEFAULT 0,
  `completed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;


Hosting instructions:
Run a Docker container with the MariaDB image on some port and set MARIADB_ROOT_PASSWORD_HASH={Your hashed password}. 
    (SQL's PASSWORD() function gives hashed version of a plaintext password)
Use a database management software like DBeaver to connect to the database as "root" user on your port with your password.
Run the above structure as SQL script (How you do this depends on how your database management software works)

2. In config.php, set all variables according to how you set up your database.
3. Run php -S localhost:{Another port} and open the address on a browser.
4. (P.S. There is no security or anything so stay on your private network lol)
5. (P.S.2. This actually means that you could technically host the app and use it as a household task list or something I think that's cool)