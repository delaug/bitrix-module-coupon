<?

use Bitrix\Coupon\Coupon;

    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
?>

<?
    if (CModule::IncludeModule("coupon"))
    {
        $arStatistics = Coupon::getStatistics();
        ?>
            <table>
                <tr>
                    <th>Купоны</th>
                    <th>Кол-во</th>
                </tr>                
                <tr>
                    <td>Активные</td>
                    <td><?=$arStatistics['ACTIVE']?></td>
                </tr>
                <tr>
                    <td>Истёкшие</td>
                    <td><?=$arStatistics['EXPIRED']?></td>
                </tr>
            </table>
        <?        
    }
?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php"); ?>