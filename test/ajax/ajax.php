<?

define('ROOT', dirname(__FILE__, 2));
require_once(ROOT . '/Autoload.php');

$data = $_REQUEST;

$AUTHOR = new Author();
$USER = new User();
$BOOK = new Book();

switch ($data['action']) {
    case 'set':
        switch ($data['table']) {
            case 'authors':
                $allow_fields = array('fio');
                foreach ($data['data'] as $key => $value) {
                    if (in_array($value['name'], $allow_fields))
                        $arData[$value['name']] = $value['value'];
                }
                $res = $AUTHOR->setAuthor($arData);
                break;
            case 'user':
                $allow_fields = array('fio', 'phone', 'address');
                foreach ($data['data'] as $key => $value) {
                    if (in_array($value['name'], $allow_fields))
                        $arData[$value['name']] = $value['value'];
                }
                $res = $USER->setUser($arData);
                break;
            case 'book':
                $allow_fields = array('name', 'date', 'count_pages', 'count', 'author_id', 'genre_id');
                foreach ($data['data'] as $key => $value) {
                    if (in_array($value['name'], $allow_fields))
                        $arData[$value['name']] = $value['value'];
                }
                $res = $BOOK->setBook($arData);
                break;
            case 'reservation':
                $allow_fields = array('isbn_id', 'user_id', 'date_return', 'date_issue');
                foreach ($data['data'] as $key => $value) {
                    if (in_array($value['name'], $allow_fields))
                        $arData[$value['name']] = $value['value'];
                }
                $res = $USER->setReservation($arData);
                echo json_encode($res);
                break;
            case 'genre':
                $allow_fields = array('id', 'name');
                foreach ($data['data'] as $key => $value) {
                    if (in_array($value['name'], $allow_fields))
                        $arData[$value['name']] = $value['value'];
                }
                $res = $BOOK->setGenre($arData);
                break;
        }
        break;
    case 'delete':
        switch ($data['table']) {
            case 'user':
                $USER->deleteUser($data['id']);
                break;
            case 'authors':
                $AUTHOR->deleteAuthor($data['id']);
                break;
            case 'book':
                $BOOK->deleteBook($data['id']);
                break;
            case 'reservation':
                $USER->deleteReservation($data['id']);
                break;
            case 'genre':
                $BOOK->deleteGenre($data['id']);
                break;
        }
        break;
    case 'get':
        switch ($data['table']) {
            case 'user':
                $user = $USER->getUser($data['id']);
                echo json_encode($user);
                break;
            case 'authors':
                $author = $AUTHOR->getAuthor($data['id']);
                echo json_encode($author);
                break;
            case 'book':
                $book = $BOOK->getBook($data['id']);
                echo json_encode($book);
                break;
            case 'reservation':
                $book = $USER->getReservation($data['id']);
                echo json_encode($book);
                break;
            case 'genre':
                $book = $BOOK->getGenre($data['id']);
                echo json_encode($book);
                break;
        }
        break;
    case 'edit':
        switch ($data['table']) {
            case 'user':
                $allow_fields = array('id', 'fio', 'phone', 'address');
                foreach ($data['data'] as $key => $value) {
                    if (in_array($value['name'], $allow_fields))
                        $arData[$value['name']] = $value['value'];
                }

                $USER->editUser($arData);
                break;
            case 'authors':
                $allow_fields = array('id', 'fio');
                foreach ($data['data'] as $key => $value) {
                    if (in_array($value['name'], $allow_fields))
                        $arData[$value['name']] = $value['value'];
                }
                $AUTHOR->editAuthor($arData);
                break;
            case 'book':
                $allow_fields = array('id', 'name', 'date', 'count_pages', 'count', 'author_id', 'genre_id');
                foreach ($data['data'] as $key => $value) {
                    if (in_array($value['name'], $allow_fields))
                        $arData[$value['name']] = $value['value'];
                }
                $BOOK->editBook($arData);
                break;
            case 'reservation':
                $allow_fields = array('id', 'user_id', 'isbn_id', 'date_issue', 'date_return');
                foreach ($data['data'] as $key => $value) {
                    if (in_array($value['name'], $allow_fields))
                        $arData[$value['name']] = $value['value'];
                }
                $USER->editReservation($arData);
                break;
            case 'genre':
                $allow_fields = array('id', 'name');
                foreach ($data['data'] as $key => $value) {
                    if (in_array($value['name'], $allow_fields))
                        $arData[$value['name']] = $value['value'];
                }
                $BOOK->editGenre($arData);
                break;
        }
        break;
}
