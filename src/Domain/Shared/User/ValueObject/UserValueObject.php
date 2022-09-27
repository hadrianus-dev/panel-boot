<?php

declare(strict_types=1);

namespace Domain\Shared\User\ValueObject;

use Domain\Shared\ValueObjects\Email;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserValueObject
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $password,
        public null|int $level = null,
        public null|string $cover = null,
    )
    {}

    public function toArray(): array
    {
        $mail = new Email(Str::lower($this->email));
        return [
            'first_name' => Str::ucfirst($this->first_name),
            'last_name' => Str::ucfirst($this->last_name),
            'email' => $mail->value(),
            'password' => Hash::make($this->password),
            'level' => $this->level,
            'cover' => $this->cover,
        ];
    }
}
