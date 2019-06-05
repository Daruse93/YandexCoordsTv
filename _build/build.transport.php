<?php
require_once 'build.class.php';
$resolvers = array(

);
$builder = new siteBuilder('yandexcoordstv', '1.0.1', 'beta', $resolvers);
$builder->build();
