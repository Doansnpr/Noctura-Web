<?php

namespace App\Repositories;

use MongoDB\BSON\ObjectId;
use MongoDB\Client as MongoClient;
use MongoDB\Collection;
use Illuminate\Support\Facades\Log;

class PredictionHistoryRepository
{
    private Collection $collection;

    public function __construct()
    {
        $client = new MongoClient(config('database.connections.mongodb.dsn'));
        $db     = config('database.connections.mongodb.database', 'noctura');

        $this->collection = $client->selectCollection($db, 'prediction_results');
    }

    /**
     * Paginate prediction results for a user with optional filter.
     */
    public function paginate(
        string  $userId,
        int     $page,
        int     $perPage,
        ?string $prediction
    ): array {
        $filter = ['user_id' => $userId];

        if ($prediction !== null && $prediction !== '') {
            $filter['prediction'] = $prediction;
        }

        $skip  = ($page - 1) * $perPage;
        $total = $this->collection->countDocuments($filter);

        $cursor = $this->collection->find($filter, [
            'sort'  => ['predicted_at' => -1],
            'skip'  => $skip,
            'limit' => $perPage,
        ]);

        $items = [];
        foreach ($cursor as $doc) {
            $items[] = $this->docToArray($doc);
        }

        return ['items' => $items, 'total' => $total];
    }

    /**
     * Find a single prediction by its ID, scoped to the user.
     */
    public function findByIdAndUser(string $id, string $userId): ?array
    {
        try {
            $doc = $this->collection->findOne([
                '_id'     => new ObjectId($id),
                'user_id' => $userId,
            ]);

            return $doc ? $this->docToArray($doc) : null;
        } catch (\Throwable $e) {
            Log::warning('PredictionHistoryRepository::findByIdAndUser failed', [
                'id'    => $id,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Soft-delete (or hard-delete) a prediction, scoped to the user.
     */
    public function deleteByIdAndUser(string $id, string $userId): bool
    {
        try {
            $result = $this->collection->deleteOne([
                '_id'     => new ObjectId($id),
                'user_id' => $userId,
            ]);

            return $result->getDeletedCount() > 0;
        } catch (\Throwable $e) {
            Log::warning('PredictionHistoryRepository::deleteByIdAndUser failed', [
                'id'    => $id,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Aggregate summary stats per prediction type for a user.
     */
    public function aggregateSummary(string $userId): array
    {
        $pipeline = [
            ['$match' => ['user_id' => $userId]],
            [
                '$group' => [
                    '_id'   => '$prediction',
                    'count' => ['$sum' => 1],
                    'latest'=> ['$max' => '$predicted_at'],
                ],
            ],
            ['$sort' => ['count' => -1]],
        ];

        $cursor = $this->collection->aggregate($pipeline);

        $byType     = [];
        $totalCount = 0;
        $latestDate = null;

        foreach ($cursor as $doc) {
            $type        = (string) $doc['_id'];
            $count       = (int)   $doc['count'];
            $latest      = $doc['latest'] ?? null;

            $byType[$type] = ['count' => $count, 'latest' => $latest];
            $totalCount   += $count;

            if ($latestDate === null || $latest > $latestDate) {
                $latestDate = $latest;
            }
        }

        return [
            'total'       => $totalCount,
            'by_type'     => $byType,
            'latest_date' => $latestDate,
        ];
    }

    // ── Private helpers ───────────────────────────────────────────────────────

    private function docToArray(object $doc): array
    {
        $arr = iterator_to_array($doc);

        // Convert ObjectId to string
        if (isset($arr['_id'])) {
            $arr['_id'] = (string) $arr['_id'];
        }

        // Decode nested BSON objects/arrays
        foreach ($arr as $key => $val) {
            if ($val instanceof \MongoDB\Model\BSONDocument) {
                $arr[$key] = (array) $val;
            } elseif ($val instanceof \MongoDB\Model\BSONArray) {
                $arr[$key] = $val->getArrayCopy();
            }
        }

        return $arr;
    }
}