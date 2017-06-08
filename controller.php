<?php
// administrator\components\com_blog\controller.php

defined('_JEXEC') or die;

class BlogController extends JControllerLegacy
{
    // 範例一用
    // // Joomla 中以 display 當做預設的controller task
    // public function display($cachable = false, $urlparams = array())
    // {
    //     echo 'This is controller.php';
    //     // Get model & view
    //     $model_example = $this->getModel('Example');
    //     $model_sakura = $this->getModel('Sakura');

    //     $modelArticles = $this->getModel('Articles');

    //     // $view = $this->getView('Example', 'html');    // example是從model直接寫資料的範例
    //     $view = $this->getView('Articles', 'html');  // articles是從mysql中撈資料的範例


    //     /* 傳統MVC用法 
    //         // Get item
    //         // Model 實作了一個 getItem() method 讓 controller 可以要資料
    //         $item = $model->getItem();

    //         // Push item into view
    //         $view->item = $item;
    //     */


    //     /* 
    //     Joomla MVC用法 
    //     從 controller 中將 View 與 Model 繫結起來，於是 View 擁有權力決定要跟 Model 要什麼資料（但 View 不能選擇 Model）
    //     */
    //     // Push model into view
    //     // setModel() 的第二個參數 true 代表這是 default model，意味著你可以裝載多個 model。default是false
    //     // 將 model 注入 view 裡面
    //     $view->setModel($model_example);
    //     $view->setModel($model_sakura);

    //     $view->setModel($modelArticles, true);

    //     $view->display();
    // }

    public function flower()
    {
        echo 'Flower';
    }


    // 當網址沒有提供 view 時，在給予一個預設值 articles
    protected $default_view = 'articles';
    
    // JControllerLegacy 已經幫我們寫好預設的 display() 了，其實我們只要設定好 default_view，剩下的都交給 parent 執行即可。一開始寫給大家看的只是範例而已。

    // public function display($cachable = false, $urlparams = array())
    // {
    //     // 用 input 拿出網址參數中的 view 值，藉由這個值決定要選擇哪個 view
    //     $view = $this->input->get('view', $this->default_view);
    //     // 取得 layout 的值，set 進 view 中，layout 名稱就是 template 名稱
    //     $layout = $this->input->get('layout', 'default');

    //     // Get model & view
    //     $model = $this->getModel($view);
    //     $view = $this->getView($view, 'html');

    //     // Push model into view
    //     $view->setModel($model, true);

    //     $view->setLayout($layout);

    //     $view->display();
    // }

}

?>