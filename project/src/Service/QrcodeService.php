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

    public function qrcode($data): string
    {

        /** @var TYPE_NAME $profil */
        $profil = nl2br(
            'Prenom: '.$data['firstname'].

            ' Nom : '.$data['secondname'].

            ' Profession: '.$data['profession']);

        $path = dirname(__DIR__, 2).'/public/assets/';

        $result = $this->builder
            ->data($profil)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->logoPath($path.'img/sonexcellence.jpg')
            ->logoResizeToWidth('50')
            ->logoResizeToHeight('50')
            ->logoPunchoutBackground(true)
            ->backgroundColor(new Color(249, 250, 250))
            ->build();

        //generate name
        $namePng = uniqid('', '') . '.png';

        //Save img png
        $result->saveToFile($path.'qr-code/'.$namePng);

        return $result->getDataUri();

    }

}