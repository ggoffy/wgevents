<!-- Header -->
<{include file='db:wgevents_admin_header.tpl' }>

<{if $fields_list|default:''}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class="center"><{$smarty.const._AM_WGEVENTS_FIELD_ID}></th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_FIELD_TYPE}></th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_FIELD_CAPTION}></th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_FIELD_VALUE}></th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_FIELD_PLACEHOLDER}></th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_FIELD_REQUIRED}></th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_FIELD_DEFAULT}></th>
                <th class="center"><{$smarty.const._MA_WGEVENTS_PRINT}></th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_FIELD_DISPLAY_VALUES}></th>
                <th class="center"><{$smarty.const._AM_WGEVENTS_FIELD_DISPLAY_PLACEHOLDER}></th>
                <th class="center"><{$smarty.const._MA_WGEVENTS_WEIGHT}></th>
                <th class="center"><{$smarty.const._MA_WGEVENTS_STATUS}></th>
                <th class="center"><{$smarty.const._MA_WGEVENTS_DATECREATED}></th>
                <th class="center"><{$smarty.const._MA_WGEVENTS_SUBMITTER}></th>
                <th class="center width5"><{$smarty.const._MA_WGEVENTS_ACTION}></th>
            </tr>
        </thead>
        <{if $fields_count|default:''}>
        <tbody>
            <{foreach item=field from=$fields_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$field.id}></td>
                <td class='center'><{$field.type_text}></td>
                <td class='center'><{$field.name}></td>
                <td class='center'><{$field.value_list}></td>
                <td class='center'><{$field.placeholder}></td>
                <td class='center'>
                    <{if $field.fd_required|default:false}>
                        <a href="fields.php?op=change_yn&amp;fd_id=<{$field.id}>&amp;field=fd_required&amp;value=0&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._AM_WGEVENTS_SETOFF}>"><img src="<{$wgevents_icons_url_16}>/<{$field.fd_required}>.png" alt="<{$smarty.const._AM_WGEVENTS_SETOFF}> fields" ></a>
                    <{else}>
                        <a href="fields.php?op=change_yn&amp;fd_id=<{$field.id}>&amp;field=fd_required&amp;value=1&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._AM_WGEVENTS_SETON}>"><img src="<{$wgevents_icons_url_16}>/<{$field.fd_required}>.png" alt="<{$smarty.const._AM_WGEVENTS_SETON}> fields" ></a>
                    <{/if}>
                </td>
                <td class='center'>
                    <{if $field.fd_default|default:false}>
                    <a href="fields.php?op=change_yn&amp;fd_id=<{$field.id}>&amp;field=fd_default&amp;value=0&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._AM_WGEVENTS_SETOFF}>"><img src="<{$wgevents_icons_url_16}>/<{$field.fd_default}>.png" alt="<{$smarty.const._AM_WGEVENTS_SETOFF}> fields" ></a>
                    <{else}>
                    <a href="fields.php?op=change_yn&amp;fd_id=<{$field.id}>&amp;field=fd_default&amp;value=1&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._AM_WGEVENTS_SETON}>"><img src="<{$wgevents_icons_url_16}>/<{$field.fd_default}>.png" alt="<{$smarty.const._AM_WGEVENTS_SETON}> fields" ></a>
                    <{/if}>
                </td>
                <td class='center'>
                    <{if $field.fd_print|default:false}>
                    <a href="fields.php?op=change_yn&amp;fd_id=<{$field.id}>&amp;field=fd_print&amp;value=0&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._AM_WGEVENTS_SETOFF}>"><img src="<{$wgevents_icons_url_16}>/<{$field.fd_print}>.png" alt="<{$smarty.const._AM_WGEVENTS_SETOFF}> fields" ></a>
                    <{else}>
                    <a href="fields.php?op=change_yn&amp;fd_id=<{$field.id}>&amp;field=fd_print&amp;value=1&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._AM_WGEVENTS_SETON}>"><img src="<{$wgevents_icons_url_16}>/<{$field.fd_print}>.png" alt="<{$smarty.const._AM_WGEVENTS_SETON}> fields" ></a>
                    <{/if}>
                </td>



                <td class='center'>
                    <{if $field.fd_display_values|default:false}>
                    <a href="fields.php?op=change_yn&amp;fd_id=<{$field.id}>&amp;field=fd_display_values&amp;value=0&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._AM_WGEVENTS_SETOFF}>"><img src="<{$wgevents_icons_url_16}>/<{$field.fd_display_values}>.png" alt="<{$smarty.const._AM_WGEVENTS_SETOFF}> fields" ></a>
                    <{else}>
                    <a href="fields.php?op=change_yn&amp;fd_id=<{$field.id}>&amp;field=fd_display_values&amp;value=1&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._AM_WGEVENTS_SETON}>"><img src="<{$wgevents_icons_url_16}>/<{$field.fd_display_values}>.png" alt="<{$smarty.const._AM_WGEVENTS_SETON}> fields" ></a>
                    <{/if}>
                </td>
                <td class='center'>
                    <{if $field.fd_display_placeholder|default:false}>
                    <a href="fields.php?op=change_yn&amp;fd_id=<{$field.id}>&amp;field=fd_display_placeholder&amp;value=0&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._AM_WGEVENTS_SETOFF}>"><img src="<{$wgevents_icons_url_16}>/<{$field.fd_display_placeholder}>.png" alt="<{$smarty.const._AM_WGEVENTS_SETOFF}> fields" ></a>
                    <{else}>
                    <a href="fields.php?op=change_yn&amp;fd_id=<{$field.id}>&amp;field=fd_display_placeholder&amp;value=1&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._AM_WGEVENTS_SETON}>"><img src="<{$wgevents_icons_url_16}>/<{$field.fd_display_placeholder}>.png" alt="<{$smarty.const._AM_WGEVENTS_SETON}> fields" ></a>
                    <{/if}>
                </td>




                <td class='center'><{$field.weight}></td>
                <td class='center'><img src="<{$modPathIcon16}>status<{$field.status}>.png" alt="<{$field.status_text}>" title="<{$field.status_text}>" ></td>
                <td class='center'><{$field.datecreated}></td>
                <td class='center'><{$field.submitter}></td>
                <td class="center  width5">
                    <a href="fields.php?op=edit&amp;fd_id=<{$field.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}> fields" ></a>
                    <{if $field.custom|default:false}>
                        <a href="fields.php?op=clone&amp;fd_id_source=<{$field.id}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 editcopy.png}>" alt="<{$smarty.const._CLONE}> fields" ></a>
                        <a href="fields.php?op=delete&amp;fd_id=<{$field.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}> fields" ></a>
                    <{/if}>
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