<style>
td { margin-top: 0px; margin-bottom: 0px;padding-top: 0px; padding-bottom: 0px;}
p { margin-bottom: 0px;}
table { border-collapse: collapse;}
</style>
<page>
<table border="0" style="text-align:center; width: 100%; margin:auto">
    <tr style="height: 10%;">
        <td style="width:33.33%; text-align: left;" valign="top">
            <b>PT. MITRA KREASIDHARMA</b>
        </td>
        <td style="width:33.33%; ">
            <b style="font-size: 18px;"> PERINTAH PENJUALAN</b><br/>
            <i>Sales Order</i>
            <br />
        </td>
        <td style="width:33.33%;">
            <!-- <span>No: <?php echo $record_hdr->Nobuk ?></span><br/> -->
            <span><b>Status Dokumen : <br/><?php echo TX_STATUS($record_hdr->STATUS) ?></b></span><br/>
            <br />
            <br />
            <br />
        </td>
    </tr>
</table>
<table border="0" style="text-align:center; width: 100%; margin-top:-30px;">
    <tr>
        <td style="width:27%; height:200px;text-align: left;">
            <table border="0">
                <tr>
                    <td width="50%">
                        No.SO
                    </td>
                    <td width="50%">:
                        <?php echo $record_hdr->NO_BUKTI ?>
                    </td>
                </tr>
                <tr>
                    <td width="50%">
                        Jenis Penjualan
                    </td>
                    <td width="50%">:
                        <?php echo $record_hdr->KET ?>
                    </td>
                </tr>
                <tr>
                    <td width="50%">
                        Tanggal SO
                    </td>
                    <td width="50%">:
                        <?php echo DATE_FORMAT_($record_hdr->TGL) ?>
                    </td>
                </tr>
                <tr>
                    <td width="50%">
                        Tanggal Delivery
                    </td>
                    <td width="50%">: 
                        <?php echo DATE_FORMAT_($record_hdr->TGL_KIRIM) ?>
                    </td>
                </tr>
                <tr>
                    <td width="50%">
                        Cara Bayar
                    </td>
                    <td width="50%">:

                    </td>
                </tr>
            </table>
        </td>
        <td style="width:43%; height:200px; text-align: left;">
            <table border="0">
                <tr>
                    <td width="30%">
                        Nama Customer
                    </td>
                    <td width="70%">:
                        <?php echo $record_hdr->NAMA_CUST ?>
                    </td>
                </tr>
                <tr>
                    <td width="30%">
                        PO Customer
                    </td>
                    <td width="70%">: <?php echo $record_hdr->NO_PO_CUST ?>
                    </td>
                </tr>
                <tr>
                    <td width="30%">
                        Tanggal PO
                    </td>
                    <td width="70%">:
                        <?php //echo $record_hdr->TGL_KIRIM ?>
                    </td>
                </tr>
                <tr>
                    <td width="30%">
                        Lokasi
                    </td>
                    <td width="70%">:
                        <?php echo $record_hdr->NAWIL ?>
                    </td>
                </tr>
                <tr>
                    <td width="30%">
                        Sales
                    </td>
                    <td width="70%">:
                        <?php echo $record_hdr->NAMA ?>
                    </td>
                </tr>
            </table>
        </td>
        <td style="width:20%; height:200px; text-align: left;">
            <table>
                <tr>
                    <td width="50%">
                        Delivery to:
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <?php echo $record_hdr->AL ?>                    
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <?php echo $record_hdr->AL1 ?>                    
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <?php echo $record_hdr->AL2 ?>                    
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <?php echo $record_hdr->AL3 ?>                    
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table border="1" class="tabular" style="width: 100%; padding:0px; margin-top:-30px; float:left;">
    <tr>
        <th align="center" style="width:20px;">NO</th>
        <th align="center" style="width:225px;" >NAMA BARANG</th>
        <th align="center" style="width:90px;">JUMLAH</th>
        <th align="center" style="width:110px;">HARGA<br>SATUAN</th>
        <th align="center" style="width:160px;">HARGA</th>
        <th align="center" style="width:65px;">DARI<br>HO</th>
        <th align="center" style="width:65px;">DARI<br>DAERAH</th>
    </tr>
    <?php $no = 1; ?>
    <?php foreach( $record_dtl as $index => $record): ?>
    <tr>
        <td align="center"><?php echo $no ?></td>
        <td><?php echo $record->NAMA ?></td>
        <td align="right"><?php echo $record->QTY.' '.ITEM_UOM( $record->SATUAN, $record->STN, $record->STN2) ?></td>
        <td align="right"><?php echo number_format($record->H_SATUAN,2).' '.$record_hdr->VLT ?></td>
        <td align="right"><?php echo number_format($record->HARGA,2).' '.$record_hdr->VLT ?></td>
        <td><?php echo $record->QTY.' '.ITEM_UOM( $record->SATUAN, $record->STN, $record->STN2)?></td>
        <td><?php echo '0 '.ITEM_UOM( $record->SATUAN, $record->STN, $record->STN2)?></td>
    </tr>
    <?php $no++; endforeach; ?>
    <tr>
        <td colspan="4" align="right">
            Total Price<br/>
            Discount (<?php echo number_format($record_hdr->DISCOUNT,2).'%' ?>)<br/>
            Tax (<?php echo number_format($record_hdr->PPN, 2).'%' ?>)<br/>
            Other<br/>
            Grand Total
        </td>
        <td align="right">
            <?php 
            echo number_format($record_hdr->BRUTO,2).' '.$record_hdr->VLT.'<br/>';
            echo number_format($record_hdr->NILAI_DISC,2).' '.$record_hdr->VLT.'<br/>';
            echo number_format($record_hdr->NILAI_PPN,2).' '.$record_hdr->VLT.'<br/>';
            echo number_format('000',2).' '.$record_hdr->VLT.'<br/>';
            echo number_format($record_hdr->NETTO,2).' '.$record_hdr->VLT;
            ?>
        </td>
        <td></td>
        <td></td>
    </tr>
</table>
<table border="0" style="text-align:center; width: 100%; margin-top:5px;">
    <tr >
        <td colspan="2">
            <table border="0" style="width: 100%; text-align: left;">
                <tr>
                    <td style="width:40px;">Note:</td>
                    <td rowspan="2" style="width:701px; text-align:right" >
                        Jakarta, <?php echo date('d/m/Y') ?>
                    </td>
                </tr>
                <br/>
                <br/>
                <br/>
            </table>
        </td>
    </tr><!-- 
    <tr style="text-align:left; ">
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr style="text-align:left">
        <td>Diterima Oleh</td>
        <td>Diperiksa Oleh</td>
    </tr>
    <tr style="text-align:left; ">
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr style="text-align:left; ">
        <td colspan="2">&nbsp;</td>
    </tr><tr style="text-align:left; ">
        <td colspan="2">&nbsp;</td>
    </tr><tr style="text-align:left; ">
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr style="text-align:left">
        <td>(Supervisor Warehouse)</td>
        <td>(Supervisor Pemakai)</td>
    </tr> -->
</table>
<hr>
</page>
