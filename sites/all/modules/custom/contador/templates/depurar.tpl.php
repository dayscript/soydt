<table>
    <th>Key</th>
    <th>Data</th>
<?php foreach($data as $key=>$row):?>
    <tr>
        <td><?php echo $key?></td>
        <td><pre>
                <?php print_r($row)?>
            </pre></td>
    </tr>
<?php endforeach ?>
</table>