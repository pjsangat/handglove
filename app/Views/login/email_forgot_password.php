<table width="800" style="font-size: 16px; line-height: 1.5">
    <tr>
        <td style="width: 100px;"><img src="<?php echo base_url('assets/img/handglove-logo.png'); ?>" alt="" width="100"></td>
        <td valign="middle">
            <h1 style="margin: 0";>HANDGLOVE</h1>
            <div>Password Reset</div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <br><br>
            Dear <?php echo $item['first_name'] ?>,<br><br>
            We have received a request to reset the password of your account.
            <br><br>
            <?php echo $item['link']; ?>
            <br><br><br>
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <em>Note that this link will only be valid for 24 hours.</em><br>
            <em>If you do not want to reset your password, please ignore this message. Your password will not be changed.</em><br><br><br>
            Best regards,<br>
            Handglove
        </td>
    </tr>

</table>

