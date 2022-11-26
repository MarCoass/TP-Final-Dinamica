$(document).ready(function () {
  var lista_de_productos = $("#lista_de_productos").DataTable({
    ajax: {
      type: "POST",
      url: "Accion/obtenerUsuarios.php",
      dataSrc: "",
      data: function (d) {
        d.id_cliente = $("#id_cliente").val();
        d.id_producto = $("#id_producto").val();
        d.id_sucursal = $("#sucursal option:selected").val();
      },
    },
    processing: true,
    responsive: true,
    language: {
      decimal: ",",
      thousands: ".",
      search: "Buscar: ",
      processing: "Obteniendo datos...",
      lengthMenu: "Mostrar MENU elementos por página",
      zeroRecords: "Sin resultados",
      info: "Mostrando PAGE de PAGES páginas",
      infoEmpty: "No se encontraron elementos",
      infoFiltered: "(filtrado de MAX total elementos)",
      paginate: {
        first: "Primera",
        last: "Última",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
    lengthMenu: [
      [10, 50, -1],
      [10, 50, "Todos"],
    ],
    dom: "frtipB",
    buttons: [
      {
        extend: "pageLength",
        text: '<i class="fa fa-eye"></i> Elementos',
        className: "buttons-excel buttons-html5 btn red btn-outline",
      },
      {
        extend: "excelHtml5",
        text: '<i class="fa fa-file-excel-o"></i> Excel',
        className: "buttons-excel buttons-html5 btn red btn-outline",
        title: "Exportar_excel",
      },
    ],
    columnDefs: [
      {
        targets: 0,
        checkboxes: {
          selectRow: true,
        },
      },
    ],
    select: {
      style: "multi",
    },
  });
});
