<?php

namespace App\Services\AWS;

use Aws\Credentials\Credentials;
use Aws\Rekognition\RekognitionClient;

class RekognitionService
{
    public $photo;

    private $rekognition;

    public function __construct()
    {
        $options = [
            'credentials' => new Credentials(config('aws.rekognition.key'), config('aws.rekognition.secret')),
            'region' => 'us-west-2',
            'version' => 'latest'
        ];

        $this->rekognition = new RekognitionClient($options);
    }

    public function setPhoto($photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getText(): object
    {
        $result = $this->rekognition->detectText([
            'Filters' => [
                'WordFilter' => [
                    'MinConfidence' => 50,
                ],
            ],
            'Image' => [
                'Bytes' => $this->photo,
            ],
        ]);

        return $this->castTextResponse($result);
    }

    private function castTextResponse($result): object
    {
        return $result;
    }

    private function fillBox($data, $confidence = null): object
    {
        $boundingBox = $data['BoundingBox'];

        $left = $boundingBox['Left'] * 100;
        $top = $boundingBox['Top'] * 100;
        $width = $boundingBox['Width'] * 100;
        $height = $boundingBox['Height'] * 100;

        $confidence = isset($data['Confidence']) ? floatval(number_format($data['Confidence'], 1)) : intval($confidence);

        return (object)[
            'box' => (object)[
                'width' => $width,
                'height' => $height,
                'left' => $left,
                'top' => $top,
            ],
            'confidence' => $confidence
        ];
    }
}
