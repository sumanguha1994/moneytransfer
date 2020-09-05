<?php include('layout_master/header.php'); ?>
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">Change Password </h3>
		</div>
	</div>
</div>
<!-- end:: Subheader -->
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="row">
		<div class="col-xl-8 col-lg-12 order-lg-1 order-xl-1">
			<div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
				<div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title"></h3>
					</div>
				</div>
				<div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="container">
                            <?php if(!empty($this->session->flashdata('succ'))): ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('succ')?>
                            </div>
                            <?php endif; ?>
                        <form action="<?= base_url('chnage-pass-form')?>" method="post">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6>Password Change Form</h6>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Old Password</label>
                                    <input type="text" name="oldpass" id="oldpass" placeholder="Enter Your Old Password" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <label for="">New Password</label>
                                    <input type="text" name="newpass" id="newpass" placeholder="Enter Your New Password" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <label for="">Confirm Password</label>
                                    <input type="text" name="confirmpass" id="confirmpass" placeholder="Confirm Your New Password" class="form-control">
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Chnage</button>
                                </div>
                            </div>
                        </form>
                        <br />
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<script id="custom-code">
	$(document).ready(function(){
		$('#tbldata').DataTable({"bInfo": false, "searching": true,"bLengthChange": false});
	});
    setTimeout(() => {
        $('.alert-success').hide();
    }, 3000);
</script>
<!-- end:: Content -->
<?php include('layout_master/footer.php'); ?>