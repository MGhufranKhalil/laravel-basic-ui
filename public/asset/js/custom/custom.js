$(document).ready(function () {

    var css_link = $('<link rel="stylesheet" fetchpriority="high" as="style" href="https://salonistapp.com/asset/custom/style.css">');
    $('head').append(css_link);

    var customModal = $(`
    
        <modal-dialog id="PopupModal-03a2574f-46af-4d35-b456-a36865a0cc7e" class="product-popup-modal" open="">
        <div class="backdrops">
        <div role="dialog" aria-label="Pop-up link text" aria-modal="true" class="product-popup-modal__content" tabindex="-1">
        <button id="ModalClose-03a2574f-46af-4d35-b456-a36865a0cc7e" type="button" class="product-popup-modal__toggle custom-close-icon" aria-label="Close">
        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" class="icon icon-close" fill="none" viewBox="0 0 18 17">
        <path d="M.865 15.978a.5.5 0 00.707.707l7.433-7.431 7.579 7.282a.501.501 0 00.846-.37.5.5 0 00-.153-.351L9.712 8.546l7.417-7.416a.5.5 0 10-.707-.708L8.991 7.853 1.413.573a.5.5 0 10-.693.72l7.563 7.268-7.418 7.417z" fill="currentColor">
        </path></svg>
        </button>
        <div class="product-popup-modal__content-info">
            <h1 class="h2"></h1>
         <span id="branch_modal"></span>
         <span id="properties"></span>
        </div>
        
        <div class="blkshadow"><div class="loader" id="loader"></div></div>
        
        <button type="submit" class="button button button--secondary" id="save_booking" style="display:none">Save Booking</button>     
        </div>
        </div>
    </modal-dialog>
    `);

    $(`.quick-add__submit`).hide();


    let product_id = $(`input[name="product-id"]`).val();
    $.ajax({
        url: "https://salonistapp.com/get_product_detail",
        type: 'GET',
        data: {
            product_id
        },
        dataType: 'json',
        success: function (data) {
            if (data.product_type == 'services') {
                $('form').attr('disabled', true);
                $('button[name="add"]').hide();
                $('.shopify-payment-button__button').hide();
                $(`.product-form__quantity`).hide();
                var modal_button = '<button id="openCustomModal" class="button button--full-width button--secondary">Book Appointment</button>';
                $('.product-form').append(modal_button);
                $('body').append(customModal);

                var closeModalBtn = $("#ModalClose-03a2574f-46af-4d35-b456-a36865a0cc7e");

                customModal.css("display", "none");

                $('#openCustomModal').click(function () {
                    customModal.css('display', 'block');
                    customModal.css('opacity', '1');
                    customModal.css('visibility', 'visible');
                    customModal.css('z-index', '101');
                    // $('#save_booking').css('display', 'block');
                    $(`#branch_modal`).empty();
                    $(`#branch_modal`).removeClass('calender_view hasDatepicker');
                    get_branch(data.domainId);
                });

                closeModalBtn.click(function () {
                    customModal.css("display", "none");
                    customModal.css('opacity', '0');
                    customModal.css('visibility', 'hidden');
                    customModal.css('z-index', '-1');
                    $('#save_booking').css('display', 'none');
                    $(`#branch_modal`).empty();
                    $(`#branch_modal`).removeClass('calender_view hasDatepicker');
                });

                $(window).click(function (event) {
                    if (event.target == customModal[0]) {
                        customModal.css("display", "none");
                        $(`#branch_modal`).empty();
                    }
                });
            }
        }
    });




    if (window.location.pathname.indexOf("/cart") !== -1) {
        // Create a keypress event for Ctrl + Shift + R
        var hardRefreshEvent = $.Event("keypress");
        hardRefreshEvent.keyCode = 82; // Key code for "R"
        hardRefreshEvent.ctrlKey = true; // Ctrl key pressed
        hardRefreshEvent.shiftKey = true; // Shift key pressed

        // Trigger the keypress event
        $(document).trigger(hardRefreshEvent);
    }
});

