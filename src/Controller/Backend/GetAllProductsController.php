<?php
namespace App\Controller\Backend;

use App\Service\ProductService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Service\Transformer\TransformerService;

class GetAllProductsController
{
    /**
     * Returns a JSON Response including the whole list of products in case of success
     * @param Request request
     * @param ProductService $productService
     * @param TransformerService $transformer
     * @return JsonResponse
     *
     */
    public function index(Request $request, ProductService $productService, TransformerService $transformer) : JsonResponse
    {
        try {

            $result =  $productService->getAllProducts();
            $products = $transformer->transform($result);

            return new JsonResponse([
                'success' => true,
                'code' => Response::HTTP_OK,
                'message' => $products,
            ]);

        } catch(\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }
}
