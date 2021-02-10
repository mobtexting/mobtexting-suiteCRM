<form method="POST" action="index.php" enctype="multipart/form-data">

    <input type="hidden" name="module" value="MOBtexting" />
    <input type="hidden" name="action" value="index" />

    <span class="error">{$error.main}</span>

    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td>{$MOD.LBL_MOBTEXTING_SMS_USER}</td>
            <td>
                {if empty($config.mobtexting_user)}
                    {assign var='mobtexting_user' value=$mobtexting_config.mobtexting_user.default}
                {else}
                    {assign var='mobtexting_user' value=$config.mobtexting_user}
                {/if}
                <input
                    type="text"
                    name="mobtexting_user"
                    size="45"
                    value="{$mobtexting_user}"
                    placeholder="{$mobtexting_config.mobtexting_user.placeholder}" />
            </td>

            <td>{$MOD.LBL_MOBTEXTING_SMS_PASS}</td>
            <td>

                {if empty($config.mobtexting_password)}
                    {assign var='mobtexting_password' value=$mobtexting_config.mobtexting_password.default}
                {else}
                    {assign var='mobtexting_password' value=$config.mobtexting_password}
                {/if}
                <input
                    type="password"
                    name="mobtexting_password"
                    size="45"
                    value="{$mobtexting_password}"
                    placeholder="{$mobtexting_config.mobtexting_password.placeholder}" />

            </td>
        </tr>

        <tr>           

            <td>{$MOD.LBL_MOBTEXTING_ACCESS_TOKEN}</td>
            <td>

                {if empty($config.mobtexting_access_token)}
                    {assign var='mobtexting_access_token' value=$mobtexting_config.mobtexting_access_token.default}
                {else}
                    {assign var='mobtexting_access_token' value=$config.mobtexting_access_token}
                {/if}
                <input
                    type="text"
                    name="mobtexting_access_token"
                    size="45"
                    value="{$mobtexting_access_token}"
                    placeholder="{$mobtexting_config.mobtexting_access_token.placeholder}" />

            </td>
        </tr>

        <tr>
            <td>{$MOD.LBL_MOBTEXTING_SERVICE}</td>
            <td>
                {if empty($config.mobtexting_service)}
                    {assign var='mobtexting_service' value=$mobtexting_config.mobtexting_service.default}
                {else}
                    {assign var='mobtexting_service' value=$config.mobtexting_service}
                {/if}

                <select name="mobtexting_service">
                    <option value="T" {if $mobtexting_service =='T'}selected{/if}>T</option>
                    <option value="P" {if $mobtexting_service =='P'}selected{/if}>P</option>
                    <option value="S" {if $mobtexting_service =='S'}selected{/if}>S</option>
                    <option value="G" {if $mobtexting_service =='G'}selected{/if}>G</option>
                </select>
            </td>

            <td>{$MOD.LBL_MOBTEXTING_SENDER}</td>

            <td>
                {if empty($config.mobtexting_sender)}
                    {assign var='mobtexting_sender' value=$mobtexting_config.mobtexting_sender.default}
                {else}
                    {assign var='mobtexting_sender' value=$config.mobtexting_sender}
                {/if}
                <input
                    type="text"
                    name="mobtexting_sender"
                    size="45"
                    value="{$mobtexting_sender}"
                    placeholder="{$mobtexting_config.mobtexting_sender.placeholder}" />
            </td>

        </tr>
        <tr>
            <td>{$MOD.LBL_MOBTEXTING_ACTIVE}</td>

            <td>            
                {if empty($config.mobtexting_active)}
                    {assign var='mobtexting_active' value=$mobtexting_config.mobtexting_active.default}
                {else}
                    {assign var='mobtexting_active' value=$config.mobtexting_active}
                {/if}
                  <label>Yes</label><input type="radio" name="mobtexting_active" value="yes"{if $mobtexting_active =="yes"}checked{/if}>
                  

                  <label>No</label><input type="radio" name="mobtexting_active" value="no"{if $mobtexting_active =="no"}checked{/if}>
                  

            </td>

        </tr>

               
       
    </table>

    <br />

    <div>
        <input title="{$APP.LBL_SAVE_BUTTON_TITLE}" class="button"  type="submit" name="save" value="{$APP.LBL_SAVE_BUTTON_LABEL}" />
        <input title="{$MOD.LBL_CANCEL_BUTTON_TITLE}" onclick="document.location.href='index.php?module=Administration&action=index'" class="button" type="button" name="cancel" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" />
    </div>

</form>



