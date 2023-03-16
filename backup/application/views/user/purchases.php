<?php if($this->session->flashdata('error')){ ?>
    <div class="text-danger border-message valid-error">
        <strong><?= $this->lang->line('error'); ?></strong> <?= $this->session->flashdata('error'); ?>
    </div>
<?php } ?>

<?php if($this->session->flashdata('success')){ ?>
    <div class="text-success border-message valid-error">
        <strong><?= $this->lang->line('success'); ?></strong> <?= $this->session->flashdata('success'); ?>
    </div>
<?php } ?>

<table id="purchases1" class="table">
    <thead>
        <tr>
            <th><?= $this->lang->line('order_id'); ?></th>
            <th><?= $this->lang->line('project_name'); ?></th>
            <th><?= $this->lang->line('total_amount'); ?></th>
            <th><?= $this->lang->line('total_time'); ?></th>
            <th><?= $this->lang->line('transaction_id'); ?></th>
            <th><?= $this->lang->line('payment_status'); ?></th>
            <th><?= $this->lang->line('order_created'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php if(isset($purchases)): foreach ($purchases as $key => $value): ?>
        <tr>
            <td><?= $value['id']; ?></td>
            <td>
                <?php if($value['payment_status'] == 1): ?>
                    <a href="<?= base_url('dashboard?oid=') . $value['id']; ?>"><?= $value['project_name']; ?></a>
                <?php else: ?>
                    <?= $value['project_name']; ?>
                <?php endif; ?>
            </td>
            <td><?= number_format($value['grand_total'], 0, ".", ","); ?></td>
            <td><?= $value['total_time']; ?></td>
            <td><?= $value['trans_id']; ?></td>
            <td><?= ($value['payment_status'] == 1) ? $this->lang->line('completed') : $this->lang->line('pending'); ?></td>
            <td><?= $value['created_on']; ?></td>

        </tr>
    <?php endforeach; endif; ?>
        
    </tbody>
</table>

<script type="text/javascript">
$(document).ready(function() {
    <?php if($language == 'arabic'): ?>
        var table = $('#purchases1').DataTable( {
            responsive: true,
            autoWidth: false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Arabic.json"
            },
            "order": [[ 6, "desc" ]]
        });
    <?php else: ?>
        var table = $('#purchases1').DataTable( {
            responsive: true,
            autoWidth: false,
            "order": [[ 6, "desc" ]]
        });
    <?php endif; ?>
    table.columns.adjust().draw();
});
</script>

