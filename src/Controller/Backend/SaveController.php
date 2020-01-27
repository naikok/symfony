<?php
namespace App\Controller\Backend;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Service\ProductService;
use Response;

class SaveController
{

    public function index(Request $request, ProductService $productService) : JsonResponse
    {

        try {

            $paramsPost = $request->getContent();
            $paramsPost = json_decode($paramsPost, true);

            if (!is_array($paramsPost)) {
                return new JsonResponse([
                    'success' => false,
                    'code' => Response::BAD_REQUEST,
                    'message' => "Parametros no encontrados para guardar producto",
                ]);
            }

            if ((!isset($paramsPost['price'])) && (!empty($paramsPost['price']))){
                return new JsonResponse([
                    'success' => false,
                    'code' => Response::BAD_REQUEST,
                    'message' => "Precio requerido para guardar producto",
                ]);
            }

            if ((!isset($paramsPost['barcode'])) && (!empty($paramsPost['barcode']))){
                return new JsonResponse([
                    'success' => false,
                    'code' => Response::BAD_REQUEST,
                    'message' => "Barcode requerido para guardar producto",
                ]);
            }

            if ((!isset($paramsPost['name'])) && (!empty($paramsPost['name']))){
                return new JsonResponse([
                    'success' => false,
                    'code' => Response::BAD_REQUEST,
                    'message' => "Name requerido para guardar producto",
                ]);
            }


            $name = $paramsPost['name'];
            $price = (float) $paramsPost['price'];
            $barcode = $paramsPost['barcode'];

            $data = new \Stdclass();
            $data->name = $name;
            $data->price = $price;
            $data->barcode = $barcode;



            $product = $productService->create($data);
            try {
                $productService->getEntityManager()->persist($product);
                $productService->getEntityManager()->flush();
            }catch(\Exception $e) {
                return new JsonResponse([
                    'success' => false,
                    'code' => 200,
                    'message' => $e->getMessage(),
                ]);
            }

            //$productService->save($product);

            return new JsonResponse([
                'success' => false,
                'code' => 200,
                'message' => "Product saved properly",
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
