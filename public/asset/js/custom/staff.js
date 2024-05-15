$(document).ready(function(){
    if(action == "edit")
    {
        setEditValues();
    }

});
function setEditValues()
{
    let name = $(`input[name="name"]`);
    let gender = $(`select[name="gender"]`);
    let contact = $(`input[name="contact_no"]`);
    let address = $(`input[name="address"]`);
    let branch_id = $(`select[name="branch_id"]`);
    let check_in = $(`input[name="check_in"]`);
    let check_out = $(`input[name="check_out"]`);

    name.val(Staff.name);
    gender.val(Staff.gender);
    contact.val(Staff.contact_no);
    address.val(Staff.address);
    branch_id.val(Staff.branch_id);
    check_in.val(Staff.check_in);
    check_out.val(Staff.check_out);
}
$(`#form_validate`).on("submit",function(e){
    
    validate_data(e,'input','name','error','Name Required');
    validate_data(e,'select','gender','error','Please Select Gender');
    validate_data(e,'input','contact','error','Contact Required');
    validate_data(e,'select','branch_id','error','Please Select Branch');
    validate_data(e,'input','check_in','error','Please Insert Check In');
    validate_data(e,'input','check_out','error','Please Insert Check Out');

    if($(`input[name="check_in"]`).val() < $(`input[name="check_out"]`).val())
    {
        toastr['error','Check In Time must be greater than Checkout Time'];
        e.preventDefault();
    }
});