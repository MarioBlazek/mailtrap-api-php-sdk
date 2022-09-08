<?php

declare(strict_types=1);

namespace Marek\Mailtrap\Core\Factory;

use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;

final class SerializerFactory
{
    public static function create(): SerializerInterface
    {
        $encoders = [];
        $reflectionExtractor = new ReflectionExtractor();
        $phpDocExtractor = new PhpDocExtractor();
        $propertyTypeExtractor = new PropertyInfoExtractor(
            [$reflectionExtractor], [$phpDocExtractor, $reflectionExtractor], [$phpDocExtractor], [$reflectionExtractor], [$reflectionExtractor]
        );
        $objectNormalizer = new ObjectNormalizer(
            null, new CamelCaseToSnakeCaseNameConverter(), null, $propertyTypeExtractor
        );
        $normalizers = [$objectNormalizer, new DateTimeNormalizer(), new ArrayDenormalizer()];

        return new Serializer($normalizers, $encoders);
    }

    public function create2(): SerializerInterface
    {
        $reflectionExtractor = new ReflectionExtractor();
        $phpDocExtractor = new PhpDocExtractor();
        $propertyTypeExtractor = new PropertyInfoExtractor(
            [$reflectionExtractor],
            [$phpDocExtractor, $reflectionExtractor],
            [$phpDocExtractor],
            [$reflectionExtractor],
            [$reflectionExtractor]
        );

        $normalizer = new ObjectNormalizer(
            null,
            null,
            null,
            $propertyTypeExtractor
        );
        $arrayNormalizer = new ArrayDenormalizer();
        return new Serializer([$arrayNormalizer, $normalizer]);
    }
}