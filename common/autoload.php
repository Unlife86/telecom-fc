<?php
/**
 * Пример реализации для конкретного проекта.
 * https://github.com/samdark/fig-standards-ru/blob/master/accepted/ru/PSR-4-autoloader-examples.md
 * 
 * После регистрации этого автозагрузчика через SPL следующая строчка
 * заставит функцию попытаться загрузить класс \Foo\Bar\Baz\Qux
 * из файла /path/to/project/src/Baz/Qux.php:
 * 
 *      new \Foo\Bar\Baz\Qux;
 *      
 * @param string $class абсолютное имя класса.
 * @return void
 */
spl_autoload_register(function ($class) {

    // префикс пространства имён проекта
    $prefix = 'common\\models\\';

    // базовая директория для этого префикса
    $base_dir = __DIR__ . '/db/';

    // класс использует префикс?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // нет. Пусть попытается другой автозагрузчик
        return;
    }

    // получаем относительное имя класса
    $relative_class = substr($class, $len);

    // заменяем префикс базовой директорией, заменяем разделители пространства имён
    // на разделители директорий в относительном имени класса, добавляем .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // если файл существует, подключаем его
    if (file_exists($file)) {
        require $file;
    }
});