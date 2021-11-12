<?php
spl_autoload_register(function ($class_name) {
    include ROOT . '/classes/' . $class_name . '.php';
});

