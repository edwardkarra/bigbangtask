{** Company files section **}

{** adding Files tab content in vendor details page **}
<div id="content_files" class="hidden" > {** content description **}
    <fieldset>
        <div class="control-group ">
            <label class="control-label" for="elm_company_description">{__("files")}:</label>
        </div>
        <div class="control-group">
            <div class="controls">
                <h4>Company Agreement: </h4>
                <form id="myF" method="post" action="">
                    <input type="hidden" name="agreement_call" id="agreement_call">
                    <a>{btn type="list" text=__("download agreement") class="cm-update-company" dispatch="dispatch[companies.update]" form="myF" method="POST"}</a>

                </form>
            </div>
        </div>
    </fieldset>
</div>
{** /Company files section **}