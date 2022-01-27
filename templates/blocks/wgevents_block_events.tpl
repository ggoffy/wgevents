<table class='table table-<{$table_type|default:false}>'>
    <thead>
        <tr class='head'>
            <th>&nbsp;</th>
            <th class='center'><{$smarty.const._MB_WGEVENTS_EV_NAME}></th>
            <th class='center'><{$smarty.const._MB_WGEVENTS_EV_LOGO}></th>
        </tr>
    </thead>
    <{if count($block)}>
    <tbody>
        <{foreach item=event from=$block}>
        <tr class='<{cycle values="odd, even"}>'>
            <td class='center'><{$event.id}></td>
            <td class='center'><{$event.name}></td>
            <td class='center'><img class="img-responsive img-fluid" src="<{$wgevents_upload_eventlogos_url|default:false}><{$event.ev_submitter}>/<{$event.logo}>" alt="<{$event.name}>" ></td>
            <td class='center'><a href='events.php?op=show&amp;ev_id=<{$event.id}>' title='<{$smarty.const._MB_WGEVENTS_EVENT_GOTO}>'><{$smarty.const._MB_WGEVENTS_EVENT_GOTO}></a></td>
        </tr>
        <{/foreach}>
    </tbody>
    <{/if}>
    <tfoot><tr><td>&nbsp;</td></tr></tfoot>
</table>