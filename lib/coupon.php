<?
    namespace Bitrix\Coupon;

    use CIBlockElement;

    use Exception;

    class Coupon {
        const IBLOCK_ID_COUPON = 1;
        
        public static function getStatistics() {            
            return [
                'ACTIVE' => self::getActiveCount(),
                'EXPIRED' => self::getExpiredCount(),
            ];
        }

        public static function getCount($order = '<') {
            $arRules = ['<','<=', '>', '>='];
            if(!in_array($order, $arRules)) {
                throw new Exception('$order может принимать только: '.implode(',', $arRules)); 
            }

            $arFilter = [
                'IBLOCK_ID' => self::IBLOCK_ID_COUPON,
                $order.'PROPERTY_EXPIRED_AT' => date('Y-m-d H:i:s')
            ];
            
            $arSelect = ['ID','IBLOCK_ID', 'PROPERTY_KEY', 'PROPERTY_EXPIRED_AT'];

            $rs = CIBlockElement::GetList(['SORT' => 'ASC'], $arFilter, false, false, $arSelect);
            
            return $rs->DB->db_Conn->affected_rows;
        }

        public static function getActiveCount() {
            return self::getCount('>=');
        }

        public static function getExpiredCount() {
            return self::getCount();
        }
    }
?>