# Создание блоков Gutenberg с помощью ACF PRO

Конфигурация сайта:
- WordPress 5.8 - 6 >=
- ACF PRO 6 >=
- Gutenberg

Создание блока - дочерняя тема.

Регистрация пользовательского блока в файле:
- /theme-child/functions.php

Метаданные блока и регистрация типов блоков в файле block.json.

*Starting in WordPress 5.8 release, we encourage using the block.json metadata file as the canonical way to register block types.* (developer.wordpress.org)

## 1. Блок "Отзывы клиентов" в виде сетки - blocks/testimonial

В отзыве можно указать: текст отзыва, автора, должность, фото и поставить оценку.
Минимальное количество отзывов в блоке - 1. А максимальное - 6 (конечно же, можно указать любое другое число).

### Структура файлов блока:

- /blocks/testimonial/import-fields/testimonials-repeater.json - файл для импорта группы полей.
- /blocks/testimonial/screenshots/ - скриншоты блока
- /blocks/testimonial/block.json - метаданные блока Gutenberg
- /blocks/testimonial/testimonial.php - файл шаблона, используемый для рендеринга блока
- /blocks/testimonial/testimonial.css - CSS-файл со стилями блока
- /blocks/testimonial/testimonial.css - минифицированный CSS-файл со стилями блока

## Дополнительные решения

1. Вывод звездного рейтинга - решение описано [здесь](https://github.com/Dizer7/wp_star_rating).

2. Для каждого репитера генерируется случайное число - идентификатор. Это необходимо для нормальной работы ссылки "Показать все" (раскрыть полный текст отзыва).

Библиотека для генерирования уникального ID и описание установки вы сможете найти [здесь](https://github.com/Dizer7/ACF-Unique-ID-Field)