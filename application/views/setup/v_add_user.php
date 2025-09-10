<?php $this->load->view('header');?>
    <section class="content-header">
      <h1>
       <?=$judul?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$judul?></li>
      </ol>
    </section>
	<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?=$judul?></h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header
            <div class="box-body table-responsive no-padding"> -->
			<div class="box-body">
			<form method='post' action="<?=base_url().'index.php/setup/proses_add_user';?>">
				<div class="form-group has-success col-lg-6"  id="c_user_id">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> User Id</label>
                  <input type="text" class="form-control" id="user_id" name='pn_id' value="Automatic" readonly>
                </div>
				<div class="form-group has-success col-lg-6"  id="c_user_name">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> User Name</label>
                  <input type="text" class="form-control" id="user_name" name='pn_uname' placeholder="Masukan user name " value="">
                </div>
				<div class="form-group has-success col-lg-6"  id="c_name">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama</label>
                  <input type="text" class="form-control" id="name" name='pn_name' placeholder="Masukan nama " value="">
                </div>
				<div class="form-group has-success col-lg-6"  id="c_password">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Password</label>
                  <input type="password" class="form-control" id="password" name='pn_pass' placeholder="Masukan password " value="">
                </div>
				<div class="form-group has-success col-lg-6">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Marketing</label>
                  <select name="marketing" class="form-control">
					<option value="Y">Yes</option>
					<option value="N" selected>No</option>
				  </select>
                </div>
				<div class="form-group has-success col-lg-6"  id="c_new_password">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Ketik Ulang Password</label>
                  <input type="password" class="form-control" id="new_password" name='pn_pass_new' value="" placeholder="Ketik ulang password ">
                </div>
				<div class="form-group has-success col-lg-6"  id="c_jabatan">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Jabatan</label>
				  <select class="form-control" id="jabatan" name='pn_jabatan'>
					<?php
						echo "<option value=''>Pilih Jabatan</option>";
						foreach($list_jabatan as $row1){
							echo "<option value='".$row1->id."'>".$row1->nm_jabatan."</option>";
						}
					?>
				  </select>
                </div>
				<div class="form-group has-success col-lg-6"  id="c_">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Cabang</label>
				  <select class="form-control" id="cabang" name='pn_wilayah'>
					<?php
						foreach($list_cabang as $row2){
							if($row2->id){
								echo "<option value='".$row2->id."' selected>".$row2->nm_cabang."</option>";
							}else{
								echo "<option value='".$row2->id."'>".$row2->nm_cabang."</option>";
							}
						}
					?>
				  </select>
                </div>
				<div class="form-group has-success col-lg-6"  id="c_">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Akses</label>
				  <select class="form-control" id="inputSuccess" name='pn_akses'>
					<option value='0' selected>Non-Aktif</option>
					<option value='1' selected>Aktif</option>
				  </select>
                </div>
				<div class="form-group has-success btn-group col-lg-6"></div>
					<div class="form-group has-success col-lg-6"  id="c_">
					<input type="submit" name="submit" value="Save" class='pull-right btn btn-success' onClick="return check();">
					<a href="<?=base_url().'index.php/setup/setup_akses'?>"><button class="pull-right btn btn-default">Cancel</button></a>
				</div>
			</form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
    </section>
	
<?php $this->load->view('footer');?>
<script>
function check(){
	if($("#user_id").val() == ''){
		alert('User ID tidak boleh kosong');
		document.getElementById("user_id").focus();
		return false;
	} else if($("#user_name").val() == ''){
		alert('Silahkan isi user name');
		document.getElementById("user_name").focus();
		return false;
	} else if($("#name").val() == ''){
		alert('Silahkan isi Nama');
		document.getElementById("name").focus();
		return false;
	} else if($("#password").val() == ''){
		alert('Silahkan isi password');
		document.getElementById("password").focus();
		return false;
	} else if($("#new_password").val() == ''){
		alert('Silahkan ketik ulang password');
		document.getElementById("new_password").focus();
		return false;
	} else if($("#password").val() != $("#new_password").val()){
		alert('Password tidak sama');
		document.getElementById("jabatan").focus();
		return false;
	}else if($("#jabatan").val() == ''){
		alert('Silahkan pilih jabatan');
		document.getElementById("new_password").focus();
		return false;
	}
}
</script>