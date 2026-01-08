<?php

namespace Domain\Order\Payment\Gateways;

use Domain\Order\Contacts\PaymentGatewayContract;
use Domain\Order\Payment\PaymentData;
use Illuminate\Http\JsonResponse;

final class YooKassa implements PaymentGatewayContract
{
    public function paymentId(): string
    {
    }

    public function configure(array $config): void
    {
    }

    public function data(PaymentData $data): self
    {
    }

    public function request(): mixed
    {
    }

    public function response(): JsonResponse
    {
    }

    public function url(): string
    {
    }

    public function validate(): bool
    {
    }

    public function paid(): bool
    {
    }

    public function errorMessage(): string
    {
    }
}