function get_branch(domain_id = null ,branch_id = null) {
    $.ajax({
        url: "https://salonistapp.com/get_branch",
        type: 'GET',
        data:{
            domainId:domain_id
        },
        dataType: 'json',
        success: function (data) {
            let hit_function = false;
            var branches = '';
            $(`.product-popup-modal__content-info`).find('.h2').text('Branches')
            $(`#branch_modal`).empty();
            $(`#branch_modal`).removeClass('calender_view hasDatepicker');
            if (Array.isArray(data) && data.length === 1) {
                hit_function = true;
                let branch_data = data[0];
                branches = `<input type="hidden" name="branch_id" value="${branch_data.location_id} />"`;
                if (hit_function == true) {
                    return get_staff($(`input[name="branch_id"]`), branch_data.domainId, branch_data.location_id);
                }
            }
            let selected = '';
            $(data).each(function (k, v) {
                if (branch_id == v.location_id) {
                    selected = 'selected-staff';
                }
                else {
                    selected = '';
                }
                branches += `<button type="button" class="button brands-card button button--secondary ${selected}" onclick="get_staff(this,${v.domainId},${v.location_id}" name="branch_id" value="${v.location_id}">
                    <div class="service_info">
                    <svg width="18" height="16" viewBox="0 0 18 16" fill="none">
                        <path d="M1.5 5H16.5C16.75 5 17 4.78125 17 4.5V3.375C17 3.15625 16.8438 2.96875 16.6562 2.90625L9.34375 0.09375C9.21875 0.03125 9.09375 0 9 0C8.875 0 8.75 0.03125 8.625 0.09375L1.3125 2.90625C1.125 2.96875 1 3.15625 1 3.375V4.5C1 4.78125 1.21875 5 1.5 5ZM9 1.5625L14.0938 3.5H3.875L9 1.5625ZM17.5 14.5H17V12.5C17 11.9688 16.4688 11.5 15.8438 11.5H15V6H13.5V11.5H11.5V6H10V11.5H8V6H6.5V11.5H4.5V6H3V11.5H2.125C1.5 11.5 1 11.9688 1 12.5V14.5H0.5C0.21875 14.5 0 14.75 0 15V15.5C0 15.7812 0.21875 16 0.5 16H17.5C17.75 16 18 15.7812 18 15.5V15C18 14.75 17.75 14.5 17.5 14.5ZM15.5 14.5H2.5V13H15.5V14.5Z" fill="#159957"></path>
                    </svg>
                </div>
                ${v.name}
                <div class="card-icon">&nbsp;</div>
            </button>
            <input type="hidden" class="domainId" name="domainId" value="${v.domainId}" />
            `;
            });
            $(`#branch_modal`).append(branches);
        },
        error: function (xhr, status, error) {
            if (xhr.status === 500) {
                get_branch();
            }
        }
    });
}

