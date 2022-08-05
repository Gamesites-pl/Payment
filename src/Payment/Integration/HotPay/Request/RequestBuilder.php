<?php

namespace Gamesites\Payment\Integration\HotPay\Request;

use Gamesites\Payment\Dto\DetailInterface;
use Symfony\Component\Form\FormInterface;
use Gamesites\Payment\Dto\PriceInterface;
use Gamesites\Payment\Operator\AbstractRequestOperator;
use Gamesites\Payment\Operator\RequestOperatorInterface;

final class RequestBuilder extends AbstractRequestOperator implements RequestOperatorInterface
{
    public function getForm(array $requestData, PriceInterface|DetailInterface $order): FormInterface
    {
        $this->operatorData->validate();

        $formData = [
            'SEKRET' => $this->operatorData->getFieldOne(),
            'KWOTA' => $order->getDiscountedPrice(),
            'NAZWA_USLUGI' => $order->getName(),
            'ADRES_WWW' => sprintf('%s/payment', $this->uri),
            'ID_ZAMOWIENIA' => $requestData['orderId'],
            'EMAIL' => $requestData['email']
        ];

        $form = $this->formFactory->create(FormType::class);
        $form->submit($formData);

        return $form;
    }
}
