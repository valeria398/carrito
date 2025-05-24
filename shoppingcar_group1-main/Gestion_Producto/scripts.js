function buscar() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("buscador");
    filter = input.value.toUpperCase();
    table = document.getElementById("tablaInventario");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                document.getElementById("mostrador").innerHTML = txtValue + " encontrado en el inventario.";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function editarProducto() {
    var codigo = document.getElementById("codigo").value;
    var table = document.getElementById("tablaInventario");
    var tr = table.getElementsByTagName("tr");
    for (var i = 0; i < tr.length; i++) {
        var td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            var txtValue = td.textContent || td.innerText;
            if (txtValue === codigo) {
                tr[i].getElementsByTagName("td")[2].innerHTML = document.getElementById("producto").value;
                tr[i].getElementsByTagName("td")[3].innerHTML = document.getElementById("cantidad").value;
                tr[i].getElementsByTagName("td")[4].innerHTML = document.getElementById("precio").value;
                tr[i].getElementsByTagName("td")[5].innerHTML = document.getElementById("entrada").value;
                break;
            }
        }
    }
}
