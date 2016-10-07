/**
 * Created by humberto on 9/28/16.
 */
aluno = {
    mascara: function () {
        $('#telefone').inputmask({mask:["(99) 9999-9999","(99) 99999-9999"]});
        $('#cpf').inputmask({mask:["999.999.999-99"]});
        $('#data_nascimento').inputmask({mask:["99/99/9999"]});
    },
    
    isAnoBissexto: function () {

        $('#data_nascimento').blur(function () {
            var data = $(this).val().split('/');
            var anoBissexto = new Date(data[2], 1, 29).getMonth() == 1;

            if(anoBissexto)
                swal("Ano Bissexto")
        });




    }
};