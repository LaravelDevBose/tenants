$.ajaxSetup({
    headers:{
        'X-CSRF-Token': $('input[name="_token"]').val()
    }
});


$(function(){

    $('#insert').on('click', function(e){
        console.log(e);
        var title = $('#expense_type_insert').find('input[name="title"]').val();

        $.ajax({
            url:'type/store',
            type:'GET',
            dataType:'json',
            data:'title='+title,
            success:function(data){
                console.log(data);
                $('#expense_type_insert').find('input[name="title"]').val(' ');

                $('#type_view').empty();
                $('select[name="expenses_type"]').empty();

                var i = 0;
                $.each(data, function(key, value) {
                    if(i == 0){
                        $('#expenses_type').append('<option value=" ">Select Second Category</option><option value="'+ key +'">'+ value +'</option>');
                        var view = '<td class="text-center"> <ul id="'+key+'" class="icons-list"> <li class="text-primary-600"><a href="#" class="edit" data-toggle="modal" data-target="#modal_type"><i class="icon-pencil7"></i></a></li> <li class="text-danger-600"><a href="#" class="delete_type"><i class="icon-trash"></i></a></li> </ul> </td>'
                        $('#type_view').append('<tr><td>'+ i++ +'</td><td>'+value+'</td>'+view+'</tr>');
                    }else{
                        $('#expenses_type').append('<option value="'+ key +'">'+ value +'</option>');
                        var view = '<td class="text-center"> <ul id="'+key+'" class="icons-list"> <li class="text-primary-600"><a href="#" class="edit" data-toggle="modal" data-target="#modal_type"><i class="icon-pencil7"></i></a></li> <li class="text-danger-600"><a href="#" class="delete_type"><i class="icon-trash"></i></a></li> </ul> </td>'
                        $('#type_view').append('<tr><td>'+ i++ +'</td><td>'+value+'</td>'+view+'</tr>');
                    }
                });
                swal({
                    title: "Stored!",
                    text: "Expenses Type Information has been Stored.",
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                });

            },
            error:function(){
                swal({
                    title: "Error",
                    text: "Expenses Type Information Not Stored :)",
                    confirmButtonColor: "#2196F3",
                    type: "error"
                });
            }
        });

    });

    $('#insert').on('click', function(e){
        console.log(e);
        var title = $('#expense_type_insert').find('input[name="title"]').val();

        $.ajax({
            url:'/tenants/expenses/type/store',
            type:'GET',
            dataType:'json',
            data:'title='+title,
            success:function(data){
                console.log(data);
                $('#expense_type_insert').find('input[name="title"]').val(' ');

                $('#type_view').empty();
                $('select[name="expenses_type"]').empty();

                var i = 0;
                $.each(data, function(key, value) {
                    if(i == 0){
                        $('#expenses_type').append('<option value=" ">Select Second Category</option><option value="'+ key +'">'+ value +'</option>');
                        var view = '<td class="text-center"> <ul id="'+key+'" class="icons-list"> <li class="text-primary-600"><a href="#" class="edit" data-toggle="modal" data-target="#modal_type"><i class="icon-pencil7"></i></a></li> <li class="text-danger-600"><a href="#" class="delete_type"><i class="icon-trash"></i></a></li> </ul> </td>'
                        $('#type_view').append('<tr><td>'+ i++ +'</td><td>'+value+'</td>'+view+'</tr>');
                    }else{
                        $('#expenses_type').append('<option value="'+ key +'">'+ value +'</option>');
                        var view = '<td class="text-center"> <ul id="'+key+'" class="icons-list"> <li class="text-primary-600"><a href="#" class="edit" data-toggle="modal" data-target="#modal_type"><i class="icon-pencil7"></i></a></li> <li class="text-danger-600"><a href="#" class="delete_type"><i class="icon-trash"></i></a></li> </ul> </td>'
                        $('#type_view').append('<tr><td>'+ i++ +'</td><td>'+value+'</td>'+view+'</tr>');
                    }
                });
                swal({
                    title: "Stored!",
                    text: "Expenses Type Information has been Stored.",
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                });

            },
            error:function(){
                swal({
                    title: "Error",
                    text: "Expenses Type Information Not Stored :)",
                    confirmButtonColor: "#2196F3",
                    type: "error"
                });
            }
        });

    });

    $('.edit').on('click', function(e) {
        var id = $(this).parents('ul').attr('id');
        var title = $(this).parents('tr').children('td:nth-child(2)').text();
        $('#modal_type').find('input[name="title"]').val(title);

        $('#update').on('click', function(e){
            console.log(e);
            var newtitle = $('#modal_type').find('input[name="title"]').val();
            $.ajax({
                url:'/tenants/expenses/type/update/'+id,
                type:'GET',
                dataType:'json',
                data:'title='+newtitle,
                success:function(data){
                    console.log(data);
                    $('#modal_type').hide();
                    $('#modal_type').find('input[name="title"]').val(' ');

                    $('#type_view').empty();
                    $('select[name="expenses_type"]').empty();

                    var i = 0;
                    $.each(data, function(key, value) {
                        if(i == 0){
                            $('#expenses_type').append('<option value=" ">Select Expenses Type </option><option value="'+ key +'">'+ value +'</option>');
                            var view = '<td class="text-center"> <ul id="'+key+'" class="icons-list"> <li class="text-primary-600"><a href="#" class="edit" data-toggle="modal" data-target="#modal_type"><i class="icon-pencil7"></i></a></li> <li class="text-danger-600"><a href="#" class="delete_type"><i class="icon-trash"></i></a></li> </ul> </td>'
                            $('#type_view').append('<tr><td>'+ i++ +'</td><td>'+value+'</td>'+view+'</tr>');
                        }else{
                            $('#expenses_type').append('<option value="'+ key +'">'+ value +'</option>');
                            var view = '<td class="text-center"> <ul id="'+key+'" class="icons-list"> <li class="text-primary-600"><a href="#" class="edit" data-toggle="modal" data-target="#modal_type"><i class="icon-pencil7"></i></a></li> <li class="text-danger-600"><a href="#" class="delete_type"><i class="icon-trash"></i></a></li> </ul> </td>'
                            $('#type_view').append('<tr><td>'+ i++ +'</td><td>'+value+'</td>'+view+'</tr>');
                        }
                    });

                    swal({
                        title: "Stored!",
                        text: "Expenses Type Information has been Updated.",
                        confirmButtonColor: "#66BB6A",
                        type: "success"
                    });

                },
                error:function(){
                    swal({
                        title: "Error",
                        text: "Expenses Type Information Not Updated :)",
                        confirmButtonColor: "#2196F3",
                        type: "error"
                    });
                }
            });
            $('body').find('.modal-backdrop').attr('class',' ')
            $('body').attr('class','sidebar-xs-indicator pace-done')
        });


    });





    // Alert combination
    $('.delete_type').on('click', function() {
        var id = $(this).parents('ul').attr('id');
        var c_obj = $(this).parents("tr");
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        type:'get',
                        url:'/tenants/expenses/type/delete/'+id,
                        dataType:'json',
                        success:function(data){
                            console.log(data);
                            swal({
                                title: "Deleted!",
                                text: "Expenses Type Information has been deleted.",
                                confirmButtonColor: "#66BB6A",
                                type: "success"
                            });
                            c_obj.remove();

                        },error:function(data){
                            console.log(data);
                            swal({
                                title: "Error",
                                text: "Delete is Not Completed :(",
                                confirmButtonColor: "#2196F3",
                                type: "error"
                            });
                        }
                    });
                }
                else {
                    swal({
                        title: "Cancelled",
                        text: "Your imaginary file is safe :)",
                        confirmButtonColor: "#2196F3",
                        type: "error"
                    });
                }
            });
    });

    // Alert combination
    $('.delete_expense').on('click', function(e) {
        console.log(e);
        var id = $(this).parent('li').attr('id');
        var c_obj = $(this).parents("tr");
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Information!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        type:'get',
                        url:'expenses/delete/'+id,
                        dataType:'json',
                        success:function(data){
                            console.log(data);
                            swal({
                                title: "Deleted!",
                                text: "Expense Information has been deleted.",
                                confirmButtonColor: "#66BB6A",
                                type: "success"
                            });
                            c_obj.remove();

                        },error:function(data){

                            swal({
                                title: "Error",
                                text: "Expense Information Delete is Not Completed :(",
                                confirmButtonColor: "#2196F3",
                                type: "error"
                            });
                        }
                    });
                }
                else {
                    swal({
                        title: "Cancelled",
                        text: "Your Expense Information is safe :)",
                        confirmButtonColor: "#2196F3",
                        type: "error"
                    });
                }
            });
    });
    
    // search method 
    
    $('#search').on('click', function (e) {

        console.log(e);
        $(this).html('Search <i class="icon-spinner2 spinner"></i>');
        var date_from = $('input[name="date_from"]').val();
        var date_to = $('input[name="date_to"]').val();

        $.ajax({
            url:' ',
            type:'GET',
            dataType:'html',
            data:'data_from='+date_from+'&data_to='+date_to,
            success:function(response){
                console.log(response);
                $('tbody').empty();
                $('tbody').html(response);
                swal({
                    title: "Deleted!",
                    text: "Expense Information has been deleted.",
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                });

            },
            error:function(response){
                console.log(response);
                swal({
                    title: "Error",
                    text: "Searching is Not Completed. Try Again :(",
                    confirmButtonColor: "#2196F3",
                    type: "error"
                });
            }
        });
        $(this).html('Search');
    });
})
