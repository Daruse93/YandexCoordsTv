<?php
require_once 'build.class.php';
$resolvers = array(
  'settings'
);
$builder = new siteBuilder('yandexcoordstv', '1.0.2', 'beta', $resolvers);
$builder->build();
