<?php

namespace App\Helpers;

use App\Entity\Product;
use Symfony\Component\Serializer\SerializerInterface;

class Serialize
{
    /**
     * Permet de sérialiser un produit et d'avoir le champ createdAt et updatedAt dans le JSON retourné par l'API
     * @param SerializerInterface $serializer
     * @param Product[] $product
     * @return mixed[]
     */
    public static function serializeProduct(SerializerInterface $serializer, array | Product $product)
    {
        return $serializer->normalize($product, null, ['attributes' => [
            'id',
            'quantity',
            'state',
            'height',
            'pot_width',
            'pot_height',
            'species',
            'createdAt',
            'updatedAt',
            'user' => [
                'id',
                'username',
                'roles',
                'email',
                'firstName',
                'lastName',
                'address',
                'city',
                'zipcode',
                'phone',
                'longitude',
                'latitude',
                'isValidated',
                'isBloqued',
                'street_name',
                'street_number',
                'createdAt',
                'updatedAt'
            ],
            'genus' => [
                'name'
            ]
        ]]);
    }

    public static function serializeUser(SerializerInterface $serializer, array | User $users ){
        return $serializer->normalize($users, null, ['attributes' => [
            'id',
            'username',
            'roles',
            'email',
            'firstName',
            'lastName',
            'address',
            'city',
            'zipcode',
            'phone',
            'longitude',
            'latitude',
            'isValidated',
            'isBloqued',
            'street_name',
            'street_number',
            'createdAt',
            'updatedAt'
        ]]);
    }
}