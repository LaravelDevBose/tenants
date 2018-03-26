$.ajaxSetup({
    headers:{
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
});

// payment information set up

$('.payment').on('click', function(e){
    var this_id  = $(this);
    var payment_id = $(this).parents('ul').attr('id');
    var tenant_name = $(this).parents('tr').children('td:nth-child(1)').find('.name').text();
    var tenant_id = $(this).parents('tr').children('td:nth-child(1)').attr('id');
    var paid_amount = $(this).parents('tr').children('td:nth-child(9)').text();
    var paid_amount_row = $(this).parents('tr').children('td:nth-child(9)').attr('id');
    var payable_amount = $(this).parents('tr').children('td:nth-child(10)').text();
    var payable_amount_row = $(this).parents('tr').children('td:nth-child(10)').attr('id');
    $('#modal_payment').find('.tenant_name').text(tenant_name);
    $('#modal_payment').find('.payable_amount').text(payable_amount);

    // alert(tenant_id);
    $('.paid').on('click', function() {
        var amount= $('#modal_payment').find('input[name="amount"]').val();
        var payment_type= $('#modal_payment').find('select[name="payment_type"]').val();
        var payment_date= $('#modal_payment').find('input[name="payment_date"]').val();
        $.ajax({
            type:'GET',
            url:'payments/store',
            dataType:'json',
            data:'payment_id='+payment_id+'&tenant_id='+tenant_id+'&amount='+amount+'&payment_type='+payment_type+'&payment_date='+payment_date,
            success:function(data){
                this_id.parents('tr').children('td:nth-child(9)').text('$'+(parseInt(paid_amount_row) + parseInt(amount)));
                this_id.parents('tr').children('td:nth-child(9)').attr('id',(parseInt(paid_amount_row) + parseInt(amount)));
                this_id.parents('tr').children('td:nth-child(10)').text('$'+(parseInt(payable_amount_row) - parseInt(amount)));
                this_id.parents('tr').children('td:nth-child(10)').attr('id',(parseInt(payable_amount_row) - parseInt(amount)));
                swal({
                    title: "Deleted!",
                    text: "Tenant Information has been deleted.",
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                },function(isComfirm){
                    if(isComfirm){
                        location.reload(true);
                    }
                });

                $( "#modal_payment" ).dismiss();
            },
            error:function(){
                $( "#modal_payment" ).toggle(400);
                swal({
                    title: "Cancelled",
                    text: "Payment Not Completed. Try Again! :( ",
                    confirmButtonColor: "#2196F3",
                    type: "error"

                },function(isComfirm){
                    if(isComfirm){
                        location.reload(true);
                    }
                });
            }
        });
    });

});

