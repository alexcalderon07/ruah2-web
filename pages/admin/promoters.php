<?php
// Include your database configuration and functions file here
// For example: require_once 'database.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
	// Validate and sanitize user input (you can add more validation)
	$code = filter_input(INPUT_POST, "code", FILTER_SANITIZE_STRING);
	//check if the code already exists
	$existingPromoter = get_promoter_by_code($code);
	if ($existingPromoter) {
		echo "<div class='alert alert-danger'>The code already exists.</div>";
	} else
	if (!empty($code)) {
		// Insert the promoter
		insert_promoter($code);
	}
}

//Handle the promoter update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"])) {
	// Validate and sanitize user input (you can add more validation)
	$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
	$code = filter_input(INPUT_POST, "code", FILTER_SANITIZE_STRING);

	$existingPromoter = get_promoter_by_code($code);
	if ($existingPromoter && (!isset($_POST["update"]) || $existingPromoter["id"] != $id)) {
		echo "<div class='alert alert-danger'>The code already exists.</div>";
	} else if (!empty($id) && !empty($code)) {
		// Update the promoter
		update_promoter($id, $code);
	}
}

//Handle the promoter delete
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
	// Validate and sanitize user input (you can add more validation)
	$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

	if (!empty($id)) {
		// Delete the promoter
		delete_promoter($id);
	}
}

?>

<form method="POST" action="" class="mb-5">
	<label for="code">Promoter Code:</label>
	<br>
	<input type="text" id="code" name="code" class="form-control w-75 d-inline-block" required>
	<input type="submit" name="submit" value="Insert" class="btn-image d-inline-block">
</form>

<?php
// Handle promoter deletion
if (isset($_GET["delete"])) {
	$promoterId = filter_input(INPUT_GET, "delete", FILTER_VALIDATE_INT);
	if ($promoterId) {
		delete_promoter($promoterId);
	}
}

// Display all promoters
$promoters = get_promoters();
?>

<table class="table table-hover">
	<thead class="thead-inverse">
		<tr>
			<th>ID</th>
			<th>Code</th>
			<th>Invited</th>
			<th>Full List</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($promoters as $promoter) { ?>
			<tr>
				<td><?php print $promoter["id"]; ?></td>
				<td>
					<form method="POST" action="">
						<input type="hidden" name="id" value="<?php print $promoter["id"]; ?>">
						<input type="text" name="code" value="<?php print $promoter["code"]; ?>" class="form-control w-50 d-inline-block">
						<input type="submit" name="update" value="Update" class="btn-image d-inline-block">
					</form>
				</td>
				<td><?php print $promoter["referral_count"]; ?></td>
				<td>
					<form method="POST" action="/admin/promoter_info">
						<input type="hidden" name="search_code" value="<?php print $promoter['code'];?>">
						<input type="submit" name="search" value="Search" class="btn-image d-inline-block">
					</form>
				</td>
				<td>
					<form method="POST" action="">
						<input type="hidden" name="id" value="<?php print $promoter["id"]; ?>">
						<input type="submit" name="delete" value="Delete" class="btn-image d-inline-block">
					</form>
				</td>
			</tr>
		<?php } ?>

	</tbody>
</table>
