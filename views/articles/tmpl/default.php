<?php
// administrator\components\com_blog\views\articles\tmpl\default.php

// title 部分之所以用 $this->escape() 包起來是為了跳脫字元，以免有心人士輸入 JS 程式碼在 Title 中，製造 XSS 攻擊。
// introtext 則是先移除所有 HTML tags，然後再用 substr() 限制顯示字數。

// 加上 form，view.html.php的add按鈕才能作用，並將form的 id 與 name 都命名為 adminForm，這樣 Joomla 就會自動操作這個 form。
// 注意一下最下方還加上了兩個 Hidden inputs，每個頁面都要有 option 與 task 兩個 hidden inputs，這樣 post 出去時，才能正確導向我們想要的 Blog 元件。其中 task input 一旦缺少了，所有按鈕都會無法運作。

defined('_JEXEC') or die;

// 取得目前的排序狀態，第二個參數是如果沒有時的預設值
$currentOrder = $this->state->get('list.ordering', 'id');
$currentDir   = $this->state->get('list.direction', 'asc');

$filterPublished = (string) $this->state->get('filter.published', '');
?>
<form action="<?php echo JUri::getInstance(); ?>" id="adminForm" name="adminForm" method="post">

    <div class="filter-bar">
        <div class="btn-wrapper input-append">
            <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->state->get('filter.search'); ?>" placeholder="搜尋">
            <button type="submit" class="btn">
                <i class="icon-search"></i>
            </button>
        </div>

        <!-- 加一個 onchange="this.form.submit();" 的屬性，一旦變更項目，就會自動把表單 post 出去 -->
        <div class="pull-right filter-inputs">
            <select name="filter_published" id="filter_published" onchange="this.form.submit();">
                <option value="">- 請選擇 -</option>
                <option value="1" <?php echo ($filterPublished == '1') ? 'selected="selected"' : ''; ?>>發佈</option>
                <option value="0" <?php echo ($filterPublished == '0') ? 'selected="selected"' : ''; ?>>未發佈</option>
            </select>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <!--
                <th>ID</th>
                <th>Title</th>
                <th>Intro php內建的substr</th>
                <th>Intro JString</th>
                <th>Full JString</th>
                <th>Delete</th>
                -->

                <!-- 改用 JHtmlGrid::sort() -->
                <th><?php echo JHtmlGrid::sort('ID', 'id', $currentDir, $currentOrder); ?></th>
                <th><?php echo JHtmlGrid::sort('Title', 'title', $currentDir, $currentOrder); ?></th>
                <th><?php echo JHtmlGrid::sort('Published', 'published', $currentDir, $currentOrder); ?></th>
                <th><?php echo JHtmlGrid::sort('Introtext', 'introtext', $currentDir, $currentOrder); ?></th>
                <th><?php echo JHtmlGrid::sort('Fulltext', 'fulltext', $currentDir, $currentOrder); ?></th>
                <th><?php echo JHtmlGrid::sort('Delete', 'delete', $currentDir, $currentOrder); ?></th>
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

                <!--發佈狀態的顯示，1是發佈，0是未發佈-->
                <td>
                    <?php if ($item->published): ?>
                    <span class="label label-success">發佈</span>
                    <?php else: ?>
                    <span class="label label-important">未發佈</span>
                    <?php endif; ?>
                </td>

                <!-- php內建的substr()會無法判斷中文的字元數，因而我們限制50會造成最後面擷取剩下兩個字元的亂碼。 -->
                <!--<td><?php echo substr(strip_tags($item->introtext), 0, 50); ?></td>-->

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

        <input name="filter_order" type="hidden" value="<?php echo $currentOrder; ?>" />
        <input name="filter_order_Dir" type="hidden" value="<?php echo $currentDir ?>" />
    </div>
</form>