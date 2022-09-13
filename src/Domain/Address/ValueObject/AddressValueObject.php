<?php

declare(strict_types=1);

namespace Domain\Address\ValueObject;

use DomainException;
use Illuminate\Support\Str;
use JustSteveKing\StatusCode\Http;

class AddressValueObject
{
    public function __construct(
        public string $state_id,
        public string $city_id,
        public null|string $district = null,
        public null|string $street = null,
        public null|string $home = null,
        public null|bool $published = false,
        public null|string $user_id = null,
        public null|string $enterprise_id = null,
    )
    {
        if($this->user_id != null || $this->enterprise_id != null):
            return new DomainException('Precisa designar uma pessoa para este endereço, seja fisica ou juridica.', Http::NOT_ACCEPTABLE());
        endif;
    }

    public function toArray(): array
    {   
        return [
            'state_id' => Str::ucfirst($this->state_id),
            'city_id' => Str::ucfirst($this->city_id),
            'district' => Str::ucfirst($this->district),
            'street' => Str::ucfirst($this->street),
            'home' => Str::ucfirst($this->home),
            'published' => $this->published,
            'user_id' => (int) $this->user_id,
            'enterprise_id' => (int) $this->enterprise_id,
        ];
    }
}
