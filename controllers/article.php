<?php
// administrator\components\com_blog\controllers\article.php

// task=xxx 會指向到 BlogController::xxx() ，而只要改用 task=article.xxx 就會前往 BlogControllerArticle::xxx()

defined('_JEXEC') or die;

class BlogControllerArticle extends JControllerLegacy
{
    public function foo()
    {
        echo 'Article controller foo';
    }

    public function add()
    {
        // JRoute::_() 是一個可以幫我們自動處理網址前綴的功能，比如我們的 joomla 裝在子資料夾下( http://site.com/joomla/ )時，JRoute 會自動把 /joomla/ 加在你的網址前面。
        // 第二個參數用 false 是因為預設會把 & 轉換成 &amp; ，這是印在頁面上時必要的 XHTML 標準，可以我們直接 redirect 時不需要轉換，所以就用 false。
        $this->setRedirect(JRoute::_('index.php?option=com_blog&view=article&layout=edit', false));
    }

    public function save()
    {
        // 只取得 POST 的資料
        $post = $this->input->post;

        // 將 POST 資料塞進一個陣列中，用 getString() 避免不合法字元
        $data['id']      = $post->getInt('id');
        $data['title']   = $post->getString('title');
        $data['alias']   = $post->getString('alias');
        $data['created'] = $post->getString('created');

        // HTML 資料必須用 getRaw()，不然會被過濾掉
        $data['introtext'] = $post->getRaw('introtext');
        $data['fulltext']  = $post->getRaw('fulltext');

        // 取得 Article Model 並執行 save()
        $model = $this->getModel('Article');

        $model->save($data);

        // save() 完成後我們跳回 Article List 頁面
        $this->setRedirect(JRoute::_('index.php?option=com_blog&view=articles', false));
    }

    public function cancel()
    {
        $this->setRedirect(JRoute::_('index.php?option=com_blog&view=articles', false));
    }

    public function delete()
    {
        $id = $this->input->get('id');

        if (!$id)
        {
            $this->setRedirect(JRoute::_('index.php?option=com_blog&view=articles', false), '沒有 ID', 'warning');

            return false;
        }

        $model = $this->getModel('Article');

        $model->delete($id);

        $this->setRedirect(JRoute::_('index.php?option=com_blog&view=articles', false), '刪除成功');
    }

    public function edit()
    {
        $id = $this->input->get('id');

        $this->setRedirect(JRoute::_('index.php?option=com_blog&view=article&layout=edit&id=' . $id, false));
    }
}

?>