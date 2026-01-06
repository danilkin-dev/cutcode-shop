<?php

namespace Domain\Order\Actions;

use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Order\DTOs\NewOrderDTO;
use Domain\Order\Models\Order;

final class NewOrderAction
{
    public function __invoke(NewOrderDTO $data): Order
    {
        if ($data->createAccount) {
            $this->registerCustomer($data);
        }

        return Order::query()->create([
            'payment_method_id' => $data->paymentMethodId,
            'delivery_type_id' => $data->deliveryTypeId,
        ]);
    }

    private function registerCustomer(NewOrderDTO $data): void
    {
        $register = app(RegisterNewUserContract::class);

        $register(new NewUserDTO(
            name: "{$data->firstName} {$data->lastName}",
            email: $data->email,
            password: $data->password,
        ));
    }
}
