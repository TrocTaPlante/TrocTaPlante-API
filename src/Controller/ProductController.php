<?php

namespace App\Controller;

use App\Entity\Product;
use App\Helpers\Serialize;
use App\Repository\GenusRepository;
use App\Repository\ProductRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProductController extends AbstractController
{
    #[Route('/api/v1/product/create', methods: 'POST')]
    public function createProduct(Request $request, GenusRepository $genusRepository, ProductRepository $productRepository): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            $product = new Product();

            switch ($data["genus"]){
                case "1": //Plante
                    $product->setQuantity($data["quantity"]);
                    $product->setGenus($genusRepository->findOneBy(["id" => $data["genus"]]));
                    $product->setState($data["state"]);
                    $product->setHeight($data["height"]);
                    $product->setPotHeight($data["pot_height"]);
                    $product->setPotWidth($data["pot_width"]);
                    $product->setSpecies($data["species"]);
                    $product->setUser($this->getUser());
                    $product->setLatitude($data["latitude"]);
                    $product->setLongitude($data["longitude"]);
                    $product->setPostStatus($data["post_status"]);
                    $product->setDescription($data["description"]);
                    break;
                case "2": //Graine
                    $product->setQuantity($data["quantity"]);
                    $product->setGenus($genusRepository->findOneBy(["id" => $data["genus"]]));
                    $product->setState($data["state"]);
                    $product->setPotWidth($data["pot_width"]);
                    $product->setPotHeight($data["pot_height"]);
                    $product->setSpecies($data["species"]);
                    $product->setUser($this->getUser());
                    $product->setLatitude($data["latitude"]);
                    $product->setLongitude($data["longitude"]);
                    $product->setPostStatus($data["post_status"]);
                    $product->setDescription($data["description"]);
                    break;
            }

            $productRepository->save($product, true);

            return new JsonResponse('Product créé avec succès', 201, ["Content-Type" => "application/json"]);
        }catch (Exception $exception){
            return new JsonResponse($exception->getMessage(), 500);
        }
    }

    #[Route('/api/v1/product', methods: 'GET')]
    public function getProducts(ProductRepository $productRepository,SerializerInterface $serializer): JsonResponse
    {
        try {
            return new JsonResponse(Serialize::serializeProduct($serializer, $productRepository->findAll()), 200, ["Content-Type" => "application/json"]);
        } catch (Exception $exception) {
            return new JsonResponse($exception->getMessage(), 500);
        }
    }

    #[Route('/api/v1/getproductsforcurrentuser', methods: 'GET')]
    public function getProductByUser(ProductRepository $productRepository,SerializerInterface $serializer): JsonResponse
    {
        try {
            return new JsonResponse(Serialize::serializeProduct($serializer, $productRepository->findBy(["user" => $this->getUser()])), 200, ["Content-Type" => "application/json"]);
        }catch (Exception $exception){
            return new JsonResponse($exception->getMessage(), 500);
        }
    }

    #[Route('/api/v1/product/{id}', methods: 'PUT')]
    public function updateProduct(Request $request, Product $product, ProductRepository $productRepository, SerializerInterface $serializer): JsonResponse
    {
        try {
            $userId = $this->getUser()->getId();
            $productCreatorId = $product->getUser()->getId();

            if ($this->getUser()->getRoles()[0] == "USER") {
                if ($userId != $productCreatorId) {
                    return new JsonResponse("Vous n'avez pas les droits pour modifier ce produit", 403);
                }
            }

            $formData = json_decode($request->getContent(), true);
            $product->setQuantity($formData["quantity"]);
            $product->setState($formData["state"]);
            $product->setHeight($formData["height"]);
            $product->setPotHeight($formData["pot_height"]);
            $product->setPotWidth($formData["pot_width"]);
            $product->setSpecies($formData["species"]);

            $updateProduct = $productRepository->updateProduct($product);

            if($updateProduct == 0){
                return new JsonResponse("Le produit n'a pas été modifié", 304, ["Content-Type" => "application/json"]);
            }

            $updatedProduct = Serialize::serializeProduct($serializer, $productRepository->findOneBy(["id" => $product->getId()]));

            return new JsonResponse($updatedProduct, 200, ["Content-Type" => "application/json"]);
        }catch (Exception $exception){
            return new JsonResponse($exception->getMessage(), 500);
        }
    }

    #[Route('/api/v1/product/{id}', methods: 'DELETE')]
    public function deleteProduct(Product $product, ProductRepository $productRepository): JsonResponse
    {
        try {
            $userId = $this->getUser()->getId();
            $productCreatorId = $product->getUser()->getId();

            if ($this->getUser()->getRoles()[0] == "USER") {
                if ($userId != $productCreatorId) {
                    return new JsonResponse("Vous n'avez pas les droits pour modifier ce produit", 403);
                }
            }

            $productRepository->remove($product, true);

            return new JsonResponse("Le produit a été supprimé avec succès", 200, ["Content-Type" => "application/json"]);
        }catch (Exception $exception){
            return new JsonResponse($exception->getMessage(), 500);
        }
    }

    #[Route('/api/product/{id}', methods: 'GET')]
    public function getOneProduct(Product $product, SerializerInterface $serializer): JsonResponse
    {
        try {
            return new JsonResponse(Serialize::serializeProduct($serializer, $product), 200, ["Content-Type" => "application/json"]);
        }catch (Exception $exception){
            return new JsonResponse($exception->getMessage(), 500);
        }
    }

}
