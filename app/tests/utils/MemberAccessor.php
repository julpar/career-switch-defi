<?php
namespace app\tests\utils;

use ReflectionClass;
use ReflectionProperty;

class MemberAccessor
{
    /**
     * Get property of a subject class or object
     */
    public static function get(string|object $subject, string $propertyName): mixed
    {
        $property = static::getPropertyOf($subject, $propertyName);

        /** @psalm-suppress PossiblyInvalidArgument */
        return $property->isStatic() ?
            $property->getValue() :
            $property->getValue($subject);
    }
    
    /**
     * Get reflection property of a subject
     */
    private static function getPropertyOf(string|object $subject, string $propertyName): ReflectionProperty
    {
        if (is_string($subject) && class_exists($subject)) {
            $class = new ReflectionClass($subject);
        } else {
            /** @psalm-suppress PossiblyInvalidArgument */
            $class = new ReflectionClass(get_class($subject));
        }

        $property = $class->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }
}