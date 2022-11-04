<?php

namespace Gamesites\Payment\Integration\DirectBilling\Request;

use Gamesites\Payment\Dto\DetailInterface;
use Gamesites\Payment\Dto\PayerInterface;
use Gamesites\Payment\Operator\AbstractRequestOperator;
use Gamesites\Payment\Operator\RequestOperatorInterface;
use Symfony\Component\Form\FormInterface;

final class RequestBuilder extends AbstractRequestOperator implements RequestOperatorInterface
{
    public function getForm(DetailInterface $order, ?PayerInterface $payer = null): FormInterface
    {
        $this->authOperator->validate();

        $formData = [
            'SEKRET' => $this->authOperator->getFieldOne(),
            'KWOTA' => $order->getDiscountedPrice(),
            'PRZEKIEROWANIE_SUKCESS' => $this->uri,
            'PRZEKIEROWANIE_BLAD' => $this->uri,
            'ID_ZAMOWIENIA' => $order->getId(),
        ];

        $form = $this->formFactory->create(FormType::class);
        $form->submit($formData);

        return $form;
    }
}
