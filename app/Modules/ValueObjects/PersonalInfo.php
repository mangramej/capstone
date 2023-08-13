<?php

namespace App\Modules\ValueObjects;

class PersonalInfo
{
    public function __construct(
        public ?string $first_name,
        public ?string $last_name,
        public ?string $date_of_birth,
        public ?string $phone_number,
        public ?string $sex,
        public ?string $middle_name = null,
    ) {
    }

    public function hasFilled(): bool
    {
        return ! is_null($this->first_name) &&
                ! is_null($this->last_name) &&
                ! is_null($this->date_of_birth) &&
                ! is_null($this->phone_number) &&
                ! is_null($this->sex);
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'date_of_birth' => $this->date_of_birth,
            'phone_number' => $this->phone_number,
            'sex' => $this->sex,
        ];
    }
}
