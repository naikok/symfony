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

    /**
     * Save a product into database
     * @param Product product of type Entity
     * @return Product[]
     * @return bool
     */

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

    /**
     * Return a list of products from database
     *
     * @return Product[]
     *
     */

    public function getAllProducts() : array
    {
        return $this->productRepository->findAll(); //native doctrine query
    }

    /**
     * Creates an entity class
     * @param \StdClass $data containing and object that will be converted into an Entity
     * @return Product
     *
     */

    public function create(\StdClass $data) : Product
    {
        $product = new Product();
        $product->setName($data->name);
        $product->setPrice($data->price);
        $product->setBarCode($data->barcode);

        return $product;
    }
}