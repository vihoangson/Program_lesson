<?php
/**
* Lesson2
* 
*/
class Lesson2
{
	private $sqlite;
	function __construct($sqlite)
	{
		$this->sqlite = $sqlite;
	}

	public function do_it(){
	}

	public function show_form_edit($data=array()){
		?>
		<form action="" method="POST" role="form" enctype="multipart/form-data" id="form_submit">
			<legend>Form title</legend>
			<div class="form-group">
				<label for="input_name">Họ và tên</label>
				<input type="text" name="name_txt" class="form-control" id="input_name" placeholder="Nguyễn Văn A" <?php if($data["name_txt"]?'value="'.$data["name_txt"].'":')?> required>
			</div>
			<div class="form-group">
				<label for="email_txt">Email</label>
				<input type="email" name="email_txt" class="form-control" id="email_txt" placeholder="nguyenvana@gmail.com" <?php if($data["email_txt"]?'value="'.$data["email_txt"].'":')?>>
			</div>
			<div class="form-group">
				<label for="age_txt">Tuổi</label>
				<input type="text" name="age_txt" class="form-control" id="age_txt" placeholder="20" <?php if($data["age_txt"]?'value="'.$data["age_txt"].'":')?> required>
			</div>
			<div class="form-group">
				<label for="m_id">Giới tính</label>
				<input type="radio" name="sex_txt" class="" id="m_id" checked>
				<label for="m_id">Nam</label>
				<input type="radio" name="sex_txt" class="" id="f_id">
				<label for="f_id">Nữ</label>
			</div>
			<div class="form-group">
				<label for="phone_txt">Điện thoại</label>
				<input type="text" name="phone_txt" class="form-control" id="phone_txt" placeholder="0121 885 1144" <?php if($data["phone_txt"]?'value="'.$data["phone_txt"].'":')?> required>
			</div>
			<div class="form-group">
				<label for="finger_tip">Vân tay</label>
				<input type="text" name="finger_txt" class="form-control" id="finger_tip" placeholder="20">
			</div>
			<div class="form-group">
				<label for="note_txt">Ghi chú</label>
				<textarea name="note_txt" id="note_txt" class="form-control"> <?php if($data["note_txt"]?'"'.$data["note_txt"].'":')?></textarea>
			</div>

			<input type="hidden" name="post" value="1">
			<button type="submit" class="btn btn-primary" name="form" value="submit">Lưu dữ liệu (F4)</button>
		</form>
		<?php
	}

	public function show_result(){
		?>
		<div id="box_result">
				<?php
				$result = $this->sqlite->query('SELECT * FROM user ORDER BY user_id desc;');
				$data = $this->sqlite->fetchAll($result);
				?>
				<h2> Dữ liệu đã nhập </h2>
				<table class="table table-hover">
					<thead>
						<tr>
							<th><?php echo "user_id"; ?></th>
							<th><?php echo "user_name"; ?></th>
							<th><?php echo "user_email"; ?></th>
							<th><?php echo "user_age"; ?></th>
							<th><?php echo "user_sex"; ?></th>
							<th><?php echo "user_phone"; ?></th>
							<th><?php echo "user_note"; ?></th>
							<th><?php echo "user_finger"; ?></th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach ($data as $key => $value) {
							?>
							<tr>
								<td><?php echo $value["user_id"]; ?></td>
								<td><?php echo $value["user_name"]; ?></td>
								<td><?php echo $value["user_email"]; ?></td>
								<td><?php echo $value["user_age"]; ?></td>
								<td><?php echo $value["user_sex"]; ?></td>
								<td><?php echo $value["user_phone"]; ?></td>
								<td><?php echo $value["user_note"]; ?></td>
								<td><?php echo $value["user_finger"]; ?></td>
							</tr>
							<?php 
						} ?>

					</tbody>
				</table>
			</div><!-- #box_result -->
		<?php
	}

}
?>