<?php

namespace Gamesites\Payment\Integration\TPay\Request;

use Gamesites\Payment\Dto\DetailInterface;
use Gamesites\Payment\Dto\PayerInterface;
use Symfony\Component\Form\FormInterface;
use Gamesites\Payment\Operator\AbstractRequestOperator;
use Gamesites\Payment\Operator\RequestOperatorInterface;

final class RequestBuilder extends AbstractRequestOperator implements RequestOperatorInterface
{
    public function getForm(DetailInterface $order, ?PayerInterface $payer = null): FormInterface
    {
        $this->authOperator->validate();

        $formData = [
            'id' => $order->getId(),
            'amount' => $order->getDiscountedPrice(),
            'description' => $order->getName(),
            'crc' => $order->getId(),
            'return_url' => $this->uri,
        ];

        $formData['md5sum'] = md5(implode('&', [$order->getId(), $order->getDiscountedPrice(), $order->getName() . ' ' . $order->getId(), $this->authOperator->getFieldOne()]));

        $form = $this->formFactory->create(FormType::class);
        $form->submit($formData);

        return $form;
    }
}
