<?php

require_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'cache' => 'cache',
]);

require_once 'partials/class/User.php';

$jsonFile = file_get_contents('dataset\users.json');
$jsonArray = json_decode($jsonFile, true);
$User = array();
$MaxID = 0;

foreach ($jsonArray as $i) {
  $User[] = new User($i['id'],
                      $i['name'],
                      $i['username'],
                      $i['email'],
                      $i['phone'],
                      $i['website'],
                      $i['address']['street'],
                      $i['address']['suite'],
                      $i['address']['city'],
                      $i['address']['zipcode'],
                      $i['address']['geo']['lat'],
                      $i['address']['geo']['lng'],
                      $i['company']['name'],
                      $i['company']['catchPhrase'],
                      $i['company']['bs']);
if ($MaxID < $i['id']){
    $MaxID = $i['id'];
}
}


if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST' AND isset($_GET["remove"]) AND !isset($_GET["step"]))
{
  unset($User[$_GET["remove"]]);
  $OutputData = json_encode(array_values($User), JSON_PRETTY_PRINT);
  file_put_contents('dataset\users.json', $OutputData);

  header("Location: index.php", true, 301);
}

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST' AND !isset($_GET["remove"]) AND isset($_GET["step"]) AND $_GET["step"] == 'add')
{

  $User[] = new User($MaxID + 1,
                      $_POST["name"],
                      $_POST["username"],
                      $_POST["email"],
                      $_POST["phone"],
                      null,
                      substr($_POST["address"], 0, strpos($_POST["address"], ',')),
                      null,
                      substr($_POST["address"], strrpos($_POST["address"], ' ') + 1, strrpos($_POST["address"], ' ')),
                      substr($_POST["address"], strpos($_POST["address"], ',') + 2, 10),
                      null,
                      null,
                      $_POST["company"],
                      null,
                      null);
  $OutputData = json_encode(array_values($User), JSON_PRETTY_PRINT);
  file_put_contents('dataset\users.json', $OutputData);

  header("Location: index.php", true, 301);
}

echo $twig->render('index.html', ["User" => $User]);
