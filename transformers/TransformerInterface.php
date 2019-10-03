<?php

namespace app\transformers;

/**
 * Interface TransformerInterface
 * @package app\transformers
 */
interface TransformerInterface
{
    /**
     * Transform provided data in array to Model
     *
     * @param array $data
     * @return array
     */
    public function transform(array $data): array;
}
