<!-- Header -->
<{include file='db:wgevents_admin_header.tpl' }>

<{if $categories_list|default:''}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class="center">&nbsp;</th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_CATEGORY_ID}></th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_CATEGORY_PID}></th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_CATEGORY_NAME}></th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_CATEGORY_DESC}></th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_CATEGORY_LOGO}></th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_CATEGORY_COLOR}></th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_CATEGORY_BORDERCOLOR}></th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_CATEGORY_BGCOLOR}></th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_CATEGORY_OTHERCSS}></th>
                <th class="center"><{$smarty.const._MA_WGEVENTS_STATUS}></th>
                <th class="center"><{$smarty.const._MA_WGEVENTS_DATECREATED}></th>
                <th class="center"><{$smarty.const._MA_WGEVENTS_SUBMITTER}></th>
                <th class="center width5"><{$smarty.const._MA_WGEVENTS_ACTION}></th>
            </tr>
        </thead>
        <{if $categories_count|default:''}>
        <tbody id="categories-list">
            <{foreach item=category from=$categories_list}>
            <tr class='<{cycle values='odd, even'}>' id="order_<{$category.id}>">
                <td class='center'><img src="<{$wgevents_icons_url_16}>/up_down.png"></td>
                <td class='center'><{$category.id}></td>
                <td class='center'><{$category.pid}></td>
                <td class='center'><{$category.name}></td>
                <td class='center'><{$category.desc_short}></td>
                <td class='center'><img src="<{$wgevents_upload_url|default:false}>/categories/logos/<{$category.logo}>" alt="categories" style="max-width:100px" ></td>
                <td class='center'><span style='background-color:<{$category.color}>;'>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td class='center'><span style='background-color:<{$category.bordercolor}>;'>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td class='center'><span style='background-color:<{$category.bgcolor}>;'>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td class='center'><{$category.othercss}></td>
                <td class='center'><img src="<{$modPathIcon16}>status<{$category.status}>.png" alt="<{$category.status_text}>" title="<{$category.status_text}>" ></td>
                <td class='center'><{$category.datecreated}></td>
                <td class='center'><{$category.submitter}></td>
                <td class="center  width5">
                    <a href="categories.php?op=edit&amp;cat_id=<{$category.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}> categories" ></a>
                    <a href="categories.php?op=clone&amp;cat_id_source=<{$category.id}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 editcopy.png}>" alt="<{$smarty.const._CLONE}> categories" ></a>
                    <a href="categories.php?op=delete&amp;cat_id=<{$category.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}> categories" ></a>
                </td>
            </tr>
            <{/foreach}>
        </tbody>
        <{/if}>
    </table>
    <div class="clear">&nbsp;</div>
    <{if $pagenav|default:''}>
        <div class="xo-pagenav floatright"><{$pagenav|default:false}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>
<{if $form|default:''}>
    <{$form|default:false}>
<{/if}>
<{if $error|default:''}>
    <div class="errorMsg"><strong><{$error|default:false}></strong></div>
<{/if}>

<!-- Footer -->
<{include file='db:wgevents_admin_footer.tpl' }>