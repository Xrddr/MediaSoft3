<?php

function valid(array $post): array
{
    $validate = [
        'success' => false,
        'error' => false,
        'messages' => []
    ];

    if (!empty($post['name']) and !empty($post['surname']) and !empty($post['login']) and !empty($post['password'])) {
        $name = trim($post['name']);
        $surname = trim($post['surname']);
        $login = trim($post['login']);
        $password = trim($post['password']);

        $constraints = [
            'name' => 3,
            'surname' => 3,
            'login' => 5,
            'password' => 6
        ];

        $validateForm = validNameSurnameLoginPassword($name, $surname, $login, $password, $constraints);

        if (!$validateForm['name']) {
            $validate['error'] = true;
            array_push(
                $validate['messages'],
                "Имя должно содержать не менее {$constraints['name']} букв."
            );
        }

        if (!preg_match('/^[а-яА-Я]+$/iu', $name)) {
            $validate['error'] = true;
            array_push(
                $validate['messages'],
                "Имя не должно содержать цифр и спецсимволы"
            );
        }

        if (!$validateForm['surname']) {
            $validate['error'] = true;
            array_push(
                $validate['messages'],
                "Фамилия должно содержать не менее {$constraints['surname']} букв."
            );
        }

        if (!preg_match('/^[а-яА-Я]+$/iu', $surname)) {
            $validate['error'] = true;
            array_push(
                $validate['messages'],
                "Фамилия не должна содержать английский алфавит, цифры и спецсимволы "
            );
        }

        if (!$validateForm['login']) {
            $validate['error'] = true;
            array_push(
                $validate['messages'],
                "Логин должно содержать не менее {$constraints['login']} символов"
            );

        }

        if (!preg_match('/^[a-zA-Z0-9]+$/iu', $login)) {
            $validate['error'] = true;
            array_push(
                $validate['messages'],
                "Логин не должен содержать русский алфавит"
            );

        }
        if (!$validateForm['password']) {
            $validate['error'] = true;
            array_push(
                $validate['messages'],
                "Пароль должен содержать не менее {$constraints['password']} символов"
            );
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/iu', $password)) {
            $validate['error'] = true;
            array_push(
                $validate['messages'],
                "Пароль не должен содержать русский алфавит"
            );

        }
        if (!$validate['error']) {
            $validate['success'] = true;
            array_push(
                $validate['messages'],
                "Вы успешно прошли валидацию",
                "Ваше имя: {$name}",
                "Ваша фамилия: {$surname}",
                "Ваш логин: {$login}",
                "Ваш пароль: {$password}"
            );
        }


        return $validate;
    }
    return $validate;
}

function validNameSurnameLoginPassword(string $name, string $surname, string $login, string $password, array $constraints): array
{

    $validateForm = [
        'name' => true,
        'surname' => true,
        'login' => true,
        'password' => true
    ];

    if (strlen($name) < $constraints['name']) {
        $validateForm['name'] = false;
    }

    if (strlen($surname) < $constraints['surname']) {
        $validateForm['surname'] = false;
    }

    if (strlen($login) < $constraints['login']) {
        $validateForm['login'] = false;
    }

    if (strlen($password) < $constraints['password']) {
        $validateForm['password'] = false;
    }

    return $validateForm;
}