function get_staff(e, domainId, branchId = null, staffId = null) {
    $(e).addClass(`selected-staff`);
    showLoader();
    setTimeout("60000");

    let branch_id = $(e).val() ?? branchId;

    let product_id = $(`input[name="product-id"]`).val();
    $.ajax({
        url: "https://salonistapp.com/get_staff?product_id=" + product_id,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            hideLoader();
            $(`#branch_modal`).removeClass('calender_view hasDatepicker');
            $(`#branch_modal`).empty();
            $(`.product-popup-modal__content-info`).find('.h2').text('Staff')
            if (data.status == 'success') {
                let hit_function = false;
                let selected = '';
                let no_preference_selected = '';
                if (data.select_staff == 'None') {
                    let no_preference = `
                    <button id="back_button" style="display:block" onclick="get_branch(${branch_id})" value="${branch_id}">
                        <svg width="14" height="14" x="0" y="0" viewBox="0 0 486.65 486.65" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g xmlns="http://www.w3.org/2000/svg"><g id="arrow-1-w_1_"><path d="m202.114 444.648c-8.01-.114-15.65-3.388-21.257-9.11l-171.875-171.572c-11.907-11.81-11.986-31.037-.176-42.945.058-.059.117-.118.176-.176l171.876-171.571c12.738-10.909 31.908-9.426 42.817 3.313 9.736 11.369 9.736 28.136 0 39.504l-150.315 150.315 151.833 150.315c11.774 11.844 11.774 30.973 0 42.817-6.045 6.184-14.439 9.498-23.079 9.11z" fill="#5d5d5d" data-original="#000000" class=""></path><path d="m456.283 272.773h-425.133c-16.771 0-30.367-13.596-30.367-30.367s13.596-30.367 30.367-30.367h425.133c16.771 0 30.367 13.596 30.367 30.367s-13.596 30.367-30.367 30.367z" fill="#5d5d5d" data-original="#000000" class=""></path></g></g></g></svg>
                    </button>
                    
                    <input type="hidden" name="staff_id" value="any"/>
                    <input type="hidden" class="branch_id" name="branch_id" value="${branch_id}"/>
                    `;
                    hit_function = true;
                    $(`#branch_modal`).append(no_preference);
                    if (hit_function == true) {
                        return get_date($(`input[name="staff_id"]`), domainId, branch_id);
                    }
                }
                if (data.select_staff == 'Staff') {
                    var staff = '';
                    $(data.staff).each(function (k, v) {
                        selected = '';
                        if (staffId == v.user_id) {
                            selected = 'selected-staff';
                        }
                        else if (staffId == 'Any') {
                            no_preference_selected = 'selected-staff';
                        }
                      
                        staff += `<button type="button" class="staff-card button button button--secondary ${selected}" onclick="get_date(this,${domainId}, ${branch_id})" name="staff_id" value="${v.user_id}">
                        <div class="staff-pic">						
                            <img src="https://CasaSpa.salonist.io/img/user/2022-10-01_231413_12.png" alt="staff">
                        </div>
                    ${v.name}
                    <div class="card-icon">&nbsp;</div>
                    </button>
                    <input type="hidden" class="branch_id" name="branch_id" value="${branch_id}"/>`;
                    });
                    let no_preference = `
                      <button id="back_button" style="display:block" onclick="get_branch(${branch_id})" value="${branch_id}">
                        <svg width="14" height="14" x="0" y="0" viewBox="0 0 486.65 486.65" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g xmlns="http://www.w3.org/2000/svg"><g id="arrow-1-w_1_"><path d="m202.114 444.648c-8.01-.114-15.65-3.388-21.257-9.11l-171.875-171.572c-11.907-11.81-11.986-31.037-.176-42.945.058-.059.117-.118.176-.176l171.876-171.571c12.738-10.909 31.908-9.426 42.817 3.313 9.736 11.369 9.736 28.136 0 39.504l-150.315 150.315 151.833 150.315c11.774 11.844 11.774 30.973 0 42.817-6.045 6.184-14.439 9.498-23.079 9.11z" fill="#5d5d5d" data-original="#000000" class=""></path><path d="m456.283 272.773h-425.133c-16.771 0-30.367-13.596-30.367-30.367s13.596-30.367 30.367-30.367h425.133c16.771 0 30.367 13.596 30.367 30.367s-13.596 30.367-30.367 30.367z" fill="#5d5d5d" data-original="#000000" class=""></path></g></g></g></svg>
                    </button>
                    <button type="button" class="staff-card button button button--secondary ${no_preference_selected}" onclick="get_date(this,${domainId},${branch_id})" name="staff_id" value="Any">
                        <div class="staff-pic">		
                        <img src="https://CasaSpa.salonist.io/img/user/2022-10-01_231413_12.png" alt="staff">				
                        </div>
                    No preference
                    <div class="card-icon">&nbsp;</div>
                    </button>
                    <input type="hidden" class="branch_id" name="branch_id" value="${branch_id}"/>
                    `;
                    $(`#branch_modal`).append(no_preference, staff);
                }
                if (data.select_staff == 'Preference') {
                    var staff = '';
                    $(data.staff).each(function (k, v) {
                        if (staffId == v.user_id) {
                            selected = 'selected-staff';
                        } else {
                            selected = '';
                        }
                        staff += `<button type="button" class="staff-card button button button--secondary ${selected}" onclick="get_date(this,${domainId}, ${branch_id})" name="staff_id" value="${v.user_id}">
                        <div class="staff-pic">						
                            <img src="https://CasaSpa.salonist.io/img/user/2022-10-01_231413_12.png" alt="staff">
                        </div>
                    ${v.name}
                    <div class="card-icon">&nbsp;</div>
                    </button>
                    <input type="hidden" class="branch_id" name="branch_id" value="${branch_id}"/>`;
                    });
                    let back_button = `<button id="back_button" style="display:block" onclick="get_branch(${branch_id})" value="${branch_id}">
                        <svg width="14" height="14" x="0" y="0" viewBox="0 0 486.65 486.65" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g xmlns="http://www.w3.org/2000/svg"><g id="arrow-1-w_1_"><path d="m202.114 444.648c-8.01-.114-15.65-3.388-21.257-9.11l-171.875-171.572c-11.907-11.81-11.986-31.037-.176-42.945.058-.059.117-.118.176-.176l171.876-171.571c12.738-10.909 31.908-9.426 42.817 3.313 9.736 11.369 9.736 28.136 0 39.504l-150.315 150.315 151.833 150.315c11.774 11.844 11.774 30.973 0 42.817-6.045 6.184-14.439 9.498-23.079 9.11z" fill="#5d5d5d" data-original="#000000" class=""></path><path d="m456.283 272.773h-425.133c-16.771 0-30.367-13.596-30.367-30.367s13.596-30.367 30.367-30.367h425.133c16.771 0 30.367 13.596 30.367 30.367s-13.596 30.367-30.367 30.367z" fill="#5d5d5d" data-original="#000000" class=""></path></g></g></g></svg>
                    </button>`;
                    $(`#branch_modal`).append(back_button, staff);
                }
            }
        }
        ,
        error: function (xhr, status, error) {
            if (xhr.status === 500) {
                $(`#branch_modal`).empty();
                let error_response = `<button type="button" class="staff-card button button button--secondary">
                    <div class="staff-pic">						
                        
                    </div>
                Please Check Your Internet Conectivity Or Contact Admin
                </button>`;
                $(`#branch_modal`).append(error_response);
            }
        }
    });
}

