<?php

declare(strict_types=1);

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserRequest
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        public string $surname,

        #[Assert\NotBlank]
        #[Assert\Type('string')]
        public string $name,

        #[Assert\NotBlank]
        #[Assert\Email]
        public string $email,
    ) {
    }
}
