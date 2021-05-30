<div>
    {**check if user is adding vendor to show upload field**}
    {if $is_add}
    <div class="pdf-uploader" >
        <label>
            agreement :
            <input required="required" type="file" form="company_update_form" name="agreement">
        </label>
    </div>
    {/if}

</div>