function get_date(e, domainId, branchId = null, predate = null) {
    showLoader();
    let card_icon = $(e).find('.card-icon');
    card_icon.addClass('staff-selected');

    $('#save_booking').css("display", "none");

    $(`#branch_modal`).removeClass('calender_view hasDatepicker');
    let staff_id = $(e).val();
    let branch_id = $(e).next('.branch_id').val() ?? branchId;
    let product_id = $(`input[name="product-id"]`).val();
    let id = $(`input[name="id"]`).val();
    let date = '';
    var dateToday = new Date();
    let previous_date = '';
    hideLoader();
    if (predate) {
        previous_date = predate;
    } else {
        previous_date = new Date();
    }

    $(`#branch_modal`).empty();
    $(`.product-popup-modal__content-info`).find('.h2').text('Select Date');
    let back_button = `<button id="back_button" style="display:block" onclick="get_staff(this,${domainId},${branch_id},'${staff_id}')" value="${branch_id}">
       <svg width="14" height="14" x="0" y="0" viewBox="0 0 486.65 486.65" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g xmlns="http://www.w3.org/2000/svg"><g id="arrow-1-w_1_"><path d="m202.114 444.648c-8.01-.114-15.65-3.388-21.257-9.11l-171.875-171.572c-11.907-11.81-11.986-31.037-.176-42.945.058-.059.117-.118.176-.176l171.876-171.571c12.738-10.909 31.908-9.426 42.817 3.313 9.736 11.369 9.736 28.136 0 39.504l-150.315 150.315 151.833 150.315c11.774 11.844 11.774 30.973 0 42.817-6.045 6.184-14.439 9.498-23.079 9.11z" fill="#5d5d5d" data-original="#000000" class=""></path><path d="m456.283 272.773h-425.133c-16.771 0-30.367-13.596-30.367-30.367s13.596-30.367 30.367-30.367h425.133c16.771 0 30.367 13.596 30.367 30.367s-13.596 30.367-30.367 30.367z" fill="#5d5d5d" data-original="#000000" class=""></path></g></g></g></svg>
     </button>`;

    $(`#branch_modal`).append(back_button);
    $(`#branch_modal`).addClass('calender_view');

    $(`#branch_modal`).datepicker({
        defaultDate: previous_date,
        minDate: dateToday,
        showButtonPanel: true,
        dateFormat: 'dd-mm-yy',
        onSelect: function (dateText, inst) {
            showLoader();
            date = dateText;

            $.ajax({
                type: 'GET',
                url: "https://salonistapp.com/getBusinessTime",
                data: {
                    domainId,
                    date
                },
                dataType: 'json',
                success: function (data) {
                    hideLoader();
                    $('#branch_modal').empty();
                    $(`#branch_modal`).removeClass('calender_view hasDatepicker');
                    $(`#branch_modal`).addClass(`time-picker-custom`);
                    $('.product-popup-modal__content-info').find('.h2').text('Staff Time ')
                    var single_staff = data;

                    let back_button = `<button id="back_button" style="display:block" onclick="get_date(this, ${domainId},${branch_id},'${dateText}')" value="${staff_id}">
                        <svg width="14" height="14" x="0" y="0" viewBox="0 0 486.65 486.65" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g xmlns="http://www.w3.org/2000/svg"><g id="arrow-1-w_1_"><path d="m202.114 444.648c-8.01-.114-15.65-3.388-21.257-9.11l-171.875-171.572c-11.907-11.81-11.986-31.037-.176-42.945.058-.059.117-.118.176-.176l171.876-171.571c12.738-10.909 31.908-9.426 42.817 3.313 9.736 11.369 9.736 28.136 0 39.504l-150.315 150.315 151.833 150.315c11.774 11.844 11.774 30.973 0 42.817-6.045 6.184-14.439 9.498-23.079 9.11z" fill="#5d5d5d" data-original="#000000" class=""></path><path d="m456.283 272.773h-425.133c-16.771 0-30.367-13.596-30.367-30.367s13.596-30.367 30.367-30.367h425.133c16.771 0 30.367 13.596 30.367 30.367s-13.596 30.367-30.367 30.367z" fill="#5d5d5d" data-original="#000000" class=""></path></g></g></g></svg>
                    </button>`;

                    $('#branch_modal').append(back_button, single_staff);
                    var time = '';

                    $('input[name="time"]').on("click", function () {
                        time = $(this).val();
                        $('#save_booking').css("display", "block");
                    });

                    $('#save_booking').click(function () {
                        jQuery.post('/cart/add.js', {
                            quantity: 1,
                            id: id,
                            product_id: product_id,
                            properties: {
                                'Staff ID': staff_id,
                                'Branch ID': branch_id,
                                'Date': date,
                                'Time': time,
                            }
                        }).done(function () {
                            window.location.href = '/cart';
                        });
                    });
                }
            });
        }
    });
}

function showLoader() {
    $('#loader').show();
    $('.blkshadow').show();
}

function hideLoader() {
    $('#loader').hide();
    $('.blkshadow').hide();
}