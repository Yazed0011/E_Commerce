<?php
namespace Validation\Auth;
class SignUp {
    public function validate(array $data) {
        $errors = [];
        if (empty($data['name'])) {
            $errors['name'] = 'Name is required';
        }
        if (empty($data['email'])) {
            $errors['email'] = 'Email is required';
        }
        if (empty($data['password'])) {
            $errors['password'] = 'Password is required';
        }

        if (!empty($data['password']) && strlen($data['password']) < 8) {
            $errors['password'] = 'Password must be at least 8 characters long';
        }

        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email address';
        }

        if (!empty($errors)) {
            return $errors;
        }

        return true;
    }
}