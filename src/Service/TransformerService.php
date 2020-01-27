<?php
namespace App\Service;

Use JMS\Serializer\SerializerBuilder;

class TransformerService
{

    public function transform(array $object) : array
    {
        $serializer = SerializerBuilder::create()->build();
        $json = $serializer->serialize($object, 'json');
        return json_decode($json,true);
    }

}