<?php

namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Firebase\JWT\JWT;
use Doctrine\ORM\EntityManager;
use Orders;

class OrderController
{

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function validateOrder(Request $request, Response $response, array $args): Response
    {
        $json = $request->getParsedBody()['products'];
        $login = $request->getParsedBody()['login'];
        $products = json_decode($json, true);
        $products = $products["productsIds"];
        $id_Commande = -1;
               
        $utilisateurRepository = $this->entityManager->getRepository('Utilisateur');

        $orderRepository = $this->entityManager->getRepository('Orders');

        $productRepository = $this->entityManager->getRepository('Products');
    
        $user = $utilisateurRepository->findOneBy(array('login' => $login ));
        if(!$user) {
            $response->getBody()->write(json_encode([
                "success" => false
            ]));
            return $response->withStatus(401);
        }

        if($ordersLastId = $orderRepository->findOneBy([], ['idCommande' => 'desc'])){
            $id_Commande = $ordersLastId->getIdCommande()+1;
        }
        else {
            $id_Commande = 0;
        }
        
 
        foreach ($products as $product) {
            $order = new Orders();
            $order->setIdCommande($id_Commande);
            $order->setQuantite($product["quantite"]);
            $order->setIdClient($user); 
            $order->setIdProduit($productRepository->findOneBy(array('id' => $product["id"] ))); 
            $this->entityManager->persist($order);
            $this->entityManager->flush();

        }

        $result = [
            "success" => true,
            "order" => $id_Commande
        ];
        $response->getBody()->write(json_encode($result)); 
        return $response->withStatus(200);
    }
    
}
