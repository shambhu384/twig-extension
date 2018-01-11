<?php

require 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
# config/packages/twig.yaml
# config/packages/twig.yaml

$loader->addPath('layout', 'base');
// Twig configuration http://symfony.com/doc/current/reference/configuration/twig.htm

$config = Yaml::parseFile(__DIR__.'/config.yaml');



$twig = new Twig_Environment($loader, $config['twig']);



$core = $twig->getExtension('Twig_Extension_Core');


// add extension
$twig->addExtension(new Twig_Extension_Debug());
$twig->addExtension(new Twig_Extensions_Extension_Text());
$twig->addExtension(new Twig_Extensions_Extension_I18n());
$twig->addExtension(new Twig_Extensions_Extension_Intl());
$twig->addExtension(new Twig_Extensions_Extension_Array());
$twig->addExtension(new Twig_Extensions_Extension_Date());

$faker = Faker\Factory::create();

$i = rand(0, 1);
$template = ['common.html.twig', '@base/base.html.twig'];


$users = array();
foreach(range(1, 10) as $li) {
    $user1 = new stdClass();
    $user1->fullname = $faker->name;
    $user1->active = rand(0, 1);
    $users[] = $user1;
}

class App {

    public function hello($name = 'world') {
        return 'Hello ' . $name;
    }
}

echo $twig->render('index.html.twig', array('app' => $faker, 'random_template' => $template[$i], 'users' => $users, 'obj' => new App()));

// {% extends layout %}

 // $layout = $twig->load('some_layout_template.twig');

// $twig->display('template.twig', array('layout' => $layout));

