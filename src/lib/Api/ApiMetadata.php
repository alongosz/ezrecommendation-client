<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace EzSystems\EzRecommendationClient\Api;

abstract class ApiMetadata
{
    /**
     * @param \EzSystems\EzRecommendationClient\Api\ApiMetadata $instance
     * @param string[] $parameters
     */
    public function __construct(self $instance, array $parameters)
    {
        foreach ($parameters as $parameterKey => $parameterValue) {
            if (property_exists($instance, $parameterKey)) {
                $instance->$parameterKey = $parameterValue;
            }
        }
    }

    /**
     * @return array
     */
    abstract public function getMetadataAttributes(): array;

    /**
     * @param string[] $attributes
     * @param string $queryStringKey
     *
     * @return array
     */
    protected function getAdditionalAttributesToQueryString(array $attributes, string $queryStringKey): array
    {
        $extractedAttributes = [];

        foreach ($attributes as $attribute) {
            $extractedAttributes[] = [$queryStringKey => $attribute];
        }

        return $extractedAttributes;
    }
}
