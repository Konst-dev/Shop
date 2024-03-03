function showOrders(request) {
    var data = eval("(" + request.responseText + ")");
    console.log(data);

    var el = document.getElementById('table_data');
    el.innerHTML = '';
    for (var key in data) {
        var row = document.createElement('div');
        row.className = 'order_table';
        row.id = 'id_' + data[key]['Orders_id'];

        var col = document.createElement('div')
        col.className = 'order_number';
        col.innerHTML = data[key]['Orders_id'];
        row.appendChild(col);

        col = document.createElement('div')
        col.className = 'order_date_time';
        col.innerHTML = data[key]['date_time'];
        row.appendChild(col);

        col = document.createElement('div')
        col.className = 'order_price';
        col.id = 'price_' + data[key]['Orders_id'];
        col.innerHTML = '';
        row.appendChild(col);
        sendRequest('POST', '/shop/getorderprice', 'id=' + data[key]['Orders_id'], showPrice);


        col = document.createElement('div')
        col.className = 'order_paid';
        if (data[key]['is_paid'])
            col.innerHTML = 'Да';
        else
            col.innerHTML = 'Нет';
        row.appendChild(col);

        col = document.createElement('div')
        col.className = 'order_fio';
        col.innerHTML = data[key]['lastname'] + ' ' + data[key]['firstname'] + ' ' + data[key]['middlename'];
        row.appendChild(col);

        col = document.createElement('div')
        col.className = 'order_phone';
        col.innerHTML = data[key]['phone_number'];
        row.appendChild(col);

        col = document.createElement('div')
        col.className = 'order_email';
        col.innerHTML = data[key]['email'];
        row.appendChild(col);

        row.addEventListener('click', (e) => {
            var id = e.currentTarget.id.split('_')[1];
            window.location.href = '/shop/order/' + id;

        });

        el.appendChild(row);
    }

}

function showPrice(request) {
    var data = eval("(" + request.responseText + ")");
    var id = data['id'];
    var el = document.getElementById(id);
    el.innerHTML = data['price'];
}

function formClick() {
    var data = new FormData(form);
    var str = '';
    for (let [name, value] of data) {
        str += `${name}=${value}` + '&';
    }
    sendRequest('POST', '/shop/neworder', str, showOrders);
    form_lastname.value = '';
    form_firstname.value = '';
    form_middlename.value = '';
    phone.value = '';
    email.value = '';
    description.innerHTML = 'Описание заказа';
}

window.onload = function () {
    sendRequest('POST', '/shop/getorders', '', showOrders);

}