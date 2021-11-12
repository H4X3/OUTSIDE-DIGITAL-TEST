<?php
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/Autoload.php');
$BOOK = new Book();
$USER = new User();
$AUTHOR = new Author();
?>

<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" lang="ru">

<head>
    <title itemprop="name">Backend (PHP)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="author" content="Югов Максим" />

    <script src="/assets/plugins/jquery/jquery-3.2.1.min.js"></script>

    <link rel="stylesheet" href="/assets/plugins/fancybox-master/dist/jquery.fancybox.min.css">
    <script src="/assets/plugins/fancybox-master/dist/jquery.fancybox.min.js"></script>

    <script src="/assets/js/scripts.js"></script>

    <script src="/assets/plugins/inputmask-master/dist/jquery.inputmask.min.js"></script>

    <link rel="stylesheet" href="/assets/css/style.css">

    <link rel="stylesheet" href="/assets/css/normalize.css">
    <link rel="stylesheet" href="/assets/css/utils.css">
    <link rel="stylesheet" href="/assets/css/grid.css">
    <link rel="stylesheet" href="/assets/css/buttons.css">
    <link rel="stylesheet" href="/assets/css/forms.css">
    <link rel="stylesheet" href="/assets/css/modals.css">

</head>

<body>

    <section id="main-content">
        <section>
            <div class="hidden-xs hidden-sm">
                <div class="site-tabs">
                    <div class="container">
                        <input checked type="radio" id="users" data-id="users" name="tab" value="Пользователи">
                        <label for="users">Пользователи</label>

                        <input type="radio" id="authors" data-id="authors" name="tab" value="Авторы">
                        <label for="authors">Авторы</label>

                        <input type="radio" id="genre" data-id="genre" name="tab" value="Жанры книг">
                        <label for="genre">Жанры книг</label>

                        <input type="radio" id="book" data-id="book" name="tab" value="Книги в библиотеке">
                        <label for="book">Книги в библиотеке</label>

                        <input type="radio" id="books_out" data-id="books_out" name="tab" value="Книги в прокате">
                        <label for="books_out">Книги в прокате</label>


                    </div>
                </div>
            </div>

            <div class="site-tabs__content hidden-xs hidden-sm">

                <div class="site-tabs__item" style="display: block;" data-id="users">
                    <div class="tab-top">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-3">
                                    <a href="javascript:;" data-id="createUser" class="button wide button-azure button-medium js-modal">
                                        создать пользователя
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-info">
                        <div class="container">
                            <div class="row">
                                <? foreach ($USER->get() as $item) : ?>
                                    <div class="col-xs-12">
                                        <div class="items-row" data-id="<?= $item['id']; ?>">
                                            <div class="item-block">
                                                <div class="item-block__name">ФИО</div>
                                                <div class="item-block__val"><?= $item['fio']; ?></div>
                                            </div>
                                            <div class="item-block">
                                                <div class="item-block__name">Телефон</div>
                                                <div class="item-block__val"><?= $item['phone']; ?></div>
                                            </div>
                                            <div class="item-block">
                                                <div class="item-block__name">Адрес</div>
                                                <div class="item-block__val"><?= $item['address']; ?></div>
                                            </div>
                                            <div class="item-block">
                                                <a class="js-edit" data-id="user" data-modal="editUser" href="javascript:;">редактировать</a>
                                                <a class="js-delete" data-id="user" href="javascript:;">удалить</a>
                                            </div>
                                        </div>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="site-tabs__item" style="display: none;" data-id="authors">
                    <div class="tab-top">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-3">
                                    <a href="javascript:;" data-id="createAuthor" class="button wide button-azure button-medium js-modal">
                                        создать автора
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-info">
                        <div class="container">
                            <div class="row">
                                <? foreach ($AUTHOR->get() as $item) : ?>
                                    <div class="col-xs-12">
                                        <div class="items-row" data-id="<?= $item['id']; ?>">
                                            <div class="item-block">
                                                <div class="item-block__name">ФИО</div>
                                                <div class="item-block__val"><?= $item['fio']; ?></div>
                                            </div>
                                            <div class="item-block">
                                                <a class="js-edit" data-id="authors" data-modal="editAuthor" href="javascript:;">редактировать</a>
                                                <a class="js-delete" data-id="authors" href="javascript:;">удалить</a>
                                            </div>
                                        </div>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="site-tabs__item" style="display: none;" data-id="genre">
                    <div class="tab-top">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-3">
                                    <a href="javascript:;" data-id="createGenre" class="button wide button-azure button-medium js-modal">
                                        создать жанр
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-info">
                        <div class="container">
                            <div class="row">
                                <? foreach ($BOOK->getAllGenres() as $item) : ?>
                                    <div class="col-xs-12">
                                        <div class="items-row" data-id="<?= $item['id']; ?>">
                                            <div class="item-block">
                                                <div class="item-block__name">Жанр</div>
                                                <div class="item-block__val"><?= $item['name']; ?></div>
                                            </div>
                                            <div class="item-block">
                                                <a class="js-edit" data-id="genre" data-modal="editGenre" href="javascript:;">редактировать</a>
                                                <a class="js-delete" data-id="genre" href="javascript:;">удалить</a>
                                            </div>
                                        </div>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="site-tabs__item" style="display: none;" data-id="book">
                    <div class="tab-top">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-3">
                                    <a href="javascript:;" data-id="createBook" class="button wide button-azure button-medium js-modal">
                                        создать книгу
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-info">
                        <div class="container">
                            <div class="row">
                                <? foreach ($BOOK->getAllBooks() as $item) : ?>
                                    <?
                                    $date = strtotime($item['year']);
                                    $item['year'] = date('Y-m-d', $date);
                                    ?>
                                    <div class="col-xs-12">
                                        <div class="items-row <?= ($item['count'] == 0) ? 'disabled' : ''; ?>" data-id="<?= $item['isbn']; ?>">
                                            <div class="item-block">
                                                <div class="item-block__name">Автор</div>
                                                <div class="item-block__val"><?= $item['fullName']; ?></div>
                                            </div>
                                            <div class="item-block">
                                                <div class="item-block__name">Название</div>
                                                <div class="item-block__val"><?= $item['book_name']; ?></div>
                                            </div>
                                            <div class="item-block">
                                                <div class="item-block__name">Дата издательства</div>
                                                <div class="item-block__val"><?= $item['year']; ?></div>
                                            </div>
                                            <div class="item-block">
                                                <div class="item-block__name">Количество страниц</div>
                                                <div class="item-block__val"><?= $item['count_pages']; ?></div>
                                            </div>
                                            <div class="item-block">
                                                <div class="item-block__name">Количество</div>
                                                <div class="item-block__val"><?= $item['count']; ?></div>
                                            </div>
                                            <div class="item-block">
                                                <div class="item-block__name">Жанр</div>
                                                <div class="item-block__val"><?= $item['genre_name']; ?></div>
                                            </div>
                                            <div class="item-block">
                                                <a class="js-edit" data-id="book" data-modal="editBook" href="javascript:;">редактировать</a>
                                                <a class="js-delete" data-id="book" href="javascript:;">удалить</a>
                                            </div>
                                        </div>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="site-tabs__item" style="display: none;" data-id="books_out">
                    <div class="tab-top">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-3">
                                    <a href="javascript:;" data-id="createReservation" class="button wide button-azure button-medium js-modal">
                                        создать прокат
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-info">
                        <div class="container">
                            <div class="row">
                                <? foreach ($USER->getAllReservation() as $item) : ?>
                                    <div class="col-xs-12">
                                        <div class="items-block">
                                            <div class="item-block item-block__wide">
                                                <div class="item-block__name">ФИО</div>
                                                <div class="item-block__val"><?= $item['fio']; ?></div>
                                            </div>
                                            <? foreach ($item['books'] as $key => $book) : ?>
                                                <?
                                                $date_issue = strtotime($book['date_issue']);
                                                $book['date_issue'] = date('Y-m-d', $date_issue);
                                                $date_return = strtotime($book['date_return']);
                                                $book['date_return'] = date('Y-m-d', $date_return);
                                                ?>
                                                <div class="items-row items-row__child" data-id="<?= $key; ?>">
                                                    <div class="item-block">
                                                        <div class="item-block__name">Название</div>
                                                        <div class="item-block__val"><?= $book['name']; ?></div>
                                                    </div>
                                                    <div class="item-block">
                                                        <div class="item-block__name">Дата выдачи</div>
                                                        <div class="item-block__val"><?= $book['date_issue']; ?></div>
                                                    </div>
                                                    <div class="item-block">
                                                        <div class="item-block__name">Дата сдачи</div>
                                                        <div class="item-block__val"><?= $book['date_return']; ?></div>
                                                    </div>
                                                    <div class="item-block">
                                                        <a class="js-edit" data-id="reservation" data-modal="editReservation" href="javascript:;">редактировать</a>
                                                        <a class="js-delete" data-id="reservation" href="javascript:;">удалить</a>
                                                    </div>
                                                </div>
                                            <? endforeach; ?>
                                        </div>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </section>

    <div id="createUser" class="fancybox-modal fancybox-modal-medium modal" style="display: none;">
        <div class="mech-modal__form">
            <div class="modal__title h2 text-white">
                Создать пользователя
            </div>
            <form name="createUser" method=" POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="mech-modal__form--item  ">
                            <input type="text" name="fio" required="" placeholder="ФИО пользователя" value="">
                        </div>
                        <div class="mech-modal__form--item  ">
                            <input type="text" mask="phone" name="phone" required="" placeholder="Телефон" value="">
                        </div>
                        <div class="mech-modal__form--item  ">
                            <input type="text" name="address" required="" placeholder="Адрес" value="">
                        </div>
                        <div class="mech-modal__form--btn">
                            <input type="submit" name="web_form_submit" class="button button-small button-azure" value="Создать">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="editUser" class="fancybox-modal fancybox-modal-medium modal" style="display: none;">
        <div class="mech-modal__form">
            <div class="modal__title h2 text-white">
                Редактировать пользователя
            </div>
            <form name="editUser" method=" POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" name="id">
                        <div class="mech-modal__form--item  ">
                            <input type="text" name="fio" required="" placeholder="ФИО пользователя" value="">
                        </div>
                        <div class="mech-modal__form--item  ">
                            <input type="text" mask="phone" name="phone" required="" placeholder="Телефон" value="">
                        </div>
                        <div class="mech-modal__form--item  ">
                            <input type="text" name="address" required="" placeholder="Адрес" value="">
                        </div>
                        <div class="mech-modal__form--btn">
                            <input type="submit" name="web_form_submit" class="button button-small button-azure" value="Сохранить">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="createAuthor" class="fancybox-modal fancybox-modal-medium modal" style="display: none;">
        <div class="mech-modal__form">
            <div class="modal__title h2 text-white">
                Создать автора
            </div>
            <form name="createAuthor" method=" POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="mech-modal__form--item  ">
                            <input type="text" name="fio" required="" placeholder="ФИО автора" value="">
                        </div>
                        <div class="mech-modal__form--btn">
                            <input type="submit" name="web_form_submit" class="button button-small button-azure" value="Создать">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="editAuthor" class="fancybox-modal fancybox-modal-medium modal" style="display: none;">
        <div class="mech-modal__form">
            <div class="modal__title h2 text-white">
                Редактировать автора
            </div>
            <form name="editAuthor" method=" POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" name="id">
                        <div class="mech-modal__form--item  ">
                            <input type="text" name="fio" required="" placeholder="ФИО автора" value="">
                        </div>
                        <div class="mech-modal__form--btn">
                            <input type="submit" name="web_form_submit" class="button button-small button-azure" value="Сохранить">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="createBook" class="fancybox-modal fancybox-modal-medium modal" style="display: none;">
        <div class="mech-modal__form">
            <div class="modal__title h2 text-white">
                Создать книгу
            </div>
            <form name="createBook" method=" POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="mech-modal__form--item  ">
                            <? foreach ($AUTHOR->get() as $item) : ?>
                                <label for="<?= $item['id']; ?>">
                                    <input type="checkbox" id="<?= $item['id']; ?>" name="fio[]" value="<?= $item['id']; ?>">
                                    <span class="checkbox"><?= $item['fio']; ?></span>
                                </label>
                            <? endforeach; ?>
                        </div>
                        <div class="mech-modal__form--item  ">
                            <select name="genre_id">
                                <option disabled selected value="0">Выберите жанр</option>
                                <? foreach ($BOOK->getAllGenres() as $item) : ?>
                                    <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                                <? endforeach; ?>
                            </select>
                        </div>
                        <div class="mech-modal__form--item  ">
                            <input type="text" name="name" required="" placeholder="Название" value="">
                        </div>
                        <div class="mech-modal__form--item  ">
                            <input type="date" name="date" required="" placeholder="Дата издательства" value="">
                        </div>
                        <div class="mech-modal__form--item  ">
                            <input type="text" name="count_pages" required="" placeholder="Количество страниц" value="">
                        </div>
                        <div class="mech-modal__form--item  ">
                            <input type="text" name="count" required="" placeholder="Количество" value="">
                        </div>
                        <div class="mech-modal__form--btn">
                            <input type="submit" name="web_form_submit" class="button button-small button-azure" value="Создать">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="editBook" class="fancybox-modal fancybox-modal-medium modal" style="display: none;">
        <div class="mech-modal__form">
            <div class="modal__title h2 text-white">
                Редактировать книгу
            </div>
            <form name="editBook" method=" POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" name="id">
                        <div class="mech-modal__form--item  ">
                            <? foreach ($AUTHOR->get() as $item) : ?>
                                <label for="<?= $item['id']; ?>">
                                    <input type="checkbox" id="<?= $item['id']; ?>" name="fio" value="<?= $item['id']; ?>">
                                    <span class="checkbox"><?= $item['fio']; ?></span>
                                </label>
                            <? endforeach; ?>
                        </div>
                        <div class="mech-modal__form--item  ">
                            <select name="genre_id">
                                <option disabled selected value="0">Выберите жанр</option>
                                <? foreach ($BOOK->getAllGenres() as $item) : ?>
                                    <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                                <? endforeach; ?>
                            </select>
                        </div>
                        <div class="mech-modal__form--item">
                            <input type="text" name="name" required="" placeholder="Название" value="">
                        </div>
                        <div class="mech-modal__form--item">
                            <input type="date" name="date" required="" placeholder="Дата издательства" value="">
                        </div>
                        <div class="mech-modal__form--item">
                            <input type="text" name="count_pages" required="" placeholder="Количество страниц" value="">
                        </div>
                        <div class="mech-modal__form--item">
                            <input type="text" name="count" required="" placeholder="Количество" value="">
                        </div>
                        <div class="mech-modal__form--btn">
                            <input type="submit" name="web_form_submit" class="button button-small button-azure" value="Сохранить">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="createReservation" class="fancybox-modal fancybox-modal-medium modal" style="display: none;">
        <div class="mech-modal__form">
            <div class="modal__title h2 text-white">
                Создать прокат
            </div>
            <form name="createReservation" method=" POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="mech-modal__form--item">
                            <select name="user_id">
                                <option disabled selected value="0">Выберите пользователя</option>
                                <? foreach ($USER->get() as $item) : ?>
                                    <option value="<?= $item['id']; ?>"><?= $item['fio']; ?></option>
                                <? endforeach; ?>
                            </select>
                        </div>
                        <div class="mech-modal__form--item">
                            <select name="isbn_id">
                                <option disabled selected value="0">Выберите книгу</option>
                                <? foreach ($BOOK->getAllBooks() as $item) : ?>
                                    <option value="<?= $item['isbn']; ?>"><?= $item['book_name']; ?></option>
                                <? endforeach; ?>
                            </select>
                        </div>
                        <div class="mech-modal__form--item  ">
                            <label for=date_issue"">Дата выдачи</label>
                            <input type="date" name="date_issue" id="date_issue" required="" placeholder="Дата выдачи" value="">
                        </div>
                        <div class="mech-modal__form--item  ">
                            <label for="date_return">Дата сдачи</label>
                            <input type="date" name="date_return" id="date_return" required="" placeholder="Дата сдачи" value="">
                        </div>
                        <div class="mech-modal__form--btn">
                            <input type="submit" name="web_form_submit" class="button button-small button-azure" value="Создать">
                        </div>
                        <div class="mech-modal__form--item">
                            <div class="modal-error">

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="editReservation" class="fancybox-modal fancybox-modal-medium modal" style="display: none;">
        <div class="mech-modal__form">
            <div class="modal__title h2 text-white">
                Редактировать прокат
            </div>
            <form name="editReservation" method=" POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" name="id">
                        <div class="mech-modal__form--item">
                            <select name="user_id">
                                <option disabled selected value="0">Выберите пользователя</option>
                                <? foreach ($USER->get() as $item) : ?>
                                    <option value="<?= $item['id']; ?>"><?= $item['fio']; ?></option>
                                <? endforeach; ?>
                            </select>
                        </div>
                        <div class="mech-modal__form--item">
                            <select name="isbn_id">
                                <option disabled selected value="0">Выберите книгу</option>
                                <? foreach ($BOOK->getAllBooks() as $item) : ?>
                                    <option value="<?= $item['isbn']; ?>"><?= $item['book_name']; ?></option>
                                <? endforeach; ?>
                            </select>
                        </div>
                        <div class="mech-modal__form--item  ">
                            <label for=date_issue"">Дата выдачи</label>
                            <input type="date" name="date_issue" id="date_issue" required="" placeholder="Дата выдачи" value="">
                        </div>
                        <div class="mech-modal__form--item  ">
                            <label for="date_return">Дата сдачи</label>
                            <input type="date" name="date_return" id="date_return" required="" placeholder="Дата сдачи" value="">
                        </div>
                        <div class="mech-modal__form--btn">
                            <input type="submit" name="web_form_submit" class="button button-small button-azure" value="Сохранить">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="createGenre" class="fancybox-modal fancybox-modal-medium modal" style="display: none;">
        <div class="mech-modal__form">
            <div class="modal__title h2 text-white">
                Создать жанр
            </div>
            <form name="createGenre" method=" POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="mech-modal__form--item  ">
                            <input type="text" name="name" required="" placeholder="Название жанра" value="">
                        </div>
                        <div class="mech-modal__form--btn">
                            <input type="submit" name="web_form_submit" class="button button-small button-azure" value="Создать">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="editGenre" class="fancybox-modal fancybox-modal-medium modal" style="display: none;">
        <div class="mech-modal__form">
            <div class="modal__title h2 text-white">
                Редактировать жанр
            </div>
            <form name="editGenre" method=" POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-12">
                        <input type="hidden" name="id">
                        <div class="mech-modal__form--item  ">
                            <input type="text" name="name" required="" placeholder="Название жанра" value="">
                        </div>
                        <div class="mech-modal__form--btn">
                            <input type="submit" name="web_form_submit" class="button button-small button-azure" value="Сохранить">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>