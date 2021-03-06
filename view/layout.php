<?php
if (!isset($_ENV['site_name'])) {
    $filename=ROOT."app/.env";
    if (file_exists($filename)) {
        $dotenv = new Dotenv\Dotenv(ROOT."app");
        $dotenv->load();
        $dbConfig=require_once ROOT."db.php";
        $Migration=new Basic\Migration($dbConfig);
    } else {
        die("cp example.env app/.env");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php print $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/asset/bower_components/1k/dist/1k.min.css?2.0.9">
    <link rel="stylesheet" href="/asset/css/main.css?0.4.4">
    <link rel="stylesheet" href="/asset/fancybox/jquery.fancybox-1.3.4.css?0.1.0" type="text/css" media="screen" />
    <script src="/asset/js/jquery1.4.min.js?0.1.0"></script>
    <script src="/asset/js/main.js?0.1.1"></script>
    <script type="text/javascript" src="/asset/fancybox/jquery.fancybox-1.3.4.pack.js?0.1.0"></script>
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="/feed/" />
    <meta property="og:site_name" content="<?php print $_ENV['site_name']; ?>">
    <meta property="og:title" content="<?php print $title; ?>">
    <link rel="apple-touch-icon" href="/file/logo180.png" sizes="180x180">
    <link rel="icon" href="/file/logo32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/file/logo16.png" sizes="16x16" type="image/png">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@<?php print $_ENV['twitter_site'];?>" />
    <meta name="twitter:creator" content="@<?php print $_ENV['twitter_creator'];?>" />
    <meta name="twitter:title" content="<?php print $title; ?>" />
    <meta property="fb:admins" content="<?php print $_ENV['fb_admin']; ?>"/>
    <meta property="og:url" content="<?php
    if (isset($post)) {
        $url=$_ENV['site_url'].'/posts/'.$post['slug'].'/'.$post['id'];
    } else {
        $url=$_ENV['site_url'];
    }
    print $url;
    ?>">
    <?php
    if (isset($post)) {
        $description=$post['description'];
    } else {
        $description=$_ENV['site_description'];
    }?><meta property="og:description" content="<?php print $description;?>">
    <meta name="twitter:description" content="<?php print $description;?>" />
    <?php
    if (isset($post['cover']) && !empty($post['cover'])) {
        $cover=$_ENV['site_url'].$post['cover'];
    } else {
        $cover=$_ENV['site_url'].$_ENV['site_logo'];
    }?><meta property="og:image" content="<?php print $cover;?>">
    <meta name="twitter:image" content="<?php print $cover;?>" />
</head>
<body>
    <div class="c">
        <div class="r">
            <div class="g12 center">
                <a href="/"><h1><?php print $_ENV['site_name'];?></h1></a>
            </div>
        </div>
        <div class="r">
            <div class="g3 center">
                <p><small class="hamburguer">
                    &#x2630; Menu
                </small></p>
                <script>
                var hide=true;
                function showMenu(){
                    if(hide){
                        hide=false;
                        $('.hamburguer').html('X Menu');
                    }else{
                        hide=true;
                        $('.hamburguer').html('&#x2630; Menu');
                    }
                    $('#menuPrincipal').toggle();
                }
                $('.hamburguer').click(function(){
                    if($( document ).width()<1024){
                        showMenu();
                    }
                });
                </script>
                <ul id="menuPrincipal" class="lista">
                    <li><a href="/">Início</a></li>
                    <li><a href="/feed">RSS</a></li>
                    <?php
                    if (isset($user) && is_array($user)) {
                        $view->out('inc/leftAuthPrivate', $data);
                    } else {
                        $view->out('inc/leftAuthPublic', $data);
                    }
                    ?>
                </ul>
            </div>
            <?php
            print '<div class="g9">'.$content.'</div>';
            ?>
        </div>
        <div class="r">
            <div class="g12 center">
                <small>O código fonte deste blog está no <a href="https://github.com/hackergaucho/blog">Github</a></small>
            </div>
        </div>
    </div><!--.c-->
</body>
</html>
