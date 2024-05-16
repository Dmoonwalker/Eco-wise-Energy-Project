<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DynamoDbService
{
    /**
     * Query DynamoDB.
     *
     * @param string|null $exclusiveStartKey
     * @param string $sort
     * @param int $limit
     * @return array|null
     * @throws \Exception If an error occurs during DynamoDB query
     */
    public function query(string $exclusiveStartKey = null, string $sort = 'asc', int $limit = 10): ?array
    {
        try {
            // Execute DynamoDB query
            $result = DB::connection(env('CONNECTION_DYNAMODB'))
                ->table(env('TABLE'))
                ->keyCondition('DeviceId', '=', '0001')
                ->exclusiveStartKey($exclusiveStartKey)
                ->scanIndexForward($sort === 'desc' ? false : true)
                ->limit($limit)
                ->query();

            // Check if result is valid and has expected status code
            if (isset($result) && isset($result['@metadata']) && $result['@metadata']['statusCode'] === 200) {
                return $result['Items'];
            } else {
                // Log or handle unexpected result
                return null;
            }
        } catch (\Throwable $e) {
            // Log or handle the exception
            throw new \Exception('DynamoDB query failed: ' . $e->getMessage());
        }
    }
}
