<?php

namespace Gamesites\Payment\Integration\Przelewy24\Request;

use Gamesites\Payment\Dto\PayerInterface;
use Symfony\Component\Form\FormInterface;
use GuzzleHttp\Exception\GuzzleException;
use Gamesites\Payment\Dto\DetailInterface;
use Gamesites\Payment\Operator\AbstractRequestOperator;
use Gamesites\Payment\Operator\RequestOperatorInterface;

final class RequestBuilder extends AbstractRequestOperator implements RequestOperatorInterface
{
    /** @throws GuzzleException */
    public function getForm(DetailInterface $order, ?PayerInterface $payer = null): FormInterface
    {
        $this->authOperator->validate();
        $token = $this->getToken($order, $payer);

        $form = $this->formFactory->create(FormType::class, [], [
            'action' => $this->uri . UriEnum::TOKEN_REDIRECT->value . $token,
        ]);
        $form->submit([]);

        return $form;
    }

    /** @throws GuzzleException */
    private function getToken(DetailInterface $order, ?PayerInterface $payer = null)
    {
        $sessionId = $order->getId();

        $data = [
            'merchantId' => $this->authOperator->getFieldOne(),
            'posId' => $this->authOperator->getFieldOne(),
            'sessionId' => $sessionId,
            'amount' => $order->getPrice(),
            'description' => $order->getName(),
            'email' => $payer->getEmail(),
            'country' => $order->getCountry(),
            'urlReturn' => $this->statusUri,
            'currency' => 'PLN',
            'sign' => hash(
                'sha384', json_encode([
                    'sessionId' => $sessionId,
                    'merchantId' => $this->authOperator->getFieldOne(),
                    'amount' => $order->getPrice(),
                    'currency' => 'PLN',
                    'crc' => $this->authOperator->getFieldThree(),
                ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            ),
            'language' => 'pl',
        ];

        $client = new RestClient();

        return $client->post($this->uri . UriEnum::API_TRANSACTION_REGISTER->value, $data, $this->authOperator->getFieldTwo())['data']['token'];
    }
}
