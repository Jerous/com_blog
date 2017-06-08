<?php
// administrator\components\com_blog\views\articles\tmpl\default.php

// title 部分之所以用 $this->escape() 包起來是為了跳脫字元，以免有心人士輸入 JS 程式碼在 Title 中，製造 XSS 攻擊。
// introtext 則是先移除所有 HTML tags，然後再用 substr() 限制顯示字數。

// 加上 form，view.html.php的add按鈕才能作用，並將form的 id 與 name 都命名為 adminForm，這樣 Joomla 就會自動操作這個 form。
// 注意一下最下方還加上了兩個 Hidden inputs，每個頁面都要有 option 與 task 兩個 hidden inputs，這樣 post 出去時，才能正確導向我們想要的 Blog 元件。其中 task input 一旦缺少了，所有按鈕都會無法運作。

defined('_JEXEC') or die;
?>
<form action="<?php echo JUri::getInstance(); ?>" id="adminForm" name="adminForm" method="post">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Intro php內建的substr</th>
                <th>Intro JString</th>
                <th>Full JString</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->items as $item): ?>
            <tr>
                <td><?php echo $item->id; ?></td>
                <td>
                    <a href='<?php echo JRoute::_("index.php?option=com_blog&task=article.edit&id=" . $item->id); ?>'>
                        <?php echo $this->escape($item->title); ?>
                    </a>
                </td>
                <!-- php內建的substr()會無法判斷中文的字元數，因而我們限制50會造成最後面擷取剩下兩個字元的亂碼。 -->
                <td><?php echo substr(strip_tags($item->introtext), 0, 50); ?></td>

                <!-- JString 是很實用的 UTF-8 字元處理工具，再日後處理文字時，我們應該都要優先使用 JString -->
                <td><?php echo JString::substr(strip_tags($item->introtext), 0, 50); ?></td>
                <td><?php echo JString::substr(strip_tags($item->fulltext), 0, 50); ?></td>

                <td>
                    <a href='<?php echo JRoute::_('index.php?option=com_blog&task=article.delete&id=' . $item->id) ?>' class="btn">
                        <span class="icon-trash text-error"></span>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="hidden-inputs">
        <input type="hidden" name="option" value="com_blog" />
        <input type="hidden" name="task" value="" />
    </div>
</form>