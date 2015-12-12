<div class='row col-lg-12'>
<div class="login_pan">
<?php
echo form_open('user/login','class="form" role="form"');
echo form_fieldset();
?>
<?php
$flash_message = $this->session->flashdata('flash_message');

if ($flash_message != '')
{
    echo "<div class=\"error custom_error\">".$flash_message."</div>";
}
else
{
    if (isset($message))
    {
        echo "<div class=\"error custom_error\">".$message."</div>";
    }
}
?>

<div class="form-group">
    <legend><?php echo lang('label_login') ?> </legend>
    <div>
        <label><?php echo lang('label_username') ?></label>
        <?php
        $data = array(
            'name' => 'username',
            'maxlength' => 20,
        );
        echo form_input('username', null, 'class="form-control"');
        ?>
    </div>
    <div>
        <label><?php echo lang('label_password') ?></label>
        <?php
        $data = array(
            'name' => 'username',
            'maxlength' => 20,
        );

        echo form_password('password', null, 'class="form-control"') ;
        ?>
    </div>
    <div>
        <label><?php echo lang('label_database') ?></label>
        <?php
        $options = array(
            'MKD',
            'MKD_70',
            'IEI',
            'IEI_TEST',
            'IEI_TRIAL',
        );
        $data = array(
            'name' => 'username',
            'maxlength' => 20,
        );

        echo form_dropdown('database_url', $options, null, 'class="form-control"') ;
        ?>
    </div>
    <div class="">&nbsp;</div>
    <div class="">
        <?php echo form_submit('submit','Submit','class="btn btn-primary  "'); ?>
        <a href="<?php echo base_url('user/forgot_password') ?>" class="btn btn-primary"><?php echo lang('ForgotPassword') ?></a>
    </div>
</div>

<?php
echo form_fieldset_close();
?>
<div>&nbsp;</div>
</div>
</div>
</div>
<style>
.login_pan { width: 400px; height:450px; /*position: fixed;*/  margin-top: 20%; /*color: white;*/ margin-left:auto; margin-right:auto;}
.login_pan form {
    margin-left: auto;
    margin-right: auto;
    float: inherit;
    width: 100%;
    //background-color: #7AA;
    height: 100%;
    border-radius: .5em;
}
.login_pan .form-group { padding-right: 0px !important;}
.login_pan form legend { height: 80px; width: 100%; padding-top: 15px; font-weight: bold; font-size: 38px; }
.login_pan .form-group { padding: 0px 15px;}

@media (max-width:768px){

.login_pan { float:left; width: 100%; height:350px; top: 5%; left:0; color: white;}
}
</style>
