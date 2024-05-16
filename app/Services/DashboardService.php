<?php

namespace App\Services;

class DashboardService
{
    protected $dynamoDbService;

    /**
     * Constructor for DashboardService.
     *
     * @param DynamoDbService $dynamoDbService
     */
    public function __construct(DynamoDbService $dynamoDbService)
    {
        $this->dynamoDbService = $dynamoDbService;
    }

    /**
     * Fetch dashboard data.
     *
     * @return array
     */
    public function fetchDashboardData(): array
    {
        $attributes = ['CummulativeEnergyKwh', 'Timestamp', 'BoxStatus', 'DeviceId', 'Latitude', 'Longitude'];
        $queryResult = $this->dynamoDbService->query(null, 'desc', 2, $attributes);
        return $this->buildDashboard($queryResult);
    }

    /**
     * Fetch line chart data.
     *
     * @return array
     */
    public function fetchLineChartData(): array
    {
        $queryResult = $this->dynamoDbService->query(null, 'desc', 50);
        return $this->buildChart($queryResult);
    }

    /**
     * Generate CSV file.
     *
     * @return string
     * @throws \Exception
     */
    public function generateCSVFile(): string
    {
        try {
            $queryResultLast = $this->dynamoDbService->query(null, 'desc', 1000);
            $filePath = 'download/info.csv';
            $fp = fopen($filePath, 'w');
            if (!$fp) {
                throw new \Exception('Failed to open file for writing.');
            }
            fputcsv($fp, ['TIME', 'STATUS', 'ENERGY', 'LAT', 'LON', 'DEVICE', 'POWER', 'DATE']);

            foreach ($queryResultLast as &$result) {
                $timestamp = (intval($result['Time'])) + 3600;
                $formatted = date('M j, g:i a', $timestamp);
                $result['Date'] = $formatted;
                fputcsv($fp, $result);
            }

            fclose($fp);
            return public_path($filePath);
        } catch (\Throwable $e) {
            // Log or handle the exception
            throw new \Exception('Failed to generate CSV file: ' . $e->getMessage());
        }
    }

    /**
     * Build dashboard data.
     *
     * @param array $data
     * @return array
     */
    private function buildDashboard(array $data): array
    {
        $defaultValues = [
            'deviceNumber' => 1,
            'totalEnergy' => '0',
            'carbonCredit' => '0',
            'energyIncrease' => '0',
            'energyIncreaseStatus' => 'No Change',
            'lastSeen' => null,
            'boxStatus' => null,
            'deviceId' => null,
            'latitude' => 8.939933622431097,
            'longitude' => 7.3182034492492685,
        ];

        if (empty($data)) {
            return $defaultValues;
        }

        $latestData = $data[0] ?? [];
        $previousData = $data[1] ?? null;

        $totalEnergy = round(floatval($latestData['CummulativeEnergyKwh'] ?? 0), 3, PHP_ROUND_HALF_EVEN);
        $carbonCredit = $totalEnergy / 2.0;
        $lastSeen = $latestData['Timestamp'] ? $this->formatTimestamp($latestData['Timestamp'], 'M j, g:i a') : null;
        $energyIncrease = $previousData ? round($this->calculateEnergyIncrease($latestData, $previousData), 3, PHP_ROUND_HALF_EVEN) : 0;
        $energyIncreaseStatus = $energyIncrease > 0 ? 'Increase' : 'Decrease';

        return [
            'deviceNumber' => $defaultValues['deviceNumber'],
            'totalEnergy' => (string)$totalEnergy,
            'carbonCredit' => (string)$carbonCredit,
            'energyIncrease' => (string)$energyIncrease,
            'energyIncreaseStatus' => $energyIncreaseStatus,
            'lastSeen' => $lastSeen ?? $defaultValues['lastSeen'],
            'boxStatus' => $latestData['BoxStatus'] ?? $defaultValues['boxStatus'],
            'deviceId' => $latestData['DeviceId'] ?? $defaultValues['deviceId'],
            'latitude' => $latestData['Latitude'] != '0' ? $latestData['Latitude'] : $defaultValues['latitude'],
            'longitude' => $latestData['Longitude'] != '0' ? $latestData['Longitude'] : $defaultValues['longitude'],
        ];
    }

    /**
     * Calculate energy increase.
     *
     * @param array $latestData
     * @param array $previousData
     * @return float
     */
    private function calculateEnergyIncrease(array $latestData, array $previousData): float
    {
        $latestEnergy = $latestData['CummulativeEnergyKwh'];
        $previousEnergy = $previousData['CummulativeEnergyKwh'];

        if ($previousEnergy === 0) {
            return 0;
        }

        return (($latestEnergy - $previousEnergy) / $previousEnergy) * 100;
    }

    /**
     * Format timestamp.
     *
     * @param int|null $timestamp
     * @param string $format
     * @return string|null
     */
    private function formatTimestamp(?int $timestamp, string $format): ?string
    {
        if ($timestamp === null) {
            return null;
        }

        $timestamp += 3600; // Adjust for timezone difference
        return date($format, $timestamp);
    }

    /**
     * Build chart data.
     *
     * @param array $items
     * @return array
     */
    private function buildChart(array $items): array
    {
        $xAxis = array_map(function ($item) {
            return $this->formatTimestamp($item['Timestamp'], 'g:i a');
        }, $items);

        $yAxis = array_column($items, 'CurrentEnergyKwh');

        return ['label' => $xAxis, 'data' => $yAxis];
    }
}
