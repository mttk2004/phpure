<?php

namespace Core;

use Respect\Validation\Exceptions\NestedValidationException;

class Validation
{
    private array $errors = []; // Lưu các lỗi validation

    // Thực hiện validation
    public function validate(array $data, array $rules): bool
    {
        foreach ($rules as $field => $rule) {
            try {
                $rule->assert($data[$field] ?? null);
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }

        return empty($this->errors);
    }

    // Lấy danh sách lỗi
    public function errors(): array
    {
        return $this->errors;
    }
}
