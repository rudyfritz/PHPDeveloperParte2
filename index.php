<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';


$app = new \Slim\App;



$app->get('/', function (Request $request, Response $response) {

  // Abrir el archivo JSON
	$data = file_get_contents("employees.json");
	$employees = json_decode("$data", true);
	$email = "";
	// Mostrar en tabla la informacion parseada
	$response->getBody()->write("<br><h1>List of employees<h1>");
    $response->getBody()->write("<input type='text' id = 'email' name='email' placeholder='Input email'><input type='reset' id='buscar' value='find'><br><br>");
    $response->getBody()->write("<table border='1'>");
    $response->getBody()->write("<tr>");
    $response->getBody()->write("<th> name </th>");
    $response->getBody()->write("<th> email </th>");
    $response->getBody()->write("<th> position </th>");
    $response->getBody()->write("<th> salary </th>");
    $response->getBody()->write("<th> detail </th>");
    $response->getBody()->write("</tr>");

	foreach ($employees as $key => $value) {
		
		
			$response->getBody()->write("<tr>");
			$response->getBody()->write('<td>'. $value["name"] . '</td>');
			$response->getBody()->write('<td>'. $value["email"] . '</td>');
			$response->getBody()->write('<td>'. $value["position"] . '</td>');
			$response->getBody()->write('<td>'. $value["salary"] . '</td>');
			$response->getBody()->write("<td> <a href = 'detail.php/".$value["id"]."' target='_blank'> detail </a>");
			$response->getBody()->write("</tr>");
	
		
	}

    $response->getBody()->write("</table>");

    return $response;
});


$app->run();

?>