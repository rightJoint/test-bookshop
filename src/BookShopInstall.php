<?php
class BookShopInstall
{
    public static function installAll(PDO $db):void
    {
        //create database
        $db->query(self::createDatabase($db::DB));
        //use database
        $db->query('use '.$db::DB);
        //create tables
        $db->query(self::createCategoriesTable());
        $db->query(self::createBooksTable());
        $db->query(self::createAuthorsTable());
        $db->query(self::createBooksToAuthorsTable());
        //insert data
        $db->exec(self::addCategories());
        $db->exec(self::addBooks());
        $db->exec(self::addAuthors());
        $db->exec(self::addBooksToAuthors());
    }

    private static function createDatabase(string $dbName):string
    {
        return 'CREATE DATABASE IF NOT EXISTS '.$dbName.' CHARACTER SET utf8 COLLATE utf8_general_ci';
    }

    private static function createBooksTable():string
    {
        return 'create table IF NOT EXISTS books
(
    book_id varchar(36) not null,
    bookName varchar(256) not null,
    price int,
    status varchar(36),
    bookCategory_id varchar(36),
    primary key (book_id),
    FOREIGN KEY (bookCategory_id) REFERENCES categories (category_id) ON DELETE SET NULL
)
ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;';
    }

    private static function createAuthorsTable():string
    {
        return 'create table IF NOT EXISTS authors
(
    authors_id varchar(36) not null,
    fullName varchar(256) not null,
    primary key (authors_id)
)
ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;';
    }

    private static function createCategoriesTable():string
    {
        return 'create table IF NOT EXISTS categories
(
    category_id varchar(36) not null,
    categoryName varchar(256) not null,
    primary key (category_id)
)
ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;';
    }

    private static function createBooksToAuthorsTable():string
    {
        return 'create table IF NOT EXISTS bookstoauthors
(
    book_id varchar(36) not null,
    authors_id varchar(36) not null,
    primary key CLUSTERED (book_id, authors_id),
    FOREIGN KEY (book_id) REFERENCES books(book_id) ON DELETE CASCADE,
    FOREIGN KEY (authors_id) REFERENCES authors(authors_id) ON DELETE CASCADE
)
ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;';
    }

    private static function addCategories():string
    {
        return "REPLACE INTO `categories` (`category_id`, `categoryName`) VALUES ('F42F81F8-1300-41CA-89BB-36BD7417BE1E', 'fiction');".
            "REPLACE INTO `categories` (`category_id`, `categoryName`) VALUES ('3D56453C-C00E-4241-A2AE-9A6A1993E6A6', 'science');".
            "REPLACE INTO `categories` (`category_id`, `categoryName`) VALUES ('6C20AC2A-7817-4440-A67D-5A3D40471275', 'bio');";
    }
    private static function addBooks():string
    {
        return "REPLACE INTO `books` (`book_id`, `bookName`, `price`, `status`, `bookCategory_id`) ".
            "VALUES ('F42F81F8-1300-41CA-89BB-36BD7417BE1E', 'Час быка', 500, 'In stock', 'F42F81F8-1300-41CA-89BB-36BD7417BE1E');".
            "REPLACE INTO `books` (`book_id`, `bookName`, `price`, `status`, `bookCategory_id`) ".
            "VALUES ('C1679EB4-EA5F-479D-9CDB-16D2F305F872', 'Космическая адиссея', 700, 'Out of stock', 'F42F81F8-1300-41CA-89BB-36BD7417BE1E');".
            "REPLACE INTO `books` (`book_id`, `bookName`, `price`, `status`, `bookCategory_id`) ".
            "VALUES ('EFD373C7-9D5B-4333-97F2-112CDA29C3C0', 'Cloud Atlas', 700, 'Withdrawn from sale', 'F42F81F8-1300-41CA-89BB-36BD7417BE1E');".
            "REPLACE INTO `books` (`book_id`, `bookName`, `price`, `status`, `bookCategory_id`) ".
            "VALUES ('7CFAA067-38BA-47CD-BA34-1B5B751DF179', 'Заложники Солнца', 350, 'In stock', 'F42F81F8-1300-41CA-89BB-36BD7417BE1E');".
            "REPLACE INTO `books` (`book_id`, `bookName`, `price`, `status`, `bookCategory_id`) ".
            "VALUES ('95408850-51D7-4FA9-96B0-E097EE352A6B', 'Пароль Автора', 720, 'Out of stock', 'F42F81F8-1300-41CA-89BB-36BD7417BE1E');".
            "REPLACE INTO `books` (`book_id`, `bookName`, `price`, `status`, `bookCategory_id`) ".
            "VALUES ('91B1F18E-8CCC-40A3-BAFE-2CF03603ADD2', 'Steve Jobs', 900, 'In stock', '6C20AC2A-7817-4440-A67D-5A3D40471275');".
            "REPLACE INTO `books` (`book_id`, `bookName`, `price`, `status`, `bookCategory_id`) ".
            "VALUES ('36D94761-8F2C-41CA-96AA-C5E3A89C93B8', 'Эйнштейн', 720, 'Withdrawn from sale', '6C20AC2A-7817-4440-A67D-5A3D40471275');".
            "REPLACE INTO `books` (`book_id`, `bookName`, `price`, `status`, `bookCategory_id`) ".
            "VALUES ('1401D2E3-DC59-4166-B9C7-A67DA4136992', 'Краткая история времени', 630, 'Withdrawn from sale', '3D56453C-C00E-4241-A2AE-9A6A1993E6A6');".
            "REPLACE INTO `books` (`book_id`, `bookName`, `price`, `status`, `bookCategory_id`) ".
            "VALUES ('6AFAAAC6-75AC-4A2B-8AC8-D13770266185', 'test-science-book', 777, 'In stock', '3D56453C-C00E-4241-A2AE-9A6A1993E6A6');".
            "REPLACE INTO `books` (`book_id`, `bookName`, `price`, `status`, `bookCategory_id`) ".
            "VALUES ('FB1FBFF1-685E-4276-8B8F-C0CA7C1DECD6', 'test-book-science-2', 333, 'In stock', '3D56453C-C00E-4241-A2AE-9A6A1993E6A6');";
    }

