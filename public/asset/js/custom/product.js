$(document).ready(function(){
    if(action == 'edit')
    {
        setEditValues();
    }

});
function setEditValues()
{
    let category_id = $(`select[name="category_id"]`);
    let title = $(`input[name="title"]`);
    let description = $(`textarea[name="description"]`);
    let price = $(`input[name="price"]`);



    category_id.val(Product)
    title.val(Product.title);
    description.val(Product.body_html);
    price.val(variation.price);

}
$(`#form_validate`).on("submit",function(e){
    validate_data(e,'input','title','error','Title Required');
    validate_data(e,'input','price','error','Price Required');
    validate_data(e,'textarea','description','error','Please Insert Description');
    validate_data(e,'input','file','error','Please Insert Image');
    validate_data(e,'select','branch_id','error','Please Select Branch');
    validate_data(e,'input','check_out','error','Please Insert Check Out');

    if($(`input[name="check_in"]`).val() < $(`input[name="check_out"]`).val())
    {
        toastr['error','Check In Time must be greater than Checkout Time'];
        e.preventDefault();
    }
});