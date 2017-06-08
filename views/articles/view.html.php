<?php
// administrator\components\com_blog\views\articles\view.html.php

defined('_JEXEC') or die;

class BlogViewArticles extends JViewLegacy
{
    public function display($tpl = null)
    {
        $this->items = $this->get('Items');

        // 加上後台的頁面標題
        $this->addToolbar();

        parent::display($tpl);
    }

    // 加上後台的頁面標題
    public function addToolbar()
    {
        // 呼叫 JToolbarHelper 來建立標題
        JToolbarHelper::title('Articles');

        // 第一個參數 add 代表按鈕要送出的 task 值。
        // 從controller.php將add()移到controllers/article.php，所以不再用'add'，不然又會導到controller.php中去找add()
        // JToolbarHelper::addNew('add');
        JToolbarHelper::addNew('article.add');
    }
}

?>