<?php

namespace Gamesites\Payment\Integration\Przelewy24\Response;

use GuzzleHttp\Exception\GuzzleException;
use Gamesites\Payment\Dto\HistoryInterface;
use Gamesites\Payment\Operator\AbstractResponseOperator;
use Gamesites\Payment\Integration\Przelewy24\RestClient;
use Gamesites\Payment\Operator\ResponseOperatorInterface;
use Gamesites\Payment\Integration\Przelewy24\Request\UriEnum;

class ResponseBuilder extends AbstractResponseOperator implements ResponseOperatorInterface
{
    protected array $successfullyStatuses = ['SUCCESS', 'success'];
    protected string $statusField = 'STATUS';

    /** @throws GuzzleException */
    public function handlePaymentExist(array &$operatorData, HistoryInterface $history): bool
    {
        $isHashValid = $operatorData['sign'] && $this->getHash($operatorData) === $operatorData['sign'];
        $operatorData[$this->statusField] = $this->getStatus($operatorData);

        return $isHashValid;
    }

    private function getHash(array $operatorData): string
    {
        unset($operatorData['sign']);
        $operatorData['crc'] = $this->authOperator->getFieldThree();

        return hash(
            'sha384',
            json_encode($operatorData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );
    }

    /** @throws GuzzleException */
    private function getStatus(array $operatorData)
    {
        $client = new RestClient();

        unset($operatorData['originAmount'], $operatorData['methodId'], $operatorData['statement']);
        $operatorData['sign'] = hash(
            'sha384',
            json_encode([
                'sessionId' => $operatorData['sessionId'],
                'orderId' => $operatorData['orderId'],
                'amount' => $operatorData['amount'],
                'currency' => $operatorData['currency'],
                'crc' => $this->authOperator->getFieldThree(),
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );

        return $client->put($this->uri . UriEnum::API_TRANSACTION_VERIFY->value, $operatorData, $this->authOperator->getFieldTwo())['data']['status'];
    }
}
