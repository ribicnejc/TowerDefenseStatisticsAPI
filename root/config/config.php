<?php
$config = array(
    "db" => array(
        "dbTest" => array(
            "dbname" => "towerdefense",
            "username" => "root",
            "password" => "",
            "host" => "localhost"
        ),
        "dbRelease" => array(
            "dbname" => "nejcribic_test",
            "username" => "nejcribic_nejc",
            "password" => "*piF5(QE4xlKw",
            "host" => "localhost"
        )
    ),
    "url" => array(
        "baseUrl" => "http://nejcribic.com"
    ),
    "paths" => array(
        "resources" => "/path/to/resources",
        "images" => array(
            "content" => $_SERVER["DOCUMENT_ROOT"] . "/images/content",
            "layout" => $_SERVER["DOCUMENT_ROOT"] . "/images/layout"
        )
    )
);