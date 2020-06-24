let phonesQuantity = 0;
let addressesQuantity = 0;
let phoneMinus = false;
let addressMinus = false;

window.onload = () => {
    if (typeof(contact) != 'undefined') {
        $("#name").val(contact.name);
        $("#company").val(contact.company);
        $("#role").val(contact.role);
        for (let i = 0; i < contact.phones.length; i++) {
            if (i > 0) this.addPhone();
            // phones.push({ phone_id: contact.phones[i].phone_id });
            $("#phoneSelect" + i).val(contact.phones[i].type);
            $("#phoneInput" + i).val(contact.phones[i].phone);
        }
        for (let i = 0; i < contact.addresses.length; i++) {
            if (i > 0) this.addAddress();
            // addresses.push({
            //     address_id: contact.addresses[i].address_id
            // });
            $("#zipCode" + i).val(contact.addresses[i].zip_code);
            $("#street" + i).val(contact.addresses[i].street);
            $("#number" + i).val(contact.addresses[i].number);
            $("#neighborhood" + i).val(contact.addresses[i].neighborhood);
            $("#complement" + i).val(contact.addresses[i].complement);
            $("#city" + i).val(contact.addresses[i].city);
            $("#state" + i).val(contact.addresses[i].state);
        }
    }
}

function getCep(id) {
    let zipCode = $("#zipCode" + id).val();
    zipCode = zipCode.replace("-", "");

    if (zipCode == "") {
        swal("Oops", "Digite um CEP para procurar", "info");
        return;
    }

    $.ajax({
        method: "GET",
        url: "https://viacep.com.br/ws/" + zipCode + "/json/"
    })
        .done(result => {
            $("#street" + id).val(result.logradouro);
            $("#neighborhood" + id).val(result.bairro);
            $("#complement" + id).val(result.complemento);
            $("#city" + id).val(result.localidade);
            $("#state" + id).val(result.uf);
            $("#number" + id).focus();
        })
        .fail(result => {
            swal(
                "Oops",
                "CEP não encontrado \n Por favor digite manualmente",
                "info"
            );
            return;
        });
}

function addPhone() {
    phonesQuantity++;

    if (phonesQuantity > 0 && !phoneMinus) {
        let minus = "";
        minus =
            '<li id="removePhone"><button type="button" onclick="removePhone()" class="button small"><span class="icon solid fa-minus"></span></li>';
        $("#phoneActions").append(minus);
        phoneMinus = true;
    }

    let html = '';

    html += '<div id="phoneDiv' + phonesQuantity + '" class="col-md-4 col-sm-12">';
        html += '<label for="phoneLabel' + phonesQuantity + '">Telefone:</label>';
            html += '<div class="input-group mb-3">';
                    html += '<select name="phones[' + phonesQuantity + '][type]" class="col-5 custom-select" id="phoneSelect' + phonesQuantity + '">';
                        html += '<option value="celular">Celular</option>';
                        html += '<option value="residencial">Residencial</option>';
                    html += '</select>';
                html += '<div class="col-7 input-group-append no-padding">';
                    html += '<input name="phones[' + phonesQuantity + '][phone]" type="text" onkeyup="phoneMask(' + phonesQuantity + ')" id="phoneInput' + phonesQuantity + '" placeholder="Telefone..." />';
                html += '</div>';
            html += '</div>';
    html += '</div>';

    $('#phonesDiv').append(html);
}

function removePhone() {
    $("#phoneDiv" + phonesQuantity).remove();
    phonesQuantity--;
    if (phonesQuantity == 0 && phoneMinus) {
        $("#removePhone").remove();
        phoneMinus = false;
    }
}

