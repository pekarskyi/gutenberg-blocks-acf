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

![Скриншот](https://github.com/Dizer7/gutenberg-blocks-acf/blob/master/Screenshot_testimonials.jpg)

В отзыве можно указать: текст отзыва, автора, должность, фото и поставить оценку.
Минимальное количество отзывов в блоке - 1. А максимальное - 6 (конечно же, можно указать любое другое число).

### :white_check_mark: Структура файлов блока:

- /blocks/testimonial/import-fields/testimonials-repeater.json - файл для импорта группы полей.
- /blocks/testimonial/screenshots/ - скриншоты блока
- /blocks/testimonial/block.json - метаданные блока Gutenberg
- /blocks/testimonial/testimonial.php - файл шаблона, используемый для рендеринга блока
- /blocks/testimonial/testimonial.css - CSS-файл со стилями блока
- /blocks/testimonial/testimonial.min.css - минифицированный CSS-файл со стилями блока
- /blocks/testimonial/images/ - изображения по умолчанию

### :white_check_mark: Дополнительные решения:

1. Вывод звездного рейтинга - решение описано [здесь](https://github.com/Dizer7/wp_star_rating).

2. Для каждого репитера генерируется случайное число - идентификатор. Это необходимо для нормальной работы ссылки "Показать все" (раскрыть полный текст отзыва).

Библиотека для генерирования уникального ID и описание установки вы сможете найти [здесь](https://github.com/Dizer7/ACF-Unique-ID-Field)

### :white_check_mark: Установка

1. Загрузите на сайт папку /blocks/
2. Загрузите на сайт папку и файл /inc/ACF_Field_Unique_ID.php  (см. доп.решение №2)
3. В файл functions.php дочерней темы вставьте следующий код:

```php
//#PHP:Custom category block
function register_layout_category( $categories ) {	
	$categories[] = array(
		'slug'  => 'inwebpress',
		'title' => 'InwebPress Blocks'
	);
	return $categories;
}

if ( version_compare( get_bloginfo( 'version' ), '5.8', '>=' ) ) {
	add_filter( 'block_categories_all', 'register_layout_category' );
} else {
	add_filter( 'block_categories', 'register_layout_category' );
}

//#PHP:Rating_frontend
require_once ABSPATH .'wp-admin/includes/template.php';
add_action('wp_enqueue_scripts', function(){ wp_enqueue_style('dashicons'); });

//Register_acf_blocks
add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
register_block_type( __DIR__ . '/blocks/testimonial' );
}

//#PHP:ACF_Field_Unique_ID
require_once get_stylesheet_directory() . '/inc/ACF_Field_Unique_ID.php';
PhilipNewcomer\ACF_Unique_ID_Field\ACF_Field_Unique_ID::init();
```

4. На сайте, в разделе "Консоль - Группы полей - Инструменты - Импорт групп полей" находим файл и импортируем группу полей:

```php
/blocks/testimonial/import-fields/testimonials-repeater.json
```

5. Вставляем блок "Отзывы" на страницу, заполняем поля.
Допустимое число отзывов в одном блоке 1-6.
Если фото/картинку автора отзыва не указали, то будет отображаться картинка по умолчанию.

### :white_check_mark: Примечание

Блок подтягивает стили из минифицированного файла /blocks/testimonial/testimonial.min.css.
Поэтому, внося изменения в файле /blocks/testimonial/testimonial.css не забывайте его потом сжимать.
