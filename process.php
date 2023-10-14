<?php

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"));

$error = [];

if (strlen($data->name) <= 3) {
    $error[] = 'A név túl rövid!';
};

if (filter_var($data->email, FILTER_VALIDATE_EMAIL) === false) {
    $error[] = 'Az emailcím helytelen!';
};

if (strlen($data->password) <= 5) {
    $error[] = 'A jelszó túl rövid!';
};

if (strlen($data->password) > 20) {
    $error[] = 'A jelszó túl husszú!';
};

if ($data->password != $data->password_confirmation) {
    $error[] = 'A jelszók nem egyeznek!';
};

if (count($error) > 0) {
    print json_encode(['status' => 'error', 'errors' => $error]);
} else {
    print json_encode(['status' => 'success', 'message' => 'Kedves '.$data->name.'. <br><br> Sikeres regisztráció! A megerősítő emailt elküldtük a(z): '.$data->email.' címre.']);
}
