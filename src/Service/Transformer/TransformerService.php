<?php
namespace App\Service\Transformer;

use JMS\Serializer\SerializerBuilder;

class TransformerService
{
    /**
     * Transform entities to array of stdclass
     * @param array $object contain an entity of any type
     * @return \Stclass[]
     *
     */

    public function transform(array $object) : array
    {
        $serializer = SerializerBuilder::create()->build();
        $json = $serializer->serialize($object, 'json');
        return json_decode($json,true);
    }

}