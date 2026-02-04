<div id="profile-banner" class="mb-4">
    <div class="container">
        <div class="profile pb-4 pt-4">
            <div class="profile-details">
                <div class="profile-name">
                    <h1>Notification Center</h1>
                    <p class="text-white">Stay updated with your latest activities and requests.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="profile-bios">
    <div class="container">
        <div class="row">
            <div id="profile-sidebar" class="col-lg-3 col-md-12 col-sm-12 col-12">
                <ul class="facility_nav">
                    <li class="active"><a href="javascript:void(0)">All Notifications</a></li>
                    <li><a href="javascript:void(0)" id="filter-unread">Unread Only</a></li>
                </ul>                
            </div>

            <div id="profile-main" class="col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0 font-weight-bold">Recent Notifications</h5>
                        <a href="javascript:void(0);" id="manage-mark-all-read" class="btn btn-sm thm-btn">Mark all as read</a>
                    </div>
                    <div class="card-body p-0">
                        <div id="notification-management-list">
                            <?php if (empty($notifications)): ?>
                                <div class="p-5 text-center text-muted">
                                    <i class="fa fa-bell-slash fa-3x mb-3 opacity-2"></i>
                                    <p>No notifications found.</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($notifications as $noti): ?>
                                    <?php 
                                        $unreadClass = $noti['is_read'] == 0 ? 'unread' : '';
                                        $icon = 'fa-bell';
                                        switch($noti['type']) {
                                            case 'registration': $icon = 'fa-user-plus'; break;
                                            case 'approval': $icon = 'fa-check'; break;
                                            case 'shift': $icon = 'fa-calendar'; break;
                                        }
                                    ?>
                                    <div class="notification-item-manage d-flex align-items-center p-3 border-bottom <?= $unreadClass ?>" data-id="<?= $noti['id'] ?>">
                                        <div class="notification-avatar-container mr-3">
                                            <img src="<?= base_url('assets/img/blank-img.png') ?>" class="notification-avatar" alt="User">
                                            <div class="notification-type-badge bg-primary">
                                                <i class="fa <?= $icon ?>"></i>
                                            </div>
                                        </div>
                                        <div class="notification-content flex-grow-1">
                                            <div class="notification-title mb-1">
                                                <strong><?= $noti['title'] ?></strong>: <?= $noti['message'] ?>
                                            </div>
                                            <div class="notification-time text-muted small">
                                                <?= date('M d, Y h:i A', strtotime($noti['created_at'])) ?>
                                            </div>
                                        </div>
                                        <?php if ($noti['is_read'] == 0): ?>
                                            <div class="unread-dot-manage ml-3"></div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Management-specific styles to complement notifications.scss */
.notification-item-manage {
    transition: background-color 0.2s;
    text-decoration: none;
    cursor: pointer;
}
.notification-item-manage:hover {
    background-color: #F8F9FA;
}
.notification-item-manage.unread {
    background-color: #f0f7ff;
}
.notification-item-manage.unread:hover {
    background-color: #e6f1ff;
}
.unread-dot-manage {
    width: 12px;
    height: 12px;
    background-color: #0084FF;
    border-radius: 50%;
}
#profile-banner {
    background: var(--thm-base);
    color: white;
}
.facility_nav li.active a {
    background: var(--thm-base);
    color: white;
}
#profile-sidebar .facility_nav {
    list-style: none;
    padding: 0;
    border: 1px solid #eee;
    border-radius: 8px;
    overflow: hidden;
}
#profile-sidebar .facility_nav li a {
    display: block;
    padding: 12px 20px;
    color: #333;
    border-bottom: 1px solid #eee;
}
#profile-sidebar .facility_nav li:last-child a {
    border-bottom: none;
}
</style>

<script>
$(document).ready(function() {
    // Reuse existing notification events if possible, or add specific ones
    $('#manage-mark-all-read').on('click', function() {
        $.post('<?= base_url('notifications/mark_all_read') ?>', function() {
            location.reload();
        });
    });

    $('.notification-item-manage').on('click', function() {
        const id = $(this).data('id');
        const $this = $(this);
        if ($this.hasClass('unread')) {
            $.post('<?= base_url('notifications/mark_read') ?>/' + id, function() {
                $this.removeClass('unread');
                $this.find('.unread-dot-manage').remove();
            });
        }
    });

    $('#filter-unread').on('click', function() {
        $('.notification-item-manage:not(.unread)').hide();
        $(this).parent().addClass('active').siblings().removeClass('active');
    });
});
</script>
