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