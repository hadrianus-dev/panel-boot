<?php
declare(strict_types=1);

namespace Domain\Shared\ValueObjects;

use DomainException;

final class Email
{
    private string $email;

    public function __construct(string $email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new DomainException("Erro, o email informado nao e valido");
        }
        
        $this->email = $email;
    }

    public function value(): string
    {
        return (string) $this->email;
    }

}