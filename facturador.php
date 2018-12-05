<script>
var facturador = {
    detalle: {
        igv: 0,
        total: 0,
        subtotal: 0,
        items: []
    },
    /* Encargado de agregar un producto a nuestra colección */
    registrar: function(item) {},
    /* Encargado de actualizar el precio/cantidad de un producto */
    actualizar: function(id, row) {},
    /* Encargado de retirar el producto seleccionado */
    retirar: function(id) {},
    /* Refresca todo los productos elegidos */
    refrescar: function() {}
};
</script>


<script type="text/javascript">
    registrar: function(item) { /* Agregamos el total */
    item.total = (item.cantidad * item.precio);
    this.detalle.items.push(item);
    this.refrescar();
}
</script>


<script type="text/javascript">
    /* Encargado de agregar un producto a nuestra colección */
registrar: function(item)
{
    /* Agregamos el total */
    item.total = (item.cantidad * item.precio);

    this.detalle.items.push(item);

    this.refrescar();
},

/* Encargado de actualizar el precio/cantidad de un producto */
actualizar: function(id, row)
{
    /* Capturamos la fila actual para buscar los controles por sus nombres */
    row = $(row).closest('.list-group-item');

    /* Buscamos la columna que queremos actualizar */
    $(this.detalle.items).each(function(indice, fila){
        if(indice == id)
        {
            /* Agregamos un nuevo objeto para reemplazar al anterior */
            facturador.detalle.items[indice] = {
                producto: row.find("input[name='producto']").val(),
                cantidad: row.find("input[name='cantidad']").val(),
                precio:   row.find("input[name='precio']").val()
            };

            facturador.detalle.items[indice].total = facturador.detalle.items[indice].precio * facturador.detalle.items[indice].cantidad;

            return false;
        }
    })

    this.refrescar();
}
</script>
<script type="text/javascript">
    refrescar: function()
{
    this.detalle.total = 0;

    /* Declaramos un id y calculamos el total */
    $(this.detalle.items).each(function(indice, fila){
        facturador.detalle.items[indice].id = indice;
        facturador.detalle.total += fila.total;
    })

    /* Calculamos el subtotal e IGV */
    this.detalle.igv      = (this.detalle.total * 0.18).toFixed(2); // 18 % El IGV y damos formato a 2 deciamles
    this.detalle.subtotal = (this.detalle.total - this.detalle.igv).toFixed(2); // Total - IGV y formato a 2 decimales
    this.detalle.total    = this.detalle.total.toFixed(2);

    var template   = $.templates("#facturador-detalle-template");
    var htmlOutput = template.render(this.detalle);

    $("#facturador-detalle").html(htmlOutput);
}
</script>



<script id="facturador-detalle-template" type="text/x-jsrender" src=""> 
    {{for items}}
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-7">
                <div class="input-group"> <span class="input-group-btn"> 
                    <button class="btn btn-danger form-control" class="btn-retirar">                            
                        <i class="glyphicon glyphicon-minus"></i></button>                    
                </span>
                    <input name="producto" class="form-control" type="text" placeholder="Nombre del producto" value="{{:producto}}" /> </div>
            </div>
            <div class="col-xs-1">
                <input name="cantidad" class="form-control" type="text" placeholder="Cantidad" value="{{:cantidad}}" /> </div>
            <div class="col-xs-2">
                <div class="input-group"> 
                    <span class="input-group-addon">                  
                        <input name="precio" class="form-control" type="text" placeholder="Precio" value="{{:precio}}" />                </div>            
                       </div>            
                       <div class="col-xs-2">                
                        <div class="input-group">                    
                            <span class="input-group-addon">S/.</span>
                             <input class="form-control" type="text" readonly value="{{:total}}" /> <span class="input-group-btn">                        
                                <button class="btn btn-success form-control" class="btn-retirar">                            <i class="glyphicon glyphicon-refresh"></i>                        
                                </button>                    
                            </span> 
                    </div>
                </div>
            </div>
        </li> 
    {{else}}
    <li class="text-center list-group-item">No se han agregado productos al detalle</li> {{/for}}
    <li class="list-group-item">
        <div class="row text-right">
            <div class="col-xs-10 text-right"> Sub Total </div>
            <div class="col-xs-2"> <b>{{:subtotal}}</b> </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row text-right">
            <div class="col-xs-10 text-right"> IGV (18%) </div>
            <div class="col-xs-2"> <b>{{:igv}}</b> </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row text-right">
            <div class="col-xs-10 text-right"> Total </div>
            <div class="col-xs-2"> <b>{{:total}}</b> </div>
        </div>
    </li>
</script>

<button class="btn btn-danger form-control">
 <i class="glyphicon glyphiconminus"></i>
</button>

<button class="btn btn-success form-control" class="btn-retirar">
 <i class="glyphicon glyphicon-refresh"></i>
</button>


<script type="text/javascript">
$(document).ready(function() {
    $("#btn-agregar").click(function() {
        facturador.registrar({
            producto: $("#producto").val(),
            cantidad: $("#cantidad").val(),
            precio: $("#precio").val(),
        });
        $("#producto").val('');
        $("#precio").val('');
        $("#cantidad").val('');
    })
})

</script>