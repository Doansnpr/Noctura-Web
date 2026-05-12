<?php

namespace App\Services;

use App\Repositories\PredictionHistoryRepository;

class PredictionHistoryService
{
    public function __construct(
        private readonly PredictionHistoryRepository $repository
    ) {}

    public function getHistory(string $userId, int $page, int $perPage, string $filter): array
    {
        $prediction = $filter !== 'all' ? $this->filterToPredictionLabel($filter) : null;
        $result = $this->repository->paginate($userId, $page, $perPage, $prediction);

        return [
            'items'      => array_map([$this, 'formatItem'], $result['items']),
            'pagination' => [
                'total'       => $result['total'],
                'page'        => $page,
                'per_page'    => $perPage,
                'total_pages' => (int) ceil($result['total'] / $perPage),
                'has_next'    => ($page * $perPage) < $result['total'],
                'has_prev'    => $page > 1,
            ],
        ];
    }

    public function getDetail(string $userId, string $id): ?array
    {
        $item = $this->repository->findByIdAndUser($id, $userId);
        return $item ? $this->formatItem($item) : null;
    }

    public function delete(string $userId, string $id): bool
    {
        return $this->repository->deleteByIdAndUser($id, $userId);
    }

    public function getSummary(string $userId): array
    {
        return $this->repository->aggregateSummary($userId);
    }

    private function formatItem(array $doc): array
    {
        $confidence = $doc['confidence'] ?? [];
        if (is_string($confidence)) {
            $confidence = json_decode($confidence, true) ?? [];
        }

        return [
            'id'           => (string) ($doc['_id'] ?? $doc['id'] ?? ''),
            'prediction'   => $doc['prediction']  ?? '',
            'label'        => $doc['label']        ?? '',
            'color'        => $doc['color']        ?? '#4F46E5',
            'bg_color'     => $doc['bg_color']     ?? '#EEF2FF',
            'confidence'   => $confidence,
            'description'  => $doc['description'] ?? '',
            'suggestions'  => $doc['suggestions'] ?? [],
            'predicted_at' => $doc['predicted_at'] ?? null,
        ];
    }

    private function filterToPredictionLabel(string $filter): string
    {
        return match ($filter) {
            'healthy'     => 'Healthy',
            'insomnia'    => 'Insomnia',
            'sleep_apnea' => 'Sleep Apnea',
            default       => '',
        };
    }
}