    private static function addAuthors():string
    {
        return "REPLACE INTO `authors` (`authors_id`, `fullName`) VALUES ('1FBDF30D-51ED-4F64-A9DF-D7124C8D75B7', 'Stephen Mitchell');".
            "REPLACE INTO `authors` (`authors_id`, `fullName`) VALUES ('4C4022DB-C06D-4BF4-AEA4-996BC1E15457', 'Мила Бачурова');".
            "REPLACE INTO `authors` (`authors_id`, `fullName`) VALUES ('0B190360-5C8B-4980-8FA7-91B0E42B361C', 'Isaacson');".
            "REPLACE INTO `authors` (`authors_id`, `fullName`) VALUES ('A4EDE8B4-6628-49D7-A073-47061E195180', 'Ефремов А');".
            "REPLACE INTO `authors` (`authors_id`, `fullName`) VALUES ('0F6EA8B1-B647-4904-881B-FB52D076C326', 'Test-author-1');".
            "REPLACE INTO `authors` (`authors_id`, `fullName`) VALUES ('F805D859-5ED7-42B9-8AEF-A6D6C0DE2B14', 'С. Хлккинг');".
            "REPLACE INTO `authors` (`authors_id`, `fullName`) VALUES ('36447F46-3F96-4F21-A120-26F0173A5242', 'А. Кларк');".
            "REPLACE INTO `authors` (`authors_id`, `fullName`) VALUES ('7C3EA54E-2FED-4906-9999-F9D60D6C7CDC', 'author-test-2');";
    }

    private static function addBooksToAuthors():string
    {
        return "REPLACE INTO `bookstoauthors` (`book_id`, `authors_id`) VALUES ('F42F81F8-1300-41CA-89BB-36BD7417BE1E', 'A4EDE8B4-6628-49D7-A073-47061E195180');".
            "REPLACE INTO `bookstoauthors` (`book_id`, `authors_id`) VALUES ('C1679EB4-EA5F-479D-9CDB-16D2F305F872', '36447F46-3F96-4F21-A120-26F0173A5242');".
            "REPLACE INTO `bookstoauthors` (`book_id`, `authors_id`) VALUES ('EFD373C7-9D5B-4333-97F2-112CDA29C3C0', '1FBDF30D-51ED-4F64-A9DF-D7124C8D75B7');".
            "REPLACE INTO `bookstoauthors` (`book_id`, `authors_id`) VALUES ('7CFAA067-38BA-47CD-BA34-1B5B751DF179', '4C4022DB-C06D-4BF4-AEA4-996BC1E15457');".
            "REPLACE INTO `bookstoauthors` (`book_id`, `authors_id`) VALUES ('95408850-51D7-4FA9-96B0-E097EE352A6B', '4C4022DB-C06D-4BF4-AEA4-996BC1E15457');".
            "REPLACE INTO `bookstoauthors` (`book_id`, `authors_id`) VALUES ('91B1F18E-8CCC-40A3-BAFE-2CF03603ADD2', '0B190360-5C8B-4980-8FA7-91B0E42B361C');".
            "REPLACE INTO `bookstoauthors` (`book_id`, `authors_id`) VALUES ('36D94761-8F2C-41CA-96AA-C5E3A89C93B8', '0F6EA8B1-B647-4904-881B-FB52D076C326');".
            "REPLACE INTO `bookstoauthors` (`book_id`, `authors_id`) VALUES ('36D94761-8F2C-41CA-96AA-C5E3A89C93B8', '7C3EA54E-2FED-4906-9999-F9D60D6C7CDC');".
            "REPLACE INTO `bookstoauthors` (`book_id`, `authors_id`) VALUES ('1401D2E3-DC59-4166-B9C7-A67DA4136992', 'F805D859-5ED7-42B9-8AEF-A6D6C0DE2B14');".
            "REPLACE INTO `bookstoauthors` (`book_id`, `authors_id`) VALUES ('1401D2E3-DC59-4166-B9C7-A67DA4136992', '7C3EA54E-2FED-4906-9999-F9D60D6C7CDC');".
            "REPLACE INTO `bookstoauthors` (`book_id`, `authors_id`) VALUES ('6AFAAAC6-75AC-4A2B-8AC8-D13770266185', '0F6EA8B1-B647-4904-881B-FB52D076C326');".
            "REPLACE INTO `bookstoauthors` (`book_id`, `authors_id`) VALUES ('6AFAAAC6-75AC-4A2B-8AC8-D13770266185', '7C3EA54E-2FED-4906-9999-F9D60D6C7CDC');".
            "REPLACE INTO `bookstoauthors` (`book_id`, `authors_id`) VALUES ('FB1FBFF1-685E-4276-8B8F-C0CA7C1DECD6', '7C3EA54E-2FED-4906-9999-F9D60D6C7CDC');";
    }
}
