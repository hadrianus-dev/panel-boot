<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Domain\Shared\User\ValueObject\UserValueObject;


class NewUser extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public UserValueObject $object){}

    public function build(): self
    {
        return $this->markdown('mail.user.new-user');
    }
}
