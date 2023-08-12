<?php

namespace App\Modules\Castables;

use App\Modules\ValueObjects\PersonalInfo as PersonalInfoValueObject;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class PersonalInfo implements Castable
{
    public static function castUsing(array $arguments): CastsAttributes
    {
        return new class implements CastsAttributes
        {
            public function get(Model $model, string $key, mixed $value, array $attributes): PersonalInfoValueObject
            {
                return new PersonalInfoValueObject(
                    first_name: $attributes['first_name'],
                    last_name: $attributes['last_name'],
                    date_of_birth: $attributes['date_of_birth'],
                    phone_number: $attributes['phone_number'],
                    sex: $attributes['sex'],
                    middle_name: $attributes['middle_name'],
                );
            }

            public function set(Model $model, string $key, mixed $value, array $attributes)
            {
                if (! $value instanceof PersonalInfoValueObject) {
                    throw new InvalidArgumentException('The given value is not an PersonalInfoValueObject instance.');
                }

                return [
                    'first_name' => $value->first_name,
                    'middle_name' => $value->middle_name,
                    'last_name' => $value->last_name,
                    'date_of_birth' => $value->date_of_birth,
                    'phone_number' => $value->phone_number,
                    'sex' => $value->sex,
                ];
            }
        };
    }
}
