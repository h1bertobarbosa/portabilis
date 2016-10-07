/**
 * Created by humberto on 08/02/16.
 */
main = {
    submeter: function() {
        $('form').on('submit', function(event) {
            $("#loading-div").show();

            var formData = new FormData(this); // form data as string
            var formAction = $(this).attr('action'); // form handler url
            var formMethod = 'POST'; // GET, POST

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type  : formMethod,
                url   : formAction,
                data  : formData,
                async : true,
                processData: false,
                contentType: false,
                cache : false,

                success : function(data) {
                    $("#loading-div").hide();
                    $("#msg_user").empty().hide();
                    //window.location.href = "/home";
                    $('.form-group').removeClass('has-error');
                    if(data.error == true){
                        var msgerro = "<ul>";

                        $('.md-input').removeClass('md-input-danger');

                        if(typeof data.response == 'string'){
                            msgerro += "<li>"+data.response+"</li>";
                        }else{
                            $.each(data.response, function( index, value ) {

                                $( "input[name^="+index+"]").closest('.form-group').addClass('has-error');
                                $( "textarea[name^="+index+"]").closest('.form-group').addClass('has-error');
                                $( "select[name^="+index+"]").closest('.form-group').addClass('has-error');

                                msgerro += "<li>"+value+"</li>";
                            });
                        }

                        msgerro += "</ul>";
                        $("#msg_user").addClass("alert alert-danger").html(msgerro).show();
                    }else{
                        window.location.href = data.callback;
                    }
                },

                error : function(jqXhr, json, errorThrown) {
                    $("#loading-div").hide();
                    //console.log(errors);
                    $('.form-group').removeClass('has-error');
                    $("#msg_user").empty().hide();
                    var msgerro = "<ul>";
                    msgerro += "<li>Ocorreu um erro inesperado ao processar sua requisição, tente novamente,<br/>" +
                        "se o problema persistir contate o administrador do sistema</li>";
                    msgerro += "</ul>";
                    $("#msg_user").addClass("alert alert-danger alert-dismissable").html(msgerro).show();
                }
            });

            return false; // prevent send form
        });
    },


}