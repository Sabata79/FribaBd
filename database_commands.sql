-- Active: 1670086568018@@127.0.0.1@3306
-- Table `productgroups`

CREATE TABLE productgroups (
        `group_id` smallint(6),
        `disctype` varchar(20),
        `status` VARCHAR(10),
        CONSTRAINT productgroups_pk PRIMARY KEY (group_id)
    );

INSERT INTO productgroups (`group_id`, `disctype`, `status`) 
VALUES  (1, 'Putter','active'),
        (2, 'Midway','active'), 
        (3, 'Driver','active'), 
        (4, 'LongDriver','active');

-- Table `product`
CREATE TABLE product (
        `product_id` INTEGER,
        `group_id` smallint(6) NOT NULL,
        `product_name` varchar(50) NOT NULL,
        `price` decimal(5, 2),
        `status` VARCHAR(10),
        CONSTRAINT product_pk PRIMARY KEY(product_id),
        CONSTRAINT product_name_un UNIQUE(product_name),
        CONSTRAINT group_id_fk FOREIGN KEY(group_id)
            REFERENCES productgroups (group_id)
    );

INSERT INTO product (`product_id`, `group_id`, `product_name`, `price`, `status`)
VALUES  (1,1,'Innova Halo Star Invader','35','active'),
        (2,1,'Innova Halo Star AviarX3','35','active'),
        (3,1,'Latitude 64 Zero Medium Orbit Pure','15','active'), 
        (4,1,'Discraft Putter Line Soft Focus','12','active'), 
        (5,1,'Discmania Active Premium Glow Sensei -Undead Samur','19','active'), 
        (6,1,'Latitude 64 Royal Sense Faith -Connor Oreilly','17','active'), 
        (7,2,'Metafora Discs Kasetti','24','active'), 
        (8,2,'Innova Halo Star Mako3','35','active'), 
        (9,2,'Clash Discs Steady Peach','20','active'), 
        (10,2,'Exel Discs Havu -Prototype','13','active'), 
        (11,2,'Innova Halo Star Roc3 Jen Allen -Tour Series','35','active'), 
        (12,2, 'Prodigy 400 A5', '17','active'), 
        (13,3,'Discraft Esp Athena -Paul Mcbeth First Run','24','active'), 
        (14,3,'Innova Halo Star Roadrunner -Juliana Korver Tour S','37','active'), 
        (15,3,'Westside Discs Vip Seer','18','active'), 
        (16,3,'Dynamic Discs Fuzion Getaway','18','active'), 
        (17,3,'Innova Star Leopard3','22','active'), 
        (18,3,'Innova Star Hawkeye','22','active'), 
        (19,4,'Innova Halo Star Mamba','35','active'), 
        (20,4,'Dynamic Discs Lucid Air Sheriff','17','active'), 
        (21,4,'Clash Discs Steady Wild Honey','20','active'), 
        (22,4,'Prodigy X Airborn - Falcor 400','21','active'), 
        (23,4,'Clash Discs Steady Pepper','20','active'), 
        (24,4,'Clash Discs Steady Salt -Prototype','20','active');

-- Table `customer`
CREATE TABLE customer (
        `customer_id` VARCHAR(6),
        `fullname` varchar(30) NOT NULL,
        `email` varchar(50),
        `pw` varchar(50),
        `status` VARCHAR(10),
        CONSTRAINT customer_pk PRIMARY KEY(customer_id),
        CONSTRAINT fullname_un UNIQUE(fullname)
    );

INSERT INTO customer (`customer_id`, `fullname`, `email`, `pw`, `status`)
VALUES  (1,'Harri Hauiskääntö','Harrillaonhabaa@paljon.fi','xxx','active'), 
        (2,'Sakari Kaulaote','SakariKaula@ote.com','2xxx','active');

-- Table `order`
CREATE TABLE orders (
        `order_id` INTEGER NOT NULL,
        `customer_id` VARCHAR(6),
        `date` datetime,
        `status` VARCHAR(10),
        CONSTRAINT orders_pk PRIMARY KEY (order_id),
        CONSTRAINT orders_customer_fk FOREIGN KEY (customer_id)
            REFERENCES customer (customer_id)
    );
INSERT INTO orders (order_id, customer_id, date, status)
VALUES(101,1,'2022-12-4','active');

-- Table`backlog`

CREATE TABLE backlog (
        `order_id` INTEGER NOT NULL,
        `backlog_id` smallint(6) NOT NULL,
        `product_id` INTEGER,
        `pcs` INTEGER,
        `status` VARCHAR(10),
        CONSTRAINT backlog_pk PRIMARY KEY (order_id, backlog_id),
        CONSTRAINT backlog_product_fk FOREIGN KEY (product_id)
            REFERENCES product (product_id)
    );
INSERT INTO backlog (`order_id`, `backlog_id`, `product_id`, `pcs`, `status` )
VALUES(101,1,12,50,'active');