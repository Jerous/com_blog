<?php
// administrator\components\com_blog\views\example\view.html.php

defined('_JEXEC') or die;

class BlogViewExample extends JViewLegacy
{
    public function display($tpl = null)
    {
        echo '<br> This is view.html.php';

        $this->title = 'This is view.html.php Var title';
        $this->content = 'This is view.html.php Var content';
        $this->date = new JDate('now', 'Asia/Taipei');

        /* 傳統MVC用法 
        $this->item->date = $this->item->date->format('Y-m-d', true);
        */

        /* 
        Joomla MVC用法 
        從 controller 中將 View 與 Model 繫結起來，於是 View 擁有權力決定要跟 Model 要什麼資料（但 View 不能選擇 Model）
        */
        // 接著 View 物件拿出 Model 來
        // $model = $this->getModel('Example');

        /*
        View物件中，呼叫get('Xxx')就等於呼叫 Default Model 中的 getXxx()，如果這個 method 不存在，則返回 NULL。
        讓我們的程式碼更簡潔，也更容易處理錯誤狀況。
        */
        // $this->item = $model->getItem();
        $this->item = $this->get('Item', 'Example');
        $this->flower = $this->get('ExampleFlower', 'Example');

        $this->sakura = $this->get('Sakura', 'Sakura');

        if(!$this->item || !$this->flower || !$this->sakura) 
        {
            throw new \Exception('No item.');
        }

        // model格式的處理在view這邊做掉，實際render的頁面就純render功能就好
        $this->item->date = $this->item->date->format('Y-m-d', true); 

        parent::display($tpl);
    }
}

?>