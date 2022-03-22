<?php


namespace App\Service;


use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;


class QrcodeService
{
    /**
     * @var BuilderInterface
     * @Author Son Excellence WADE IT Engineer | Fullstack Developer
     */
    protected $builder;

    public function __construct(BuilderInterface $builder )
    {
        $this->builder = $builder;
    }

    public function qrcode($query): string
    {
        $url = 'https://www.google.com/search?q=';

        $path = dirname(__DIR__, 2).'/public/assets/';

        $result = $this->builder
            ->data($url.$query)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(400)
            ->margin(10)
            ->logoPath($path.'img/coudepouce.png')
            ->logoResizeToWidth('95')
            ->logoResizeToHeight('95')
            ->logoPunchoutBackground(true)
            ->backgroundColor(new Color(203, 229, 236))
            ->build()
           ;

        //generate name
        $namePng = uniqid('', '') . '.png';

        //Save img png
        $result->saveToFile($path.'qr-code/'.$namePng);

        return $result->getDataUri();

    }

}