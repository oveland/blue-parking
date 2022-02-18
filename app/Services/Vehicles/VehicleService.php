<?php

namespace App\Services\Vehicles;

use App\Services\AWS\RekognitionService;

class VehicleService
{
    function decodePlate($photo): string
    {
        $rekognitionService = new RekognitionService();

        $textInPhoto = $rekognitionService->setPhoto($photo)->getText();

        $betterDetection = collect($textInPhoto)->filter(function ($data) {
            $text = $this->format($data['DetectedText']);
            $totalDigits = $this->countDigits($text);

            return strlen($text) == 6 && strtoupper($text) === $text && ($totalDigits == 2 || $totalDigits == 3);
        })->sortByDesc('Confidence')->first();

        return $this->format($betterDetection['DetectedText'] ?? "");
    }

    private function format($plate): string
    {
        $plate = trim($plate);
        $plate = str_replace(" ", "", $plate);
        $plate = str_replace("-", "", $plate);
        return str_replace(".", "", $plate);
    }

    private function countDigits($plate): int
    {
        return preg_match_all("/[0-9]/", $plate);
    }
}
