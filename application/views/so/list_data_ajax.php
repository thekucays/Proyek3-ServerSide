<?php
$pop_no = null;
$nrows = count( $records );
$KECIL = 0;
//var_dump( $records );
?>
<style>
.datatable { width: 1500px;}
.c_overflow { overflow-x: scroll;}
</style>
<p>Record: <?php echo $nrows ?></p>
<table class="table datatable">
    <th width="5px">No</th>
    <th width="140px"> <?php echo lang('NoSO') ?> </th>
    <th width="100px"> <?php echo lang('label_date') ?> </th>
    <th width="140px"> <?php echo lang('label_delivery_date') ?> </th>
    <th width="70px"> <?php echo lang('label_status') ?> </th>
    <th width="100px"><?php echo lang('Approve') ?></th>

    <!-- expr -->
    <th width="50px"> <?php echo lang('NoPoCustomer') ?> </th>
    <th width="50px"> <?php echo lang('Customer') ?>  </th>
    <th width="50px"> <?php echo lang('Currency') ?>  </th>
    <th width="50px"> <?php echo lang('label_remark') ?>  </th>
    <th width="50px"> <?php echo lang('label_itemtgl_input') ?>  </th>
    <th width="50px"> <?php echo lang('label_so_sequence_no') ?> <!--No. Urut--></th>
    <th width="50px"> <?php echo lang('label_itemid') ?>  </th>
    <th width="50px"> <?php echo lang('label_itemname') ?>  </th>
    <th width="50px"> <?php echo lang('Sales') ?>  </th>

    <?php $index = 1; ?>
    <?php $prevref = ''; ?>
    <?php for( $iRow =0; $iRow < $nrows; $iRow++): ?>
    <tr>
        <td><?php echo $index ?></td>
        <td><?php echo $records[$iRow]->NO_BUKTI ?>
            <a class="fa fa-pencil" style="color:green;" href="<?php echo base_url('so/add_so_detail/'. $records[$iRow]->NO_BUKTI) ?>"> </a>
            <a class="fa fa-remove" style="color:red;"> </a></td>
        </td>

        <td><?php echo DATE_FORMAT_($records[$iRow]->TGL) ?></td>
        <td><?php echo DATE_FORMAT_($records[$iRow]->TGL_KIRIM) ?></td>
        <td><?php echo TX_STATUS($records[$iRow]->STATUS) ?></td>
        <td align="center"><?php echo $records[$iRow]->B_APP ?></td>
        <td><?php echo $records[$iRow]->NO_PO_CUST?></td>
        <td><?php echo $records[$iRow]->NAMA_CUST ?></td>
        <td><?php echo $records[$iRow]->VLT ?></td>
        <td><?php echo $records[$iRow]->KET ?></td>
        <td><?php echo DATE_FORMAT_($records[$iRow]->TGL_INPUT) ?></td>
        <td><?php echo $records[$iRow]->NO_URUT ?></td>
        <td><?php echo $records[$iRow]->BRG ?></td>
        <td><?php echo $records[$iRow]->NAMABARANG ?></td>        
        <td><?php echo $records[$iRow]->NAMA ?></td>
    </tr>
    <?php $index++; ?>
    <?php endfor; ?>
</table>
<div class="recvtable modal fade">
    <div class="modal-dialog" style="width: 800px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo lang('label_receivedqty') ?></h4>
            </div>
            <div class="modal-body">
                <div class="row col-lg-12 recvmutation">Loading...</div>
                <div class="row">&nbsp;</div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script>
$.ajaxSetup({cache: false, async: false});
$(".datatable").on("click",".recvqty",function(event){

    event.preventDefault();
    $(".recvtable").modal('show');

    $(".recvmutation").load("<?php echo base_url('po/recvmutation') ?>/" + $(this).attr('href') + "/" + Math.random(1000000));
});
</script>
