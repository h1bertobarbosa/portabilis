/**
 * Created by humberto on 10/3/16.
 */
matricula = {
    mascara: function () {
        $('#data_matricula').inputmask({mask:["99/99/9999"]});
        $('#ano').inputmask({mask:["9999"]});
    },
    
    cancelar: function () {

        $('#page-wrapper').on('click','#cancelar',function(event) {
            event.preventDefault();
            var formAction = $(this).attr('href'); // form handler url
            var formMethod = 'POST'; // GET, POST

            swal({
                title: "Tem certeza?",
                text: "Você tem certeza que quer cancelar esta matrícula",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, Cancelar!",
                closeOnConfirm: false,
                html: false
            }, function(){
                $("#loading-div").show();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type  : formMethod,
                    url   : formAction,
                    async : true,
                    processData: false,
                    contentType: false,
                    cache : false,

                    success : function(data) {
                        $("#loading-div").hide();
                        swal("Cancelada!",
                            "Matrícula cancelada com sucesso",
                            "success");
                        
                        window.location.href = '/matriculas';
                    },

                    error : function(jqXhr, json, errorThrown) {
                        $("#loading-div").hide();
                    }
                });

            });

        });
    },

    pagar: function () {

        $('#page-wrapper').on('click','#pagar',function(event) {
            event.preventDefault();
            var formAction = $(this).attr('href'); // form handler url
            var formMethod = 'POST'; // GET, POST

            swal({
                title: "Tem certeza?",
                text: "Você tem certeza que quer marcar esta matrícula como paga ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, pagar!",
                closeOnConfirm: false,
                html: false
            }, function(){
                $("#loading-div").show();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type  : formMethod,
                    url   : formAction,
                    async : true,
                    processData: false,
                    contentType: false,
                    cache : false,

                    success : function(data) {
                        $("#loading-div").hide();
                        swal("Paga!",
                            "Matrícula paga com sucesso",
                            "success");

                        window.location.href = '/matriculas';
                    },

                    error : function(jqXhr, json, errorThrown) {
                        $("#loading-div").hide();
                    }
                });

            });

        });
    },

    informarValor: function () {

        $('#page-wrapper').on('click','#infValor',function(event) {
            event.preventDefault();
            var formAction = $(this).attr('href'); // form handler url
            var formMethod = 'POST'; // GET, POST

            var inscricao = formAction.split('/');
            var valorInscricao = inscricao[inscricao.length -1];
            swal({
                title: "Valor da Inscrição: "+valorInscricao,
                text: "Valor recebido:",
                type: "input",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                confirmButtonText: "Gerar troco",
                showLoaderOnConfirm: true,
                inputPlaceholder: "Digite o valor com virgula"
            },
            function(inputValue){
                if (inputValue === false) return false;

                if (inputValue === "") {
                    swal.showInputError("Você precisa digitar o valor recebido");
                    return false
                }

                $("#loading-div").show();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type  : formMethod,
                    url   : formAction,
                    data  : {'valorEntregue': inputValue},
                    async : true,
                    processData: true,
                    cache : false,

                    success : function(data) {
                        $("#loading-div").hide();

                        swal("Melhor troco!", data, "success");
                    },

                    error : function(jqXhr, json, errorThrown) {
                        $("#loading-div").hide();
                    }
                });


            });

        });
    }
}