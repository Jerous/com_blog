<?php
// administrator\components\com_blog\models\sakura.php
defined('_JEXEC') or die;

class BlogModelSakura extends JModelLegacy
{
    public function getSakura()
    {
        $item = new stdClass;

        $item->title = 'This is models/sakura.php getSakura Var title';

        return $item;
    }
}

?>