<?php
// administrator/components/com_blog/tables/article.php

defined('_JEXEC') or die;

// 用 JTable 來快速的存取單一一筆資料庫記錄。
class BlogTableArticle extends JTable
{
    public function __construct($db)
    {
        parent::__construct('wizhb_blog_articles', 'id', $db);
    }
}

?>