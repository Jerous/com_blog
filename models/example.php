<?php
// administrator\components\com_blog\models\example.php
defined('_JEXEC') or die;

class BlogModelExample extends JModelLegacy
{
    public function getItem()
    {
        $item = new stdClass;

        $item->title = 'This is models/example.php getItem Var title';
        $item->content = 'This is models/example.php Var content';
        $item->date = new JDate('now', 'Asia/Taipei');

        return $item;
    }

    public function getExampleFlower()
    {
        $item = new stdClass;

        $item->title = 'This is models/example.php getExampleFlower Var title';

        return $item;
    }
}

?>