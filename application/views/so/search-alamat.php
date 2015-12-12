<p>Result: <?php echo count($records) ?></p>
<table class="table" role="table">
    <th>No</th>
    <th><?php echo "Alamat" ?></th>
    <th><?php echo "Alamat 1" ?></th>
    <th><?php echo "Alamat 2" ?></th>
    <th><?php echo "Alamat 3" ?></th>
    <?php foreach( $records as $index => $record): ?>
    <tr>
        <td><?php echo $index + 1 ?></td>
        <td>
            <?php
            $options = sprintf("<option value='%s'>%s</option><option value='%s'>%s</option><option value='%s'>%s</option><option value='%s'>%s</option>",
                1,
                $record->AL,
                2,
                $record->AL1,
                3,
                $record->AL2,
                3,
                $record->AL3
            );

            /*$href = sprintf('%s@@%s@@%s',
                $record->AL,
                $record->AL2,
                $options
            ); */
            $href = sprintf('%s@@%s@@%s@@%s',
                $record->AL,
                $record->AL1,
                $record->AL2,
                $record->AL3,
                $options
            );
            ?>
            <a href="<?php echo $href ?>" data-dismiss="modal">
                <?php 
                    //echo sprintf("%s %s %s", $record->AL, $record->AL2, $record->AL3) 
                    echo sprintf("%s", $record->AL) 
                ?>
            </a>
        </td>
        <td><?php echo $record->AL1 ?></td>
        <td><?php echo $record->AL2 ?></td>
        <td><?php echo $record->AL3 ?></td> 
    </tr>
    <?php endforeach; ?>
</table>
