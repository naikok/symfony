<?php
namespace App\Service;

use App\PersistenceService\PersistenceService;
use App\PersistenceService\IPersistenceService;
use App\Entity\Product;
use App\Repository\ProductRepository;



use Doctrine\ORM\EntityManagerInterface;

class ProductService extends PersistenceService
{
    protected $productRepository;

    public function __construct(EntityManagerInterface $entityManager, ProductRepository $productRepository)
    {
        parent::__construct($entityManager);
        $this->productRepository = $productRepository;
    }

    public function save(Product $product) : bool
    {
        try {
            $this->getEntityManager()->persist($product);
            $this->getEntityManager()->flush();
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }

    public function getAllProducts() : array
    {
        return $this->productRepository->findAll();
    }

    public function create(\StdClass $data) : Product
    {
        $product = new Product();
        $product->setName($data->name);
        $product->setPrice($data->price);
        $product->setBarCode($data->barcode);

        return $product;
    }
}