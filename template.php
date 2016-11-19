<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="row">
    <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?><br/>
    <? endif; ?>
    <?foreach(array_chunk($arResult["ITEMS"], $arParams["COLS_NUMBER"]) as $arPartItems):?>
<div class="row">
        <? foreach ($arPartItems as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
<article class="col-md-6 entry entry-list">
<div class="row" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                        <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
<div class="col-xs-4 col-xss-12">
<figure class="entry-media"><a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><img class="img-responsive" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" title="<?= $arItem["NAME"] ?>"/></a>
</figure>
</div>
<? else: ?>
<div class="col-xs-4 col-xss-12">
<figure class="entry-media"><img class="img-responsive" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" title="<?= $arItem["NAME"] ?>"/></figure>
</div>
                        <? endif; ?>
                    <? endif ?>
<div class="col-xs-8 col-xss-12">
                        <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                            <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
<h3 class="entry-title"><a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><? echo $arItem["NAME"] ?></a></h3>
                            <? else: ?>
<h3 class="entry-title"><? echo $arItem["NAME"] ?></h3>
                            <? endif; ?>
                        <? endif; ?>
                        <? if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]): ?>
<div class="entry-meta"><span><i class="fa fa-clock-o"></i><? echo $arItem["DISPLAY_ACTIVE_FROM"] ?></span>
                            <? endif ?>
<div class="entry-content"><? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
<? echo $arItem["PREVIEW_TEXT"]; ?>
<? endif; ?></div>
                            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
<div style="clear:both"></div>
                            <? endif ?>
                            <? foreach ($arItem["FIELDS"] as $code => $value): ?>
<small>
<?= GetMessage("IBLOCK_FIELD_" . $code) ?>:&nbsp;<?= $value; ?>
</small><br/>
<? endforeach; ?>
<? foreach ($arItem["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>
<small>
<?= $arProperty["NAME"] ?>:&nbsp;
<? if (is_array($arProperty["DISPLAY_VALUE"])): ?>
<?= implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]); ?>
<? else: ?>
<?= $arProperty["DISPLAY_VALUE"]; ?>
<? endif ?>
</small><br/>
<? endforeach; ?>
</div>
</div>
</article>
<? endforeach; ?>
</div>
<?endforeach;?>
        <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
            <br/><?= $arResult["NAV_STRING"] ?>
        <? endif; ?>
</div>