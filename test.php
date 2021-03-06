<style type="text/css">
	body {
		background: rgb(248, 249, 250);
		padding:10px;
	}
	a {
		color: #000;
		text-decoration: none;
	}
	.isi {
		background: #fff;
		border-radius:20px;
		box-shadow: 0 0 3px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
	}
	.isi .isi2 {
		padding: 20px;
		border-radius:20px;
	}
	.isi .isi2 .filename {
		display: inline-block;
	}
	.isi .isi2 .sizes {
		display: inline-block;
	}
	.isi .isi2 .permission {
		display: inline-block;
	}
	.isi .isi2 .lastupdate {
		display: inline-block;
	}
	.isi .isi2 .action {
		display: inline-block;
	}
	.isi .files {
		padding-top: 20px;
		padding-left: 20px;
		padding-bottom: 20px;
		padding-right: 20px;
	}
	.isi .files .dir {
		display: block;
		margin-bottom:1px;
		border-radius:10px;
		padding-top:3px;
		padding-bottom:3px;
	}
	.isi .files .dir .name {
		display: inline-block;
	}
	.isi .files .dir .name span {
		font-size:20px;
	}
	.isi .files .dir .icon {
		position: relative;
		padding-top:23px;
		padding-left:15px;
		color: transparent;
		display: inline-block;
	}
	.isi .files .dir .info {
		font-size: 90%;
	}
	.isi .files .dir .size {
		display: inline-block;
		color: #666;
	}
	.isi .files .dir .perm {
		display: inline-block;
	}
	.isi .files .file {
		border-radius:10px;
		margin-bottom:2px;
		padding-top:3px;
		padding-bottom:3px;
	}
	.isi .files .file .names {
		display: inline-block;
	}
	.isi .files .file .names .filename {
		background-color: red;
		margin-bottom:18px;
	}
	.isi .files .file .icons {
		position: relative;
		display: inline-block;
	}
	.isi .files .file .icons img {
		width:50px;
		height:50px;
	}
	.isi .files .file .info {
		font-size: 80%;
	}
	.isi .files .file .sizes {
		display: inline-block;
		color: #666;
	}
	.isi .files .file .perms {
		display: inline-block;
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
			$file['size']  = (is_dir($file['name'])) ? countDir($file['name']). " items" : size($file['name']);
			$array[] = $file;
		} return $array;
	}
	function getext($filename) {
		return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
	}
	function cd($directory) {
		return chdir($directory);
	}
	function countDir($filename) {
        return @count(scandir($filename)) -2;
    }
	function size($filename) {
        if (is_file($filename)) {
            $filepath = $filename;
            if (!realpath($filepath)) {
                $filepath = $_SERVER['DOCUMENT_ROOT'] . $filepath;
            }
            $filesize = filesize($filepath);
            $array = array("TB","GB","MB","KB","Byte");
            $total = count($array);
            while ($total-- && $filesize > 1024) {
                $filesize /= 1024;
            } return round($filesize, 2) . " " . $array[$total];
        }
    }
    function geticon($filename) {
        switch (getext($filename)) {
            case 'php1':
            case 'php2':
            case 'php3':
            case 'php4':
            case 'php5':
            case 'php6':
            case 'phtml':
            case 'php':
                print('https://image.flaticon.com/icons/svg/2306/2306154.svg');
                break;
            case 'html':
            case 'htm':
                print('https://image.flaticon.com/icons/svg/2306/2306098.svg');
                break;
            case 'asp':
            case 'aspx':
                print('https://image.flaticon.com/icons/svg/2306/2306019.svg');
                break;
            case 'css':
                print('https://image.flaticon.com/icons/svg/2306/2306041.svg');
                break;
            case 'js':
                print('https://image.flaticon.com/icons/svg/2306/2306122.svg');
                break;
            case 'json':
                print('https://image.flaticon.com/icons/svg/136/136525.svg');
                break;
            case 'xml':
                print('https://image.flaticon.com/icons/svg/2306/2306209.svg');
                break;
            case 'py':
                print('https://image.flaticon.com/icons/svg/617/617531.svg');
                break;
            case 'zip':
                print('https://image.flaticon.com/icons/svg/2306/2306214.svg');
                break;
            case 'rar':
                print('https://image.flaticon.com/icons/svg/2306/2306170.svg');
                break;
            case 'htaccess':
                print('https://image.flaticon.com/icons/png/128/1720/1720444.png');
                break;
            case 'txt':
                print('https://image.flaticon.com/icons/svg/2306/2306185.svg');
                break;
            case 'ini':
                print('https://image.flaticon.com/icons/svg/1126/1126890.svg');
                break;
            case 'mp3':
            case 'm4a':
            case 'wav':
            case 'ogg':
                print('https://image.flaticon.com/icons/svg/2822/2822588.svg');
                break;
            case 'mp4':
                print('https://image.flaticon.com/icons/svg/2822/2822589.svg');
                break;
            case 'log':
                print('https://image.flaticon.com/icons/svg/2306/2306124.svg');
                break;
            case 'dat':
                print('https://image.flaticon.com/icons/svg/2306/2306050.svg');
                break;
            case 'exe':
                print('https://image.flaticon.com/icons/svg/2306/2306085.svg');
                break;
            case 'psd':
                print("https://image.flaticon.com/icons/svg/2306/2306166.svg");
                break;
            case 'apk':
                print('https://1.bp.blogspot.com/-HZGGTdD2niI/U2KlyCpOVnI/AAAAAAAABzI/bavDJBFSo-Q/s1600/apk-icon.jpg');
                break;
            case 'yaml':
                print('https://cdn1.iconfinder.com/data/icons/hawcons/32/698694-icon-103-document-file-yml-512.png');
                break;
            case 'md':
                print("https://image.flaticon.com/icons/svg/2521/2521594.svg");
                break;
            case 'sql':
                print("https://image.flaticon.com/icons/svg/2306/2306173.svg");
                break;
            case 'csv':
                print("https://image.flaticon.com/icons/svg/2306/2306046.svg");
                break;
            case 'xls':
                print("https://image.flaticon.com/icons/svg/2306/2306196.svg");
                break;
            case 'docs':
                print("https://image.flaticon.com/icons/svg/2306/2306060.svg");
                break;
            case 'bak':
                print('https://image.flaticon.com/icons/svg/2125/2125736.svg');
                break;
            case 'ico':
                print('https://image.flaticon.com/icons/svg/1126/1126873.svg');
                break;
            case 'png':
                print('https://image.flaticon.com/icons/svg/2306/2306156.svg');
                break;
            case 'jpg':
            case 'jpeg':
            case 'webp':
                print('https://image.flaticon.com/icons/svg/2306/2306117.svg');
                break;
            case 'svg':
                print('https://image.flaticon.com/icons/svg/2306/2306179.svg');
                break;
            case 'gif':
                print('https://image.flaticon.com/icons/svg/2306/2306094.svg');
                break;
            case 'pdf':
                print('https://image.flaticon.com/icons/svg/2306/2306145.svg');
                break;
            default:
                print('https://image.flaticon.com/icons/svg/833/833524.svg');
                break;
        }
    }

	if (isset($_GET['cd'])) {
		cd($_GET['cd']);
	}
	?>
	<div class="isi">
		<div class="files">
			<?php
			foreach (files('dir') as $key => $dir) { ?>
				<a href="?cd=<?= $dir['name'] ?>">
					<div class="dir">
						<div class="icon" style="background: url(https://image.flaticon.com/icons/svg/715/715676.svg)
						no-repeat;">
							icons
						</div>
						<div class="name">
							<div class="filename">
								<?= $dir['names'] ?>
							</div>
							<div class="info">
								<div class="size">
									<?= $dir['size'] ?>
								</div>
								<div class="perm">
									//permission
								</div>
							</div>
						</div>
					</div>
				</a>
			<?php }
			foreach (files('file') as $key => $file) { ?>
				<div class="file">
					<div class="icons">
						<img src="<?= geticon($file['name']) ?>">
					</div>
					<div class="names">
						<div class="filename">
							<?= $file['names'] ?>
						</div>
						<div class="info">
							<div class="sizes">
								<?= $file['size'] ?>
							</div>
							<div class="perms">
								//permission
							</div>
						</div>
					</div>
				</div>
			<?php }
			?>
		</div>
	</div>
</body>
