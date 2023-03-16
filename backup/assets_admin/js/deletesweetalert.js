/*function deleteRecord(x){
    var id  = $(x).data('id');
    var table = $(x).data('table');
    var link = $(x).data('url');

    if(id!='' && table!=''){

        swal({
                title: "Are you sure to delete?",
                text: "Alert! you cannot recover it later.",
                type: "error",
                showCancelButton: true,
                cancelButtonClass: 'btn-default btn-md waves-effect',
                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                confirmButtonText: 'Confirm'
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.post(link, {id: id, table: table}, function(result){
                            var data = false;
                            var isJson = IsJsonString(result);
                            if(isJson){
                                data = JSON.parse(result);
                            }

                            if(data){
                                if(data.type == 'success'){
                                    swal("Success!", data.msg, "success");
                                    location.reload();
                                }

                                if(data.type == 'error'){
                                    swal("Error!", data.msg, "error");
                                }
                            }else{
                                swal("Error!", "Delete operation has been failed. Please try again!", "error");
                            }
                        }
                    );
                } else {
                    swal("Cancelled", "Your action has been cancelled!", "error");
                }
            }
        );

    }else{
        swal("Error!", "Information is missing. Please reload the page and try again.", "error");
    }
}*/