function addAddress() {
    addressesQuantity++;

    if (addressesQuantity > 0 && !addressMinus) {
        let minus = "";
        minus =
            '<li id="removeAddress"><button type="button" onclick="removeAddress()" class="button small"><span class="icon solid fa-minus"></span></li>';
        $("#addressActions").append(minus);
        addressMinus = true;
    }

    let html = '';

    html += '<div id="addressDiv' + addressesQuantity + '" style="border-top: solid 1px rgba(210, 215, 217, 0.75); margin-top: 20px;">';
        html += '<div class="row gtr-uniform">';
            html += '<div class="col-md-3 col-sm-12">';
                html += '<label for="zipCode' + addressesQuantity + '">CEP:</label>';
                html += '<div class="input-group mb-3" style="align-items: center;">';
                    html += '<input type="text" name="addresses[' + addressesQuantity + '][zip_code]" onkeyup="zipCodeMask(' + addressesQuantity + ')" id="zipCode' + addressesQuantity + '" class="form-control" placeholder="CEP..." aria-label="Recipient\'s username" aria-describedby="basic-addon2">';
                    html += '<div class="input-group-append">';
                        html += '<button id="zipButton' + addressesQuantity + '" class="button search btn btn-outline-secondary" type="button" onclick="getCep(' + addressesQuantity + ')"><span class=" icon solid fa-search"></span></button>';
                    html += '</div>';
                html += '</div>';
            html += '</div>';
        html += '</div>';
        html += '<div class="row gtr-uniform">';
            html += '<div class="col-md-6 col-sm-12">';
                html += '<label for="street' + addressesQuantity + '">Logradouro:</label>';
                html += '<input type="text" name="addresses[' + addressesQuantity + '][street]" id="street' + addressesQuantity + '" placeholder="Logradouro..." />';
            html += '</div>';
            html += '<div class="col-md-3 col-sm-12">';
                html += '<label for="number' + addressesQuantity + '">Número:</label>';
                html += '<input type="text" name="addresses[' + addressesQuantity + '][number]" id="number' + addressesQuantity + '" placeholder="Número..." />';
            html += '</div>';
            html += '<div class="col-md-3 col-sm-12">';
                html += '<label for="neighborhood' + addressesQuantity + '">Bairro:</label>';
                html += '<input type="text" name="addresses[' + addressesQuantity + '][neighborhood]" id="neighborhood' + addressesQuantity + '" placeholder="Bairro..." />';
            html += '</div>';
            html += '<div class="col-md-4 col-sm-12">';
                html += '<label for="complement' + addressesQuantity + '">Complemento:</label>';
                html += '<input type="text" name="addresses[' + addressesQuantity + '][complement]" id="complement' + addressesQuantity + '" placeholder="Complemento..." />';
            html += '</div>';
            html += '<div class="col-md-4 col-sm-12">';
                html += '<label for="city' + addressesQuantity + '">Cidade:</label>';
                html += '<input type="text" name="addresses[' + addressesQuantity + '][city]" id="city' + addressesQuantity + '" placeholder="Cidade..." />';
            html += '</div>';
            html += '<div class="col-md-4 col-sm-12">';
                html += '<label for="state' + addressesQuantity + '">Estado:</label>';
                html += '<input type="text" name="addresses[' + addressesQuantity + '][state]" id="state' + addressesQuantity + '" placeholder="Estado..." />';
            html += '</div>';
        html += '</div>';
    html += '</div>';

    $('#addressesDiv').append(html);
}

function removeAddress() {
    $("#addressDiv" + addressesQuantity).remove();
    addressesQuantity--;
    if (addressesQuantity == 0 && addressMinus) {
        $("#removeAddress").remove();
        addressMinus = false;
    }
}

function phoneMask(id) {
    const e = window.event;
    const code = e.keyCode;
    if (code == 8) return;

    let input = e.target;
    let value = input.value;
    if (!value) return;

    value = value.replace(/\D/g, "");

    const parts = [];
    if ($("#phoneSelect" + id).val() == "celular") {
        const ddd = value.substring(0, 2);
        const nine = value.substring(2, 3);
        const prefix = value.substring(3, 7);
        const suffix = value.substring(7, 11);

        if (ddd) parts.push("(" + ddd + ")");
        if (nine) parts.push(" " + nine);
        if (prefix) parts.push(" " + prefix);
        if (suffix) parts.push("-" + suffix);
    } else {
        const ddd = value.substring(0, 2);
        const prefix = value.substring(2, 6);
        const suffix = value.substring(6, 10);

        if (ddd) parts.push("(" + ddd + ")");
        if (prefix) parts.push(" " + prefix);
        if (suffix) parts.push("-" + suffix);
    }

    e.target.value = parts.join().replace(/,/g, "");
}

function zipCodeMask(id) {
    const e = window.event;
    const code = e.keyCode;
    if (code == 8) return;
    if (code == 13) this.getCep(id);

    let input = e.target;
    let value = input.value;
    if (!value) return;

    value = value.replace(/\D/g, "");

    const parts = [];
    const prefix = value.substring(0, 5);
    const suffix = value.substring(5, 8);

    if (prefix) parts.push(prefix);
    if (suffix) parts.push("-" + suffix);

    e.target.value = parts.join().replace(/,/g, "");
}
