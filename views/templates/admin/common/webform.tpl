{if isset($webform_url)}
<div id="getresponse_webform" class="block" data-position="{$position}">
    <script type="text/javascript" src="{$webform_url|escape:'htmlall':'UTF-8'}{$style|escape:'htmlall':'UTF-8'}"></script>
</div>
{/if}