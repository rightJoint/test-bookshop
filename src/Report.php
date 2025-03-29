<?php
class Report
{
    private $db;
    public $reportData = [];
    private $connStatus = false;

    function __construct(PDO $db)
    {
        $this->db = $db;
        try {
            $this->db->query('use '.$db::DB);
            $this->connStatus = true;
        }catch (\Exception $e) {
            echo 'error: cant connect database. please open page http://bookshop.local/install.php<br>';
            echo $e->getMessage();
        }
    }

    public function getData():void
    {
        if($this->connStatus){
            $qry = 'select books.bookName, categories.categoryName from books '.
                'INNER JOIN categories ON books.bookCategory_id = categories.category_id;';
            $res = $this->db->query($qry);

            if($res) {
                if($res->rowCount()){
                    while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                        $this->reportData[$row['categoryName']][] = $row['bookName'];
                    }
                }
            }else{
                echo 'unknown error. please open page http://bookshop.local/install.php<br>';
            }
        }
    }

    public function generateHtml():void
    {
        echo '<!DOCTYPE html>'.
            '<html lang="ru">'.
            '<head>'.
            '<meta http-equiv="content-type" content="text/html"; charset="utf-8"/>'.
            '<title>Отчет-аккардион</title>'.
            '<script src="/js/googleapis.js"></script>'.
            '<script src="/js/report.js"></script>'.
            '</head>'.
            '<body>'.
            '<h1>Отчет-аккардион</h1>'.
            '<div class="report">';

        if(count($this->reportData)){
            echo '<ul>';
            foreach ($this->reportData as $category => $books){
                echo '<li>'.$category.', найдено '.count($books).' книг. [<span class="books" style="cursor: pointer">+</span>]';
                echo '<ul style="display: none;">';
                foreach ($books as $bNum => $bName){
                    echo '<li>'.$bName.'</li>';
                }
                echo '</ul>';
                echo '</li>';
            }
            echo '</ul>';
        }

        echo '</div>'.
            '</body>'.
            '</html>';
    }
}