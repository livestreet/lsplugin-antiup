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

class PluginAntiup_HookMain extends Hook {

    public function RegisterHook() {
        $this->AddHook('template_form_add_comment_end', 'FormAddCommentEnd', __CLASS__, -100);
        $this->AddHook('comment_add_after', 'CommentAddAfter');
    }

    public function FormAddCommentEnd() {
		$oSmarty=$this->Viewer_GetSmartyObject();
		$oTopic=$oSmarty->getTemplateVars('oTopic');
		$iMaxIdComment=$oSmarty->getTemplateVars('iMaxIdComment');

		if ($oUser=$this->User_GetUserCurrent() and $oTopic and is_int($iMaxIdComment) and !$this->PluginAntiup_Main_CheckRating($oTopic,$oUser)) {
			return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'inject.form.comment.tpl');
		}
	}

	public function CommentAddAfter($aParams) {
		$oTopic=$aParams['oTopic'];
		if ($oUser=$this->User_GetUserCurrent() and !$this->PluginAntiup_Main_CheckRating($oTopic,$oUser)) {
			/**
			 * Отнимаем рейтинг
			 */
			$oUser->setRating($oUser->getRating()-abs(Config::Get('plugin.antiup.rating')));
			$this->User_Update($oUser);
		}
	}
}
?>