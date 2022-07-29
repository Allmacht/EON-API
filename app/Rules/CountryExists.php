<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class CountryExists implements InvokableRule
{
    /**
     * It is validated that the entered country exists.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $countries = self::getCountries();
        $exists = self::checkIfExists($countries, $value);

        if (! is_array($exists) || count($exists) === 0) {
            return $fail('the country entered does not exist');
        }
    }

    /**
     * Get the list of countries
     *
     * @return array<object>
     */
    public function getCountries(): array
    {
        return json_decode(file_get_contents(public_path('countries.json')), true);
    }

    /**
     * a filter is performed on the list of countries, matches are sought and the result is returned
     *
     * @param  array  $countries
     * @param  string  $value
     * @return array<object>
     */
    public function checkIfExists(array $countries, string $value): array
    {
        return collect($countries)->filter(function ($item) use ($value) {
            return $item['name'] === $value || $item['es'] === $value;
        })->all();
    }
}
