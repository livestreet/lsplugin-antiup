<?php

class PluginAntiup_ModuleMain extends Module {

	public function Init() {

	}

	/**
	 * Проверка на необходимость блокировки
	 *
	 * @param $oTopic
	 * @param $oUser
	 *
	 * @return bool
	 */
	public function CheckBlock($oTopic,$oUser) {
		if ($oUser->isAdministrator()) {
			return true;
		}

		if (Config::Get('plugin.antiup.block_type')!='block') {
			return true;
		}

		if ($oTopic->getUserId()==$oUser->getId() and !$oTopic->getCountComment()) {
			if (!Config::Get('plugin.antiup.time') or time()-strtotime($oTopic->getDateAdd())<Config::Get('plugin.antiup.time')) {
				return false;
			}
			return true;
		}
		return true;
	}

	/**
	 * Проверка на необходимость понижения рейтинга
	 *
	 * @param $oTopic
	 * @param $oUser
	 *
	 * @return bool
	 */
	public function CheckRating($oTopic,$oUser) {
		if ($oUser->isAdministrator()) {
			return true;
		}

		if (Config::Get('plugin.antiup.block_type')!='rating') {
			return true;
		}

		if ($oTopic->getUserId()==$oUser->getId() and !$oTopic->getCountComment()) {
			if (!Config::Get('plugin.antiup.time') or time()-strtotime($oTopic->getDateAdd())<Config::Get('plugin.antiup.time')) {
				return false;
			}
			return true;
		}
		return true;
	}

}