<?php

namespace Gamesites\Payment\Integration\HotPay\Request;

use Gamesites\Payment\Dto\DetailInterface;
use Gamesites\Payment\Dto\PayerInterface;
use Gamesites\Payment\Operator\AbstractRequestOperator;
use Gamesites\Payment\Operator\RequestOperatorInterface;
use Symfony\Component\Form\FormInterface;

class RequestBuilder extends AbstractRequestOperator implements RequestOperatorInterface
{
    protected const FORM_TYPE = FormType::class;

    public function getForm(DetailInterface $order, ?PayerInterface $payer = null): FormInterface
    {
        $this->authOperator->validate();

        $formData = [
            'SEKRET' => $this->authOperator->getFieldOne(),
            'KWOTA' => $order->getDiscountedPrice(),
            'NAZWA_USLUGI' => $order->getName(),
            'ADRES_WWW' => $this->uri,
            'ID_ZAMOWIENIA' => $order->getId(),
            'EMAIL' => $payer->getEmail() ?: ''
        ];

        $form = $this->formFactory->create($this::FORM_TYPE);
        $form->submit($formData);

        return $form;
    }
}
