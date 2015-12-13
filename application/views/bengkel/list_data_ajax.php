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
    <th width="5px">Id Bengkel</th>
    <th width="5px">Nama Bengkel</th>
    <th width="5px">Koordinat</th>
    <th width="5px">Jenis</th>
    <th width="5px">Deskripsi</th>
    <th width="5px">Rating</th>
    <th width="5px">Kode Kecamatan</th>
    <th width="5px">Tubeless</th>
    <th width="5px">Contact Person</th>

    <?php $index = 1; ?>
    <?php $prevref = ''; ?>
    <?php for( $iRow =0; $iRow < $nrows; $iRow++): ?>
    <tr>
        <!-- <td><?php //echo $index ?></td> -->
        <td><?php echo $records[$iRow]->id_bengkel ?>
            <a class="fa fa-pencil" style="color:green;" href="<?php echo base_url('bengkel/editBengkel/'. $records[$iRow]->id_bengkel) ?>"> </a>
            <a class="fa fa-remove" style="color:red;" href="<?php echo base_url('bengkel/hapusBengkel/'. $records[$iRow]->id_bengkel) ?>"> </a></td>
        </td>
        <td align="center"><?php echo $records[$iRow]->nama_bengkel ?></td>
        <td align="center"><?php echo $records[$iRow]->koordinat ?></td>
        <td align="center"><?php echo $records[$iRow]->jenis ?></td>
        <td align="center"><?php echo $records[$iRow]->deskripsi ?></td>
        <td align="center"><?php echo $records[$iRow]->rating ?></td>

        <?php
            // special variabel buat kolom "kode-kec"
            $kecamatan = 'kode-kec';
        ?>
        <td align="center"><?php echo $records[$iRow]->$kecamatan ?></td>
        <td align="center"><?php echo $records[$iRow]->isTubeless ?></td>
        <td align="center"><?php echo $records[$iRow]->contact_person ?></td>
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
