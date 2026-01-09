<?php

namespace Domain\Order\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

final class NewOrderDTO
{
    use Makeable;

    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $phone,
        public readonly string $email,
        public readonly ?string $city,
        public readonly ?string $address,
        public readonly bool $createAccount,
        public readonly int $deliveryTypeId,
        public readonly int $paymentMethodId,
        public readonly ?string $password,
    ) {
    }

    public static function fromRequest(Request $request): NewOrderDTO
    {
        return new self(
            firstName: $request->input('customer.first_name'),
            lastName: $request->input('customer.last_name'),
            phone: $request->input('customer.phone'),
            email: $request->input('customer.email'),
            city: $request->input('customer.city'),
            address: $request->input('customer.address'),
            createAccount: $request->boolean('create_account'),
            deliveryTypeId: $request->input('delivery_type_id'),
            paymentMethodId: $request->input('payment_method_id'),
            password: $request->input('password'),
        );
    }
}
