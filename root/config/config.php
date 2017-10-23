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
            "dbname" => "towerdefense",
            "username" => "root",
            "password" => "",
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