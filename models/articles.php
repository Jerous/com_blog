<?php
// administrator\components\com_blog\models\articles.php

defined('_JEXEC') or die;

class BlogModelArticles extends JModelLegacy
{
    // 建議要嚴格遵守單複數的命名。因為我們取的是複數資料，一定要命名 items 與 articles 才不會混淆。
    public function getItems()
    {
        // 先從 JFactory 取得 $db 物件（Model 中可以直接用 $this->_db）
        // Or using $db = $this->_db;
        $db = JFactory::getDbo();

        // SQL 字串用 setQuery() 餵給 DB 物件
        $sql = "SELECT * FROM wizhb_blog_articles";

        $db->setQuery($sql);

        // 執行 loadObjectList() 就能取得多筆 Record 資料，每筆資料都是物件，全部包成一個陣列回傳。
        // If not thing found, return empty array.
        return $db->loadObjectList() ? : array();
    }
}

?>