<?php
// administrator\components\com_blog\views\article\view.html.php

defined('_JEXEC') or die;

class BlogViewArticle extends JViewLegacy
{
    public function display($tpl = null)
    {
        // 跟 Model 要資料
        $this->item = $this->get('Item');

        // 包裝進 JData 方便取資料
        // 把回傳的 item 不管有沒有值，都包進 JData 物件中，因為 JData 會避免我們跟物件取值時，因為index不存在而造成錯誤訊息。舉例說明，假設 model 回傳 false (找不到資料)，我們執行 echo $this->item->title 就會報錯，因為 false 不是物件，或者該物件沒有 title 這個屬性。但我們把 $this->item 先用 JData 包起來後，在執行一次 echo $this->item->title 則不會報錯，只會印出空值，因為 JData 的 getter 能夠自動處理不存在的值。
        $this->item = new JData($this->item);

        // 取得全站設定中的編輯器設定檔
        $config = JFactory::getConfig();

        // 呼叫編輯器物件，直接 render 出來
        $this->introEditor = JEditor::getInstance($config->get('editor'))->display('introtext', $this->item->introtext, '600px', '300px', 50, 15);
        $this->fullEditor = JEditor::getInstance($config->get('editor'))->display('fulltext', $this->item->fulltext, '600px', '300px', 50, 15);

        $this->addToolbar();

        parent::display($tpl);
    }

    public function addToolbar()
    {
        JToolbarHelper::title('Article Edit', 'pencil');

        JToolbarHelper::save('article.save');
        JToolbarHelper::cancel('article.cancel');
    }
}

?>