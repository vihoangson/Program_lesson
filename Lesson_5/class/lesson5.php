<?php
/**
* Lesson5
* 
*/
class Lesson5
{
	private $sqlite;
	function __construct($sqlite)
	{
		$this->sqlite = $sqlite;
	}

	public function do_edit(){
		$id = $_POST["id"];
		$result = $this->sqlite->query('SELECT * FROM user WHERE user_id='.$id.' ORDER BY user_id desc;');
		$data = $this->sqlite->fetchAll($result);
		$this->show_form_edit($data[0]);
		die;
	}

	public function show_form_edit($data=array()){
		?>
		<form action="" method="POST" role="form" enctype="multipart/form-data" class="form_submit">
			<legend>Thông tin khách hàng</legend>
			<?php echo($data["user_id"]?'<input value="'.$data["user_id"].'" type="hidden" name="id_txt" >':"");?>
			<div class="form-group">
				<label for="input_name">Họ và tên</label>
				<input type="text" name="name_txt" class="form-control" id="input_name" placeholder="Nguyễn Văn A" <?php echo($data["user_name"]?'value="'.$data["user_name"].'"':"");?> required>
			</div>
			<div class="form-group">
				<label for="email_txt">Email</label>
				<input type="email" name="email_txt" class="form-control" id="email_txt" placeholder="nguyenvana@gmail.com" <?php echo($data["user_email"]?'value="'.$data["user_email"].'"':"");?>>
			</div>
			<div class="form-group">
				<label for="age_txt">Tuổi</label>
				<input type="text" name="age_txt" class="form-control" id="age_txt" placeholder="20" <?php echo($data["user_age"]?'value="'.$data["user_age"].'"':"");?> required>
			</div>
			<div class="form-group">
				<label for="m_id">Giới tính</label>
				<input type="radio" name="sex_txt" class="" id="m_id" value="male" <?php if(($data["user_sex"]==""||$data["user_sex"]=="male")?'checked':"");?>>
				<label for="m_id">Nam</label>
				<input type="radio" name="sex_txt" class="" id="f_id" value="female" <?php echo($data["user_sex"]?'checked':"");?>>
				<label for="f_id">Nữ</label>
			</div>
			<div class="form-group">
				<label for="phone_txt">Điện thoại</label>
				<input type="text" name="phone_txt" class="form-control" id="phone_txt" placeholder="0121 885 1144" <?php echo($data["user_phone"]?'value="'.$data["user_phone"].'"':"");?> required>
			</div>
			<div class="form-group">
				<label for="finger_tip">Vân tay</label>
				<input type="text" name="finger_txt" class="form-control" id="finger_tip" placeholder="20">
			</div>
			<div class="form-group">
				<label for="note_txt">Ghi chú</label>
				<textarea name="note_txt" id="note_txt" class="form-control"><?php echo($data["user_note"]?$data["user_note"]:"");?></textarea>
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
							<th></th>
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
								<td>
									<button onclick="edit_user($(this));" data-id="<?php echo $value["user_id"]; ?>">Edit</button> 
									|
									Delete
								</td>
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