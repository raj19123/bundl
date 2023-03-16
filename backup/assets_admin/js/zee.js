// Email Validation
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

// HTML Escape Validation
function isHTML(html) {
    var regex = /<(.|\n)*?>/g;
    return regex.test(html);
}

// JSON Validation
function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

// Form Validation
function validateFields(selectedInputs, language='english'){
    var validation = false;
    var errors = getErrorMessages(language);
    var e;

    if(! $.isArray(selectedInputs)){
        validation = false;
        return false;
    }else{

        $.each(selectedInputs, function(index, value){
            e = $('input[name='+value+']');
            
            if(! e.is('input')){
                e = $('select[name='+value+']');
                if(! e.is('select')){
                   e = $('textarea[name='+value+']');
                }
            }

            //validate email input
            if(value == 'email'){
                var email = e.val();
                if(! isEmail(email)){
                    e.focus();
                    // $('.'+value+'-error').html(language).show();
                    $('.'+value+'-error').html(errors.errorMsgEmail).show();
                    validation = false;
                    return false;
                }
            }

            //validate select inputs
            if(e.is('select')){
               e = $('select[name='+value+']');
               //console.log('select: ', value);
            }

            //these lines must after select validation
            value = value.replace(/\"/g, "");
            value = value.replace(/\'/g, "");
            value = value.replace(/\]/g, "");
            value = value.replace(/\[/g, "");

            //validate radio inputs
            if(e.is('input:radio')){
                //console.log('radio: ', e);
                if( ! $('input:radio[name='+value+']:checked').length) {
                    //console.log('radio unchecked: ', e);
                    e.focus();
                    $('.'+value+'-error').html(errors.errorMsg).show();
                    validation = false;
                    return false;
                }
            }

            //validate check box inputs
            if(e.is('input:checkbox')){
                if( ! $('input:checkbox[name='+value+']:checked').length) {
                    e.focus();
                    $('.'+value+'-error').html(errors.errorMsg).show();
                    validation = false;
                    return false;
                }
            }

            //Check HTML escape validation for all text inputs
            if (isHTML(e.val())) {
                e.focus();
               $('.'+value+'-error').html(errors.htmlerrorMsg).show();
                validation = false;
                return false;
            }

            //validate all other input types
            if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
               console.log('input: ', e.val());
               e.focus();
               $('.'+value+'-error').html(errors.errorMsg).show();
                validation = false;
                return false;
            }else{
                validation = true;
                $('.'+value+'-error').html('').hide();
            }
        });
        // console.log(validation);
        if(validation == true){
            return true;
        }else{
            return false;
        }
    }
}

// sort select options
function selectSort(selectELement) {
    var options = $(selectELement+' option');
    var arr = options.map(function(_, o) {
        return {
            t: $(o).text(),
            v: o.value
        };
    }).get();
    arr.sort(function(o1, o2) {
        return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0;
    });
    options.each(function(i, o) {
        o.value = arr[i].v;
        $(o).text(arr[i].t);
    });
}

// convert form data to JSON object
$.fn.serializeObject = function(){
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};


// JSON Validation
function getErrorMessages(language) {
    if (language == 'english') {
        var errorMsg = "This value is required.";
        var htmlerrorMsg = "HTML Tags are not allowed.";
        var errorMsgEmail = "Email is not correct.";
    }
    if (language == 'arabic') {
        var errorMsg = "هذه القيمة مطلوبة.";
        var htmlerrorMsg = "علامات HTML غير مسموح بها.";
        var errorMsgEmail = "البريد الإلكتروني غير صحيح.";
    }
    
    //reurn error messages object
    var messages = {
        errorMsg: errorMsg, 
        htmlerrorMsg: htmlerrorMsg, 
        errorMsgEmail: errorMsgEmail
    };
    return messages;
}

//load default image for every img tag in the project
/*function loadDefaultImage(path){
    $("img").on("error", function(){
        $(this).attr("src", path);
    });
}*/

//// Number formater //////
/*function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}*/

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

String.prototype.toProperCase = function () {
    return this.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
};

//global delete functionality
function deleteRecord(x){
    var id  = $(x).data('id');
    var table = $(x).data('table');
    var link = $(x).data('url');
    var images = $(x).data('images');
    var imagesPath = $(x).data('path');
    var imagesColumn = $(x).data('column');
   
    var postingData = {
        'id': id, 
        'table': table, 
        'images': images, 
        'imagesPath': imagesPath, 
        'imagesColumn': imagesColumn
    }
    console.log(postingData);
    if(id && table){

        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover it later!",
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: 'btn-default btn-md waves-effect',
                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                confirmButtonText: 'Confirm'
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.post(link, postingData, function(result){
                        var data = false;
                        var isJson = IsJsonString(result);
                        if(isJson){
                            data = JSON.parse(result);
                        }

                        if(data){
                            if(data.type == 'success'){
                                swal({
                                    title: "Success!",
                                    text: data.msg,
                                    type: "success"
                                }, function() {
                                    location.reload();
                                });
                            }

                            if(data.type == 'error'){
                                swal({
                                    title: "Error!",
                                    text: data.msg,
                                    type: "error"
                                }, function() {
                                    location.reload();
                                });
                            }
                        }else{
                            swal({
                                title: "Error!",
                                text: "Delete operation has been failed. Please try again!",
                                type: "error"
                            }, function() {
                                location.reload();
                            });
                        }
                    });
                }
            }
        );
    }else{
        swal({
            title: "Error!",
            text: "Required information is missing. Please try again later.",
            type: "error"
        }, function() {
            location.reload();
        });
    }
}
