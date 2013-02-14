{assign var="rating" value=Config::Get('plugin.antiup.rating')}
<div style="color: #f00;margin-bottom: 10px;margin-top: 10px;">
	{$aLang.plugin.antiup.block_rating_notice|ls_lang:"rating%%$rating"}
</div>