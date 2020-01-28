<?php
namespace App\Controller\Backend;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Service\ProductService;
use Response;

class SaveController
{
    protected function isValidField(string $field) : bool
    {
        return ((!isset($field)) || (empty($field))) ? false : true;
    }

    /**
     * Returns a JSON Response including the whole list of products in case of success
     * @param Request $request
     * @param ProductService $productService
     * 
     * @return JsonResponse
     *
     */
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

            if (!$this->isValidField($paramsPost['price'])){
                return new JsonResponse([
                    'success' => false,
                    'code' => Response::BAD_REQUEST,
                    'message' => "Price es requerido para guardar producto",
                ]);
            }

            if (!$this->isValidField($paramsPost['barcode'])){
                return new JsonResponse([
                    'success' => false,
                    'code' => Response::BAD_REQUEST,
                    'message' => "Barcode requerido para guardar producto",
                ]);
            }

            if (!$this->isValidField($paramsPost['name'])){
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
            $productService->save($product);

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
