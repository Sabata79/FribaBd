-- Active: 1670055728141@@127.0.0.1@3306

CREATE TABLE `backlog` (
  `backlog_id` smallint(6) NOT NULL,
  `product_id` smallint(6) NOT NULL,
  `pcs` smallint(6) NOT NULL
);

-- Rakenne taululle `customer`

CREATE TABLE `customer` (
  `customer_id` smallint(6) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT 'NOT NULL',
  `email` varchar(50) NOT NULL,
  `pw` varchar(50) NOT NULL
);

-- Rakenne taululle `order`


CREATE TABLE `order` (
  `customer_id` smallint(6) NOT NULL,
  `backlog_id` smallint(6) NOT NULL,
  `date` datetime NOT NULL
);

-- Rakenne taululle `product`


CREATE TABLE `product` (
  `product_id` smallint(6) NOT NULL,
  `group_id` smallint(6) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` decimal(8,0) NOT NULL
);


-- Rakenne taululle `productgroups`

CREATE TABLE `productgroups` (
  `group_id` smallint(6) NOT NULL,
  `type` varchar(20) NOT NULL
);


ALTER TABLE `backlog`
  ADD PRIMARY KEY (`backlog_id`),
  ADD KEY `product_id` (`product_id`);

ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

ALTER TABLE `order`
  ADD PRIMARY KEY (`backlog_id`),
  ADD KEY `customer_id` (`customer_id`);

ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `group_id` (`group_id`);

ALTER TABLE `productgroups`
  ADD PRIMARY KEY (`group_id`);

ALTER TABLE `customer`
  MODIFY `customer_id` smallint(6) NOT NULL AUTO_INCREMENT;

ALTER TABLE `productgroups`
  MODIFY `group_id` smallint(6) NOT NULL AUTO_INCREMENT;

ALTER TABLE `backlog`
  ADD CONSTRAINT `backlog_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`backlog_id`) REFERENCES `backlog` (`backlog_id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `productgroups` (`group_id`);
COMMIT;
