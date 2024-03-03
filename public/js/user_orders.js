function showOrders(request) {
    var data = eval("(" + request.responseText + ")");
    console.log(data);

    var el = document.getElementById('table_data');
    for (var key in data) {
        var row = document.createElement('div');
        row.className = 'order_table';
        row.id = 'id_' + data[key]['id'];

        var col = document.createElement('div')
        col.className = 'order_number';
        col.innerHTML = data[key]['id'];
        row.appendChild(col);

        col = document.createElement('div')
        col.className = 'order_date_time';
        col.innerHTML = data[key]['date_time'];
        row.appendChild(col);

        col = document.createElement('div')
        col.className = 'order_price';
        col.id = 'price_' + data[key]['id'];
        col.innerHTML = '';
        row.appendChild(col);
        sendRequest('POST', '/shop/getorderprice', 'id=' + data[key]['id'], showPrice);

        col = document.createElement('div')
        col.className = 'order_paid';
        if (data[key]['is_paid'])
            col.innerHTML = 'Да';
        else
            col.innerHTML = 'Нет';
        row.appendChild(col);

        col = document.createElement('div')
        col.className = 'order_description';
        col.innerHTML = data[key]['description'];
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

window.onload = function () {
    sendRequest('POST', '/shop/getuserorders', 'id=' + user_id, showOrders);

}