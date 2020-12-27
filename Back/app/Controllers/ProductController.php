<?php

namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Doctrine\ORM\EntityManager;


class ProductController
{

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function getAllProducts(Request $request, Response $response, array $args): Response
    {
        $productRepository = $this->entityManager->getRepository('Products');
        $products = $productRepository->findAll();
        $responseArray = [];
        foreach ($products as $product) {

           array_push($responseArray, [
            "id" => $product->getId(), 
           "nom" => $product->getNom(),
           "prix" => $product->getPrix(),
           "type" => $product->getType(),
           "categorie" => $product->getCategorie(),
           "pathImg" => $product->getPathimg(),
           "description" => $product->getDescription()
            ]);
        }
   
        
        $response->getBody()->write(json_encode($responseArray));
        return $response->withStatus(200);
    }
}
