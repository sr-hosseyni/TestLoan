<?php

namespace app\transformers;

/**
 * Class UserTransformer
 * @package app\transformers
 */
class UserTransformer implements TransformerInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function transform(array $data): array
    {
        return [
            'User' => [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'personal_code' => $data['personal_code'],
                'phone' => $data['phone'],
                'active' => $data['active'],
                'dead' => $data['dead'],
                'lang' => $data['lang']
            ]
        ];
    }

}
