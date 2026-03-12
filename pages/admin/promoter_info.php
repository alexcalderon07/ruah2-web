<?php
// Include your database configuration and functions file here
// For example: require_once 'database.php';

// Search and display promoters
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["search"])) {
	$search_code = filter_input(INPUT_POST, "search_code", FILTER_SANITIZE_STRING);
	if (!empty($search_code)) {
		$promoter = get_promoter_by_code($search_code);
		$invited_people = get_invited_people($promoter['id']);
	}
}

// Function to get a list of people invited by the promoter
function get_invited_people($promoter_id) {
	global $database;
	$stmt = $database->runQuerySqlite("SELECT * FROM referrals_promo WHERE referral_id = :referral_id");
	$stmt->execute(array(':referral_id' => $promoter_id));
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<form method="POST" action="">
	<label for="search_code">Promoter Code:</label>
	<br>
	<input type="text" id="search_code" name="search_code" class="form-control w-75 d-inline-block" required>
	<input type="submit" name="search" value="Search" class="btn-image d-inline-block">
</form>

<?php if (isset($invited_people)) { ?>
	<h2>Invited People by <?php echo htmlspecialchars($search_code); ?></h2>
	<table class="table table-hover">
		<thead class="thead-inverse">
		<tr>
			<th>ID</th>
			<th>Acc ID</th>
			<th>Username</th>
			<th>Register Date</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($invited_people as $person) { ?>
			<tr>
				<td><?php echo $person["id"]; ?></td>
				<td><?php echo $person["user_id"]; ?></td>
				<td><?php echo getAccountName($person["user_id"]); ?></td>
				<td><?php echo $person["date"]; ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?php } ?>

