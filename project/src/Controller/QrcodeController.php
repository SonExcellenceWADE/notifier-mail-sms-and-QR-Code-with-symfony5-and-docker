<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Service\QrcodeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QrcodeController extends AbstractController
{
    const QRCODE = 'qrCode';

    /**
     * @Route("/api/new/qrcode", name="app_qrcode")
     */
    public function index(Request $request, QrcodeService $qrcodeService): Response
    {
        $qrCode = null;
        $form = $this->createForm(SearchType::class, null);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $qrCode = $qrcodeService->qrcode($data);
        }

        return $this->render('qrcode/index.html.twig', [
            'form' => $form->createView(),
            self::QRCODE => $qrCode
        ]);
    }
}
