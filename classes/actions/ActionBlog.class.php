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

class PluginAntiup_ActionBlog extends PluginAntiup_Inherit_ActionBlog {

	protected function SubmitComment() {
		/**
		 * Проверям авторизован ли пользователь
		 */
		if (!$this->User_IsAuthorization()) {
			$this->Message_AddErrorSingle($this->Lang_Get('need_authorization'),$this->Lang_Get('error'));
			return;
		}
		/**
		* Проверяем топик
		*/
		if (!($oTopic=$this->Topic_GetTopicById(getRequestStr('cmt_target_id')))) {
			$this->Message_AddErrorSingle($this->Lang_Get('system_error'),$this->Lang_Get('error'));
			return;
		}

		if ($this->PluginAntiup_Main_CheckBlock($oTopic,$this->oUserCurrent)) {
			return parent::SubmitComment();
		} else {
			$this->Message_AddErrorSingle($this->Lang_Get('plugin.antiup.block_msg'),$this->Lang_Get('attention'));
			return;
		}
	}
}
