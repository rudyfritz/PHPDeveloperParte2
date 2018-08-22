<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';


$app = new \Slim\App;


$app->get('/{id}', function (Request $request, Response $response) {


	// Obtener el valor del parametro "id" que se envia desde index.php

    $id = $request->getAttribute('id');


  	// Abrir el archivo JSON
	$data = file_get_contents("employees.json");
	$employees = json_decode("$data", true);

	// Mostrar en tabla la informacion parseada

	$response->getBody()->write("<br><h1>Detail employed<h1><br>");


    $response->getBody()->write("<table border='1'>");
    $response->getBody()->write("<tr>");
    $response->getBody()->write("<th> name </th>");
    $response->getBody()->write("<th> email </th>");
    $response->getBody()->write("<th> phone </th>");
    $response->getBody()->write("<th> address </th>");
    $response->getBody()->write("<th> position </th>");
    $response->getBody()->write("<th> salary </th>"); 
    $response->getBody()->write("<th> skills </th>");  
    $response->getBody()->write("</tr>");


	foreach ($employees as $key => $value) {

		if(strcmp($value["id"], $id) == 0)
		{
			$response->getBody()->write("<tr>");
			$response->getBody()->write('<td>'. $value["name"] . '</td>');
			$response->getBody()->write('<td>'. $value["email"] . '</td>');
			$response->getBody()->write('<td>'. $value["phone"] . '</td>');
			$response->getBody()->write('<td>'. $value["address"] . '</td>');			
			$response->getBody()->write('<td>'. $value["position"] . '</td>');
			$response->getBody()->write('<td>'. $value["salary"] . '</td>');
			//Parsear Array skills
			$response->getBody()->write("<td>");
			foreach ($value["skills"] as $key => $skill) {				
				$response->getBody()->write('<li>'. $skill["skill"] . '</li>');	
			}
			$response->getBody()->write('</td>');

			
			
			$response->getBody()->write("</tr>");

		}
		
	}

    $response->getBody()->write("</table>");


    return $response;
});


$app->run();

?>