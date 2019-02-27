</select>時
<select id="start_min" name="start_min">
<?php
	foreach ($mins as $value => $name) {
		if (strcmp($start_min, $value) == 0) {
			echo "<option value='" . $value . "' selected>" . $name . "</option>\n";
		} else {
			echo "<option value='" . $value . "'>" . $name . "</option>\n";
		}
	}
?>
</select>