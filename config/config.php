<?php
/*-------------------------------------------------------
*
*   LiveStreet Engine Social Networking
*   Copyright © 2008 Mzhelskiy Maxim
*
*--------------------------------------------------------
*
*   Official site: www.livestreet.ru
*   Contact e-mail: rus.engine@gmail.com
*
*   GNU General Public License, version 2:
*   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*
---------------------------------------------------------
*/

/**
 * Тип блокировки
 * block - полностью блокирует возможность добавить первый комментарий от автора топика
 * rating - дает возможность написать первый комментарий, но за это минусует рейтинг пользователя
 */
$config['block_type']='rating'; // block или rating

/**
 * На сколько минусовать рейтинг, актуально при $config['block_type']='rating';
 */
$config['rating']=0.3;

/**
 * Время в секундах после публикации топика, блокировка перестает действовать если прошло больше этого времени
 * 0 или false - блокировка не ограничивается по времени и действует всегда
 */
$config['time']=60*60*24*1; // 1 день

return $config;
?>