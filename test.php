<style type="text/css">
	body {
		background: rgb(248, 249, 250);
		padding:10px;
	}
	.isi {
		background: #fff;
		border-radius:20px;
		box-shadow: 0 0 3px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
	}
	.isi .files {
		padding:20px;
	}
	.isi .files .dir {
		margin-bottom:2px;
		padding-top:3px;
		padding-bottom:3px;
	}
	.isi .files .file {
		margin-bottom:2px;
		padding-top:3px;
		padding-bottom:3px;
	}
</style>
<body>
	<?php
	function files($type) {
		$array = array();
		foreach (scandir(getcwd()) as $key => $value) {
			$file['name'] = getcwd() . DIRECTORY_SEPARATOR . $value;
			switch ($type) {
				case 'dir':
					if (!is_dir($file['name']) || $value === '.' || $value === '..') continue 2;
					break;
				case 'file':
					if (!is_file($file['name'])) continue 2;
					break;
			}
			$file['names'] = basename($file['name']);
			$array[] = $file;
		} return $array;
	}
	function getext($filename) {
		return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
	}
	function geticon($filename) {
		switch (getext($filename)) {
			case 'php':
				return "php";
				break;
			
			default:
				return "unknown";
				break;
		}
	}
	?>
	<div class="isi">
		<div class="files">
			<?php
			foreach (files('dir') as $key => $dir) { ?>
				<div class="dir">
					<?= $dir['names'] ?>
				</div>
			<?php }
			foreach (files('file') as $key => $file) { ?>
				<div class="file">
					<?= $file['names'] ?>
				</div>
			<?php }
			?>
		</div>
	</div>
</body>
