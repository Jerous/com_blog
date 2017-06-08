<?php
// administrator\components\com_blog\models\articles.php

defined('_JEXEC') or die;

/* 
有比較複雜的查詢邏輯，我們無法方便的用 Table 來取得資料，可藉由物件導向的方法來寫出 SQL 指令，這個物件叫做 Query Builder
$query = $db->getQuery(true);

//簡單的 select
$query->select('*')
    ->from('#__my_table')
    ->where('id = 12')
    ->where('state >= 1')
    ->order('date ASC');

// 簡單的 insert
$query->insert('#__my_table')
    ->columns('title, alias, introtext')
    ->values($values);

// 簡單的 Update
$query->update('#__my_table')
    ->set('title = "New Title"')
    ->set('alias = "New Alias"')
    ->where('id = 12');

// 簡單的 Delete
$query->delete('#__my_table')
    ->where('id = 15');
*/

class BlogModelArticles extends JModelLegacy
{
    protected function populateState()
    {
        $app = JFactory::getApplication();
        $input = $app->input;

        // 我們把 filter_search 從 request 中拿出來，暫存在 filter.search 的 state 中
        // Model 的 State 是一種狀態，我們可以隨時改變這個狀態內儲存的值，就能改變Model 的行為。
        // $this->setState('filter.search', $input->getString('filter_search'));

        // 搜尋條件能夠保存在瀏覽器中，直到你清空搜尋條件為止。我們可以改用 Session 來記錄搜尋欄位。
        // 這個功能會自動從 request 拿資料並存放到 session，如果下一次發現 request 內沒有值的時候，就會拿 session 內的當預設值，如果 request 有值的時候，就會覆蓋掉 session。
        $this->setState('filter.search', $app->getUserStateFromRequest('blog.articles.search', 'filter_search'));

        $this->setState('list.ordering', $app->getUserStateFromRequest('blog.articles.ordering', 'filter_order'));
        $this->setState('list.direction', $app->getUserStateFromRequest('blog.articles.direction', 'filter_order_Dir'));
    }

    // 建議要嚴格遵守單複數的命名。因為我們取的是複數資料，一定要命名 items 與 articles 才不會混淆。
    public function getItems()
    {
        // 先從 JFactory 取得 $db 物件（Model 中可以直接用 $this->_db）
        // Or using $db = $this->_db;
        $db = JFactory::getDbo();

        // // SQL 字串用 setQuery() 餵給 DB 物件
        // $sql = "SELECT * FROM wizhb_blog_articles";

        // 取得 Query Builder，true 代表一個新的物件。沒有 true 的話會取得上一次 setQuery() 的內容。
        $query = $db->getQuery(true);

        // 把 order 用的 state 拿出來（第二個參數是不存在時的預設值）
        $ordering   = $this->getState('list.ordering', 'id');
        $direction = $this->getState('list.direction', 'asc');

        // 接下來從 state 中把 search 內容拿出來
        $search = $this->getState('filter.search');

        // 如果有的話，就加上 LIKE 的 SQL 來做搜尋
        if ($search)
        {
            // 如何使用 MySQL LIKE 模糊搜尋 http://goo.gl/k9vJOi
            // $query->where('title LIKE "%' . $search . '%"');

            $conditions = '(`title` LIKE "%' . $search . '%"';
            $conditions .= ' OR `introtext` LIKE "%' . $search . '%"';
            $conditions .= ' OR `fulltext` LIKE "%' . $search . '%")';

            $query->where($conditions);
        }

        $query->select('*')
            ->from('wizhb_blog_articles')
            // ->where('published >= 1')
            // ->order('id ASC');
            ->order('`' . $ordering . '`' . ' ' . $direction);

        $db->setQuery($query);

        // 執行 loadObjectList() 就能取得多筆 Record 資料，每筆資料都是物件，全部包成一個陣列回傳。
        // If not thing found, return empty array.
        return $db->loadObjectList() ? : array();
    }
}

?>