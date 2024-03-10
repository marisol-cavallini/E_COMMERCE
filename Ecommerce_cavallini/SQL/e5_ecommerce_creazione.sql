create database if not exists e5_ecommerce;

create table e5_ecommerce.users(
id int not null auto_increment primary key,
email varchar(50),
password varchar(256),
role_id int
);

create table e5_ecommerce.roles(
id int not null auto_increment primary key,
nome varchar(50),
descrizione varchar(500)
);

create table e5_ecommerce.sessions(
id int not null auto_increment primary key,
ip varchar(16),
data_login datetime,
user_id int 
);

create table e5_ecommerce.carts(
id int not null auto_increment primary key,
user_id int 
);

create table e5_ecommerce.products(
id int not null auto_increment primary key,
nome varchar(50),
prezzo float,
marca varchar(50)
);

create table e5_ecommerce.cart_products(
quantita int,
cart_id int,
product_id int
);
-- inserimento chiavi esterne 
alter table e5_ecommerce.users
add foreign key (role_id) references roles(id);

alter table e5_ecommerce.carts 
add foreign key (user_id) references users (id);

alter table e5_ecommerce.sessions 
add foreign key (user_id) references users (id);

alter table e5_ecommerce.cart_products
add foreign key (cart_id) references carts (id),
add foreign key (product_id) references products(id);


  SHOW GRANTS FOR 'mari'@'localhost';
