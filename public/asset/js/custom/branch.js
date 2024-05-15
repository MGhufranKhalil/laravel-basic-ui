$(document).ready(function(){
    if(action == "edit")
    {
        setEditValues();
    }
    
});
function setEditValues()
{
    let name = $(`input[name="name"]`);
    let contact = $(`input[name="contact_no"]`);
    let address = $(`input[name="address"]`);
    
    name.val(Branch.name);
    contact.val(Branch.contact_no);
    address.val(Branch.address);
    
}
$(`#form_validate`).on("submit",function(e){
    
    validate_data(e,'input','name','error','Name is Required');
    validate_data(e,'input','contact_no','error','Contact Number is Required');
});

