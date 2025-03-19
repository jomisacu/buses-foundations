<?php

declare(strict_types=1);

namespace Jomisacu\BusesFoundations;

abstract class QueryResponse implements QueryResponseInterface
{
    public function toJson(): string
    {
        return \json_encode($this->toArray());
    }

    public function toArray(): array
    {
        $properties = get_object_vars($this);

        $data = [];
        foreach ($properties as $property) {
            $value = $this->$property;

            if ($value instanceof QueryResponseInterface) {
                $value = $value->toArray();
            }

            $data[$property] = $value;
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
