create database if not exists marketplace;
use marketplace;

create table users (
    id int auto_increment primary key,
    name varchar(100) not null,
    username varchar(50) not null unique,
    email varchar(100) not null unique,
    password varchar(255) not null,
    role enum('pembeli','penjual') not null,
    created_at timestamp default current_timestamp
);

create table products (
    id int auto_increment primary key,
    seller_id int not null,
    name varchar(100) not null,
    description text,
    price decimal(12,2) not null,
    stock int not null default 0,
    image varchar(255),
    status enum('tersedia','habis') default 'tersedia',
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (seller_id) references users(id) on delete cascade
);

create table carts (
    id int auto_increment primary key,
    user_id int not null unique,
    created_at timestamp default current_timestamp,
    foreign key (user_id) references users(id) on delete cascade
);

create table cart_items (
    id int auto_increment primary key,
    cart_id int not null,
    product_id int not null,
    quantity int not null default 1,
    unique key unique_cart_product (cart_id, product_id),
    foreign key (cart_id) references carts(id) on delete cascade,
    foreign key (product_id) references products(id) on delete cascade
);

create table orders (
    id int auto_increment primary key,
    user_id int not null,
    address text not null,
    total_price decimal(12,2) not null,
    payment_proof varchar(255),
    status enum('menunggu pembayaran','menunggu verifikasi','diproses','selesai','ditolak') default 'menunggu pembayaran',
    created_at timestamp default current_timestamp,
    foreign key (user_id) references users(id) on delete cascade
);

create table order_items (
    id int auto_increment primary key,
    order_id int not null,
    product_id int not null,
    quantity int not null,
    price decimal(12,2) not null,
    subtotal decimal(12,2) not null,
    foreign key (order_id) references orders(id) on delete cascade,
    foreign key (product_id) references products(id) on delete cascade
);

insert into users (name, username, email, password, role) values
('budi tani', 'buditani', 'budi@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCk3c6iJb3Z9jF4F4b7G', 'penjual'),
('siti aminah', 'siti', 'siti@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCk3c6iJb3Z9jF4F4b7G', 'pembeli');

insert into products (seller_id, name, description, price, stock, status) values
(1, 'beras organik premium', 'beras organik berkualitas untuk kebutuhan keluarga.', 75000, 20, 'tersedia'),
(1, 'madu hutan', 'madu hutan alami dari peternak lokal.', 85000, 15, 'tersedia'),
(1, 'kopi arabika', 'kopi arabika pilihan dengan aroma khas.', 65000, 25, 'tersedia'),
(1, 'sayuran hidroponik', 'sayuran segar hasil budidaya hidroponik.', 30000, 10, 'tersedia'),
(1, 'pupuk kompos', 'pupuk kompos organik untuk tanaman.', 40000, 30, 'tersedia');
