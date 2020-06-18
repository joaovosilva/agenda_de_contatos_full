let table = null;
let dataTableData = {
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,

    language: {
        searchPlaceholder: "Procurar...",
    },

    oLanguage: {
        sProcessing: "Aguarde enquanto os dados são carregados ...",
        sLengthMenu: "Mostrar _MENU_ registros por pagina",
        sZeroRecords: "Nenhum registro encontrado",
        sInfoEmpty: "Exibindo 0 a 0 de 0 registros",
        sInfo: "Exibindo de _START_ a _END_ de _TOTAL_ registros",
        sInfoFiltered: "",
        sSearch: "Procurar",
        oPaginate: {
            sFirst: "Primeiro",
            sPrevious: "Anterior",
            sNext: "Próximo",
            sLast: "Último",
        },
    },
};

window.onload = function () {
    this.loadDataTable();
};

function loadDataTable() {
    let contactsArray = [];

    contacts.map((v) => {
        let contact = {
            name: v.name,
            company: v.company,
            role: v.role,
            phone: v.phones[0] ? v.phones[0].phone : '',
            options: `<div>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <span class="fa fa-th"></span>
                            </button>
                            <ul class="dropdown-menu" style="    transform: translate3d(800px, 170px, 0px) !important;">
                                <!--<li><a href="javascript:void(0)" onclick="visualizeContact(`+ v.contact_id +`)">Visualizar</a></li>-->
                                <li><a href="/contacts/`+ v.contact_id +`">Editar</a></li>
                                <li><a method="post" href="/contacts/`+ v.contact_id +`/delete">Excluir</a></li>
                            </ul>
                        </div>
                    </div>`,
        };

        contactsArray.push(contact);
    });

    renderTable(contactsArray);
}

function renderTable(data) {
    renderDestroy();
    var tableItem = dataTableData;
    tableItem.columns = [
        { data: "name" },
        { data: "company" },
        { data: "role" },
        { data: "phone" },
        { data: "options" },
    ];

    table = $("#contactsTable").DataTable(tableItem).rows.add(data).draw();
}

function renderDestroy() {
    if (table != null) {
        table.clear();
        table.destroy();
        table = null;
    }
}
