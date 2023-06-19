$(function () {
    if (document.getElementById('productVarianteInvalid')) {
        $('#productVarianteInvalid').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            paging: true,
            lengthChange: true,
            searching: true,
            order: [[ 0, "desc" ]],
            //"ordering": true,
            info: true,
            autoWidth: false,
            //"responsive": true,
            columnDefs: [ { type: 'date-euro', targets: 0 } ],
        });
        if ($('#div-loading')) {
            $('#div-loading').hide();
        }
    }
    if (document.getElementById('familyInvalid')) {
        $('#familyInvalid').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            paging: true,
            lengthChange: true,
            searching: true,
            order: [[ 0, "asc" ]],
            //"ordering": true,
            info: true,
            autoWidth: false,
            //"responsive": true,
        });
        if ($('#div-loading')) {
            $('#div-loading').hide();
        }
    }
    if (document.getElementById('customerInvalid')) {
        $('#customerInvalid').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            paging: true,
            lengthChange: true,
            searching: true,
            order: [[ 0, "desc" ]],
            //"ordering": true,
            info: true,
            autoWidth: false,
            //"responsive": true,
            columnDefs: [ { type: 'date-euro', targets: 0 } ],
        });
        if ($('#div-loading')) {
            $('#div-loading').hide();
        }
    }
    if (document.getElementById('activePanier')) {
        $('#activePanier').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            paging: true,
            lengthChange: true,
            searching: true,
            order: [[ 0, "desc" ]],
            //"ordering": true,
            info: true,
            autoWidth: false,
            //"responsive": true,
            columnDefs: [ { type: 'date-euro', targets: 0 } ],
        });
        if ($('#div-loading')) {
            $('#div-loading').hide();
        }
    }
    if (document.getElementById('historiquePanier')) {
        $('#historiquePanier').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            paging: true,
            lengthChange: true,
            searching: true,
            order: [[ 0, "desc" ]],
            //"ordering": true,
            info: true,
            autoWidth: false,
            //"responsive": true,
            columnDefs: [ { type: 'date-euro', targets: 0 } ],
        });
        if ($('#div-loading')) {
            $('#div-loading').hide();
        }
    }
    if (document.getElementById('lastActivityUsers')) {
        $('#lastActivityUsers').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            paging: true,
            lengthChange: true,
            searching: true,
            order: [[ 0, "desc" ]],
            //"ordering": true,
            info: true,
            autoWidth: false,
            //"responsive": true,
            columnDefs: [ { type: 'date-euro', targets: 0 } ],
        });
        if ($('#div-loading')) {
            $('#div-loading').hide();
        }
    }
    if (document.getElementById('historiqueConnexion')) {
        $('#historiqueConnexion').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            paging: true,
            lengthChange: true,
            searching: true,
            order: [[ 0, "desc" ]],
            //"ordering": true,
            info: true,
            autoWidth: false,
            //"responsive": true,
            columnDefs: [ { type: 'date-euro', targets: 0 } ],
        });
        if ($('#div-loading')) {
            $('#div-loading').hide();
        }
    }
    if (document.getElementById('maxCommandable')) {
        $('#maxCommandable').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            paging: true,
            lengthChange: true,
            searching: true,
            //order: [[ 0, "desc" ]],
            //"ordering": true,
            info: true,
            autoWidth: false,
            //"responsive": true,
            //columnDefs: [ { type: 'date-euro', targets: 0 } ],
        });
        if ($('#div-loading')) {
            $('#div-loading').hide();
        }
    }
    if (document.getElementById('statProduct')) {
        if ($('#div-loading')) {
            $('#div-loading').hide();
        }
    }
    if (document.getElementById('listError')) {
        $('#listError').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            paging: true,
            //"lengthChange": true,
            searching: true,
            order: [[ 0, "desc" ]],
            //"ordering": true,
            info: true,
            autoWidth: false,
            //responsive: true,
            columnDefs: [ { type: 'date-euro', targets: 0 } ],
        });
        if ($('#div-loading')) {
            $('#div-loading').hide();
        }
    }
    if (document.getElementById('listExecutionSHOPBOT')) {
        $('#listExecutionSHOPBOT').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            paging: true,
            //"lengthChange": true,
            searching: true,
            //order: [[ 0, "desc" ]],
            "ordering": false,
            info: true,
            autoWidth: false,
            //responsive: true,
        });
        if ($('#div-loading')) {
            $('#div-loading').hide();
        }
    }
});
