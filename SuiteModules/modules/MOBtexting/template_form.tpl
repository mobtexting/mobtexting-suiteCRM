<form method="POST" action="index.php" enctype="multipart/form-data">

    <input type="hidden" name="module" value="MOBtexting" />
    <input type="hidden" name="action" value="template" />

    <span class="error">{$error.main}</span>

    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        
        
        <tr>
            <td>{$MOD.LBL_MOBTEXTING_ACTIVE}</td>

            <td>            
                {if empty($config.mobtexting_template_active)}
                    {assign var='mobtexting_template_active' value=$mobtexting_config.mobtexting_template_active.default}
                {else}
                    {assign var='mobtexting_template_active' value=$config.mobtexting_template_active}
                {/if}

                  <label>Yes</label><input type="radio" name="mobtexting_template_active" value="yes"{if $mobtexting_template_active =="yes"}checked{/if}>
                  

                  <label>No</label><input type="radio" name="mobtexting_template_active" value="no"{if $mobtexting_template_active =="no"}checked{/if}>
                  

            </td>
        </tr>
        
        <tr>

            <td>{$MOD.LBL_MOBTEXTING_TEMPLATE_BODY}</td>
            <td>
                {if empty($config.mobtexting_template_body)}
                    {assign var='mobtexting_template_body' value=$mobtexting_config.mobtexting_template_body.default}
                {else}
                    {assign var='mobtexting_template_body' value=$config.mobtexting_template_body}
                {/if}

               <textarea name='mobtexting_template_body' tabindex='0' cols="80" rows="10" style="height: 1.6.em; overflow-y:auto; font-family:sans-serif,monospace; font-size:inherit;" id="description">{$mobtexting_template_body}</textarea>

            </td>

        </tr>

       
    </table>

    <br />
<span class="text-danger">Note :</span> This auto template SMS will send message when you create new "Contacts" . If you don't want then "deactive" this setting.
 <br />
<span class="text-danger">Syntax Replaces:</span> {$syntax}
<br /> 
<br /> 
    <div>
        <input title="{$APP.LBL_SAVE_BUTTON_TITLE}" class="button"  type="submit" name="save" value="{$APP.LBL_SAVE_BUTTON_LABEL}" />
        <input title="{$MOD.LBL_CANCEL_BUTTON_TITLE}" onclick="document.location.href='index.php?module=Administration&action=index'" class="button" type="button" name="cancel" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" />
    </div>

</form>



