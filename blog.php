<?php
// administrator\components\com_blog\blog.php
defined('_JEXEC') or die;

// Get request input object 取得網址 GET 或 POST 進來的參數
$input = JFactory::getApplication()->input;

// Execute the task.
$controller = JControllerLegacy::getInstance('Blog');
//  Joomla 中以 display 當做預設的 task
$controller->execute($input->get('task'));
$controller->redirect();

echo '<br> This is blog.php';

?>