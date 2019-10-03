<?php

namespace app\transformers;

class LoanTransformer implements TransformerInterface
{
    public function transform(array $data): array
    {
        return [
            'Loan' => [
                'id' => $data['id'],
                'user_id' => $data['user_id'],
                'amount' => $data['amount'],
                'interest' => $data['interest'],
                'duration' => $data['duration'],
                'start_date' => gmdate('Y-m-d H:i:s', $data['start_date']),
                'end_date' => gmdate('Y-m-d H:i:s', $data['end_date']),
                'campaign' => $data['campaign'],
                'status' => (bool)$data['status']
            ]
        ];
    }

}
