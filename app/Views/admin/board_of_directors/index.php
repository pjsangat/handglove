<?php echo $this->extend('admin/includes/layout') ?>

<?php echo $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="heading d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Board of Advisors</h2>
                <div class="kicker-bottom">Manage Board of Advisors</div>
            </div>
            <a href="<?= base_url('admin/board-of-directors/create') ?>" class="btn thm-btn">Add Advisor</a>
        </div>

        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <table class="table table-striped table-hover" id="board-table">
                    <thead>
                        <tr>
                            <th>Picture</th>
                            <th>Company</th>
                            <th>CEO Name</th>
                            <th>Position</th>
                            <th>Title</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection() ?>

<?php echo $this->section('customJS') ?>
<script type="text/javascript">
    $(document).ready(function() {
        // Initialize DataTable
        $("#board-table").DataTable({
            "processing": true,
            "ajax": {
                "url": "<?= base_url('admin/board-of-directors/list') ?>",
                "type": "POST",
                "data": function(d) {
                    d[csrfName] = "<?= csrf_hash() ?>";
                }
            },
            "order": [[1, "asc"]],
            "columnDefs": [
                { "orderable": false, "targets": [0, 5] } // Disable sorting on Picture and Actions
            ]
        });
    });
</script>
<?php echo $this->endSection() ?>
