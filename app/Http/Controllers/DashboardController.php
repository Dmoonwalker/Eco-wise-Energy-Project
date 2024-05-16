<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\DashboardService;
use App\Services\IoTService;

class DashboardController extends Controller
{
    protected $dashboardService;
    protected $iotService;

    public function __construct(DashboardService $dashboardService, IoTService $iotService)
    {
        $this->dashboardService = $dashboardService;
        $this->iotService = $iotService;
    }

    /**
     * Display the dashboard.
     */
    public function index()
    {
        $deviceData = $this->dashboardService->fetchDashboardData();
        return view('dashboard')->with('deviceData', $deviceData);
    }

    /**
     * Handle AJAX request to update the dashboard.
     */
    public function updateBoard()
    {
        $deviceData = $this->dashboardService->fetchDashboardData();
        return response()->json($deviceData);
    }

    /**
     * Handle AJAX request to get line chart data.
     */
    public function loadLineChart()
    {
        $chartData = $this->dashboardService->fetchLineChartData();
        return response()->json($chartData);
    }

    /**
     * Get device information.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function getDeviceInfo($id)
    {
        $deviceData = $this->dashboardService->fetchDashboardData();
        return view('deviceInfo')->with('deviceData', $deviceData);
    }

    /**
     * Download device data as CSV.
     *
     * @param string $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile($id)
    {
        $filePath = $this->dashboardService->generateCSVFile();
        return response()->download($filePath, 'info.csv', ['Content-Type' => 'text/csv']);
    }

    /**
     * Reset the energy meter.
     *
     * @return array
     */
    public function resetEnergyMeter()
    {
        $this->iotService->publishMessage('1');
        return ['success' => 'successful'];
    }

    /**
     * Reset the limit status.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetLimitStatus()
    {
        $this->iotService->publishMessage('2');
        return redirect()->back()->with('success', 'Reset Limit Successful');
    }
}
