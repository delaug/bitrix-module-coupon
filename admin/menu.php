<?php
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$menu = array(
    array(
        'parent_menu' => 'global_menu_content',
        'sort' => 400,
        'text' => Loc::getMessage('COUPON_MENU_TITLE'),
        'title' => Loc::getMessage('COUPON_MENU_TITLE'),
        'url' => 'coupon_admin.php',
        'items_id' => 'menu_references',
        'items' => array(
            array(
                'text' => Loc::getMessage('COUPON_SUBMENU_TITLE'),
                'url' => 'coupon_admin.php?lang=' . LANGUAGE_ID,
                'more_url' => array('coupon_admin.php?lang=' . LANGUAGE_ID),
                'title' => Loc::getMessage('COUPON_SUBMENU_TITLE'),
            ),
        ),
    ),
);

return $menu;