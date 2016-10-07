/**
 * Created by humberto on 9/30/16.
 */
curso = {
    mascara: function () {
        $("#valor_inscricao").maskMoney({
            allowNegative: false,
            thousands:'.',
            decimal:',',
            affixesStay: false
        });
    }
}