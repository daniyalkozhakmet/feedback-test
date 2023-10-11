# Задание: 
 
В первую очередь, надо корректровать переменную ROOT (находится app=>core=>config.php ) так, так названа папка проекта. К примеру, у меня папка как todotest, соответсвенно 
 
 ```
 define('ROOT', 'http://localhost/{todotest}/public'); 
```
 надо изменить todotest;

## База данных: 
 
 ```
    CREATE DATABASE todotest; 
    CREATE TABLE IF NOT EXISTS users ( 
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
      username VARCHAR(30) NOT NULL, 
      email VARCHAR(30) NOT NULL, 
      password VARCHAR(255) NOT NULL, 
      is_admin BOOLEAN default false, 
      reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
      ); 
    CREATE TABLE IF NOT EXISTS feedbacks ( 
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
      name VARCHAR(30) NOT NULL, 
      email VARCHAR(30) NOT NULL, 
      message TEXT NOT NULL, 
      image VARCHAR(255) NOT NULL, 
            is_accepted BOOLEAN default false, 
            is_edited BOOLEAN default false, 
      user_id INT(6) UNSIGNED, 
      date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
            FOREIGN KEY (user_id) REFERENCES users(id) 
            ); 
 ```
 
Чтобы зайти как админ, Надо зарегистрироваться как, username(admin),password(123),email(ваш email). Можно залогиниться через email или username;
