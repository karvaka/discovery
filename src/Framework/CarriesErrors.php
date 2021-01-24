<?php declare(strict_types=1);

namespace App\Framework;

trait CarriesErrors
{
    private array $errors = [];

    public function hasErrors($attribute = null): bool
    {
        if (is_null($attribute)) {
            return !empty($this->errors);
        }

        return isset($this->errors[$attribute]);
    }

    public function getErrors($attribute = null): array
    {
        if (is_null($attribute)) {
            return $this->errors;
        }

        return $this->errors[$attribute] ?? [];
    }

    public function addError($attribute, $message): self
    {
        $this->errors[$attribute][] = $message;

        return $this;
    }
}
