<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/sparkline/retina.js"></script>
<script src="assets/js/scrollup.min.js"></script>
<script src="assets/js/d3.min.js"></script>
<script src="assets/js/heatmap/cal-heatmap.min.js"></script>
<script src="assets/js/heatmap/cal-heatmap.custom.js"></script>
<script src="assets/js/datatables/dataTables.min.js"></script>
<script src="assets/js/datatables/dataTables.bootstrap.min.js"></script>
<script src="assets/js/datatables/dataTables.tableTools.js"></script>
<script src="assets/js/datatables/autoFill.min.js"></script>
<script src="assets/js/datatables/autoFill.bootstrap.min.js"></script>
<script src="assets/js/datatables/fixedHeader.min.js"></script>
<script src="assets/js/datatables/custom-datatables.js"></script>
<script src="assets/js/common.js"></script>
<!--<script  src="assets/js/jquery.dataTables.min.js">-->
</script>

<script>
$(document).ready(function(){
  $('select:first').on('change',function(){
  var uu= "Producto/getcategoria.php";
            $.ajax({
                url: uu,
                type: "GET",
                dataType: "html",
                data: {valor:  $(this).val()}
})

                .done(function(res){
                    $("#mensaje").html(res);
                });
});
        });
</script>



