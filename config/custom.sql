CREATE DATABASE product;

CREATE TABLE items(
    id int(10) AUTO_INCREMENT NOT NULL,
 	item varchar(50),
    description varchar(100),
    unit_cost float(10,5),
    quantity int(5),
    price float(10,5),
    PRIMARY KEY(id)
)