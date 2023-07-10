<?php

namespace App\Service;

use DateTime;

class DateFormatService
{
    public function formatDateArray(array $data, string $dateFormat = 'Y-m-d'): array
    {
        return array_map(function ($date, $item) use ($dateFormat) {
            return [
                'date' => (DateTime::createFromFormat('Y-m-d', $date))->format($dateFormat),
                'count' => $item
            ];
        }, array_keys($data), $data);
    }
}
