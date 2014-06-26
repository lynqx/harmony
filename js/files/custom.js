$(function () {
    $(document).ajaxStart(function () {
        $("#loading").show();
    }).ajaxStop(function () {
            $("#loading").hide();
        });
    $("#loanZard").formwizard({
        formPluginEnabled: false,
        validationEnabled: false,
        focusFirstInput: false,
        disableUIStyles: false

    });
    /**
     * The following code handles client side display User experience
     */
    //TODO: LOANS Tested Ok!
    var guarantors = [];
    $.ajax({
        url: base_url + 'loans/getGuarantors',
        dataType: 'json',
        success: function (data) {
            // console.log('here again');
            guarantors = data;
            //console.log(data);
        }
    });


    $("a.loan-pdf-report-modal").click(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'report/loan',
            success: function (data) {
                bootbox.modal(data, 'Loan Reports');
                $('#selectLoanWizard').formwizard({
                    formPluginEnabled: true,
                    validationEnabled: true,
                    focusFirstInput: false,
                    disableUIStyles: false});
            }
        });
    });

    $("a.loan-view-report-modal").click(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'reportview/select_loan',
            success: function (data) {
                bootbox.modal(data, 'Loan View Reports');
            }
        })
    });


    //TODO: CONTRIBUTIONS
    $("a.view-contributions-modal").click(function (e) {
        e.preventDefault();
        //bootbox.modal('<img src="http://dummyimage.com/600x400/000/fff" alt=""/>', 'Loan Applications');
        bootbox.alert('Contributions view');
    });

    //TODO: SITE MANAGEMENT
    $("a.view-pages-modal").click(function (e) {
        e.preventDefault();
        //bootbox.modal('<img src="http://dummyimage.com/600x400/000/fff" alt=""/>', 'Loan Applications');
        bootbox.alert('View pages!');
    });
    //TODO: MEMBERS MANAGEMENT
    $("a.view-members-modal").click(function (e) {
        e.preventDefault();
        //bootbox.modal('<img src="http://dummyimage.com/600x400/000/fff" alt=""/>', 'Loan Applications');
        bootbox.alert('View members!');
    });
    //TODO: SETTINGS MANAGEMENT
    $("a.view-settings-modal").click(function (e) {
        e.preventDefault();
        //bootbox.modal('<img src="http://dummyimage.com/600x400/000/fff" alt=""/>', 'Loan Applications');
        bootbox.alert('View Settings!');
    });
    $("a.click_apply_for_loan").click(function (e) {
        e.preventDefault();

        $.ajax({
            url: base_url + 'selfservice/applyloan', //Get the loans view from selfservice
            success: function (data) {
                bootbox.modal(data, 'New Loan Application');
                $("#apply_for_loan").formwizard({
                    formPluginEnabled: true,
                    validationEnabled: false,
                    focusFirstInput: false,
                    disableUIStyles: true,

                    formOptions: {
                        success: function (data) {
                            console.log(data);
                            $("#status1").fadeTo(500, 1, function () {
                                $(this).html("<span>Form was submitted!</span>").fadeTo(5000, 0);
                            })
                        },
                        beforeSubmit: function (data) {

                            //$("#data1").html("<span>Form was submitted with ajax. Data sent to the server: " + $.param(data) + "</span>");
                            //data[7].value=$("#guarantor").select2('val');
                            //console.log(data);
                        },
                        resetForm: true
                    }
                });
                $("#guarantor_list").select2({
                    minimumInputLength: 3
                });
                $("#guarantor_list").bind("change", function (e) {
                    console.log($("#guarantor_list").select2("val"));
                    guarantors.push($("#guarantor_list").select2("val"));
                });
            }
        });
    });
    $("a.click_apply_for_asset_loan").click(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'loans/assetLoanApplicationView',
            success: function (data) {
                bootbox.modal(data, 'Apply for an Asset Loan');
                $('#applyforAssetLoans').formwizard({
                    formPluginEnabled: true,
                    validationEnabled: false,
                    focusFirstInput: false,
                    disableUIStyles: true,

                    formOptions: {
                        success: function (data) {
                            console.log(data);
                            $("#status1").fadeTo(500, 1, function () {
                                $(this).html("<span>Form was submitted!</span>").fadeTo(5000, 0);
                            })
                        },
                        beforeSubmit: function (data) {

                            //$("#data1").html("<span>Form was submitted with ajax. Data sent to the server: " + $.param(data) + "</span>");
                            //data[7].value=$("#guarantor").select2('val');
                            //console.log(data);
                        },
                        resetForm: true
                    }
                });
                $('#asset').select2({
                    minimumInputLength: 3
                });
            }
        })
    });
    //TODO: ASSETS MANAGEMENT
    $('a.viewAssets').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'loans/loadAssetLoanApplicationView',
            success: function (data) {
                bootbox.modal(data, 'View Assets');
                //$('applyforAssetLoans').formwizard();
            }
        })
    });

});
function viewLoan(button) {
    console.log($(button).data('id'));
    //TODO: Load this view using Ajax and supplying the loan id
    //getLoanApplication
    var id = $(button).data('id');
    $.ajax({
        url: base_url + 'loans/getLoanApplication/' + id,
        success: function (data) {
            //alert('Loan Cancelled!');
            // window.location.reload();
            bootbox.modal(data, 'Loan application Details');
            //console.log(data);
        }
    });
}
function cancelLoan(button) {
    var result = confirm('Do you want to cancel this loan application?');
    var id = $(button).data('id');
    if (result == true) {
        //TODO: Ajax call
        $.ajax({
            url: base_url + 'loans/cancelLoan/' + id,
            success: function (data) {
                alert('Loan Cancelled!');
                window.location.reload();
                console.log(data);
            }
        });
        console.log(result);
    }
}
function approveLoan(button) {
    var result = confirm('Do you want to approve this loan application?');
    var id = $(button).data('id');
    if (result == true) {
        //TODO: Ajax call
        $.ajax({
            url: base_url + 'loans/approveLoan/' + id,
            success: function (data) {
                alert('Loan approved!');
                console.log(data);
                //TODO: empty the table and reload the data
                window.location.reload();
            }
        });
    }
    else {

    }
    console.log(result);
}
