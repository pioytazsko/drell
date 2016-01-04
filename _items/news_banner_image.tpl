<?
$image = getfiles_pictures("attachments/[id]/");
?>
<div id="banner_[id]" style="display:none;">
<a href="<? echo get_link('[id]');?>" title="[name]"><img src="/attachments/[id]/<? echo $image[0];?>" border="0" width="320" height="265" alt="[name]" title="[name]"></a>
</div>