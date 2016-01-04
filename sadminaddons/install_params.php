<?php

/**
 * @author kross
 * @copyright 2010
 */

include("../sadmin/_bfunctions.php");
//include("../sadmin/_config.php");
//include("../sadmin/_mysql.php");
//include("../sadmin/_admin_config.php");

$SQL = "CREATE TABLE IF NOT EXISTS params_groups_names
(
group_id integer NOT NULL AUTO_INCREMENT PRIMARY KEY,
group_name text
)
";

$Q->query($DB, $SQL);

$SQL = "CREATE TABLE IF NOT EXISTS params_names
(
param_id integer NOT NULL AUTO_INCREMENT PRIMARY KEY,
param_name text,
param_type text
)
";

$Q->query($DB, $SQL);

$SQL = "CREATE TABLE IF NOT EXISTS values_titles
(
value_id integer NOT NULL AUTO_INCREMENT PRIMARY KEY,
value_title text
)
";

$Q->query($DB, $SQL);

$SQL = "CREATE TABLE IF NOT EXISTS products_values
(
product_id integer NOT NULL,
param_id integer NOT NULL,
value TEXT,
PRIMARY KEY (product_id, param_id)
)
";

$Q->query($DB, $SQL);

$SQL = "CREATE TABLE IF NOT EXISTS category_groups
(
category_id integer NOT NULL,
group_id integer NOT NULL,
sorter integer NOT NULL,
PRIMARY KEY (category_id, group_id)
)
";

$Q->query($DB, $SQL);

$SQL = "CREATE TABLE IF NOT EXISTS groups_params
(
group_id integer NOT NULL,
param_id integer NOT NULL,
sorter integer NOT NULL,
PRIMARY KEY (group_id, param_id)
)
";

$Q->query($DB, $SQL);

$SQL = "CREATE TABLE IF NOT EXISTS params_values
(
param_id integer NOT NULL,
value_id integer NOT NULL,
sorter integer NOT NULL AUTO_INCREMENT UNIQUE,
PRIMARY KEY (param_id, value_id)
)
";

$Q->query($DB, $SQL);

header("location:params_list.php");
?>