<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>	
	<title>Admin</title>
	
	<?php if (isset($css)) : ?>
		<?php foreach ($css as $each) : ?>
			<link rel="stylesheet" type="text/css" href="<?=base_url() . $each?>" />
		<?php endforeach ?>
	<?php endif ?>

	<!--[if lt IE 8]><style type="text/css" media="all">@import url("/css/ie.css");</style><![endif]-->

	<?php if (isset($js)) : ?>
		<?php foreach ($js as $each) : ?>
            <script type="text/javascript" src="<?=base_url()?>js/<?=$each?>"></script>
		<?php endforeach ?>
    <?php endif ?>
    
    <script type="text/javascript" src="<?=base_url()?>js/backend.js?<?=rand()?>"></script>

</head>

<body>
	
	<div id="hld">
	
		<div class="wrapper">	<!-- wrapper begins -->
        		
            <div id="header">
                <div class="hdrl"></div>
                <div class="hdrr"></div>
                
                <h1><a href="http://enstyled.com/adminus/original/page.html#">Adminus</a></h1>
                
                <ul id="nav">
                    <li><a href="http://enstyled.com/adminus/original/page.html#">Dashboard</a></li>
                    <li class="active"><a href="http://enstyled.com/adminus/original/page.html#">Pages</a>
                        <ul>
                            <li><a href="http://enstyled.com/adminus/original/page.html#">List pages</a></li>
                            <li><a href="http://enstyled.com/adminus/original/page.html#">Add page</a></li>
                            <li><a href="http://enstyled.com/adminus/original/page.html#">More actions</a>
                                <ul>
                                    <li><a href="http://enstyled.com/adminus/original/page.html#">Some action</a></li>
                                    <li><a href="http://enstyled.com/adminus/original/page.html#">Some action</a></li>
                                    <li><a href="http://enstyled.com/adminus/original/page.html#">Some action</a>
                                        <ul>
                                            <li><a href="http://enstyled.com/adminus/original/page.html#">Some action</a></li>
                                            <li><a href="http://enstyled.com/adminus/original/page.html#">Some action</a></li>
                                            <li><a href="http://enstyled.com/adminus/original/page.html#">Some action</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="http://enstyled.com/adminus/original/page.html#">Posts</a></li>
                    <li><a href="http://enstyled.com/adminus/original/page.html#">Media</a>
                        <ul>
                            <li><a href="http://enstyled.com/adminus/original/page.html#">List media</a></li>
                            <li><a href="http://enstyled.com/adminus/original/page.html#">Add media</a></li>
                            <li><a href="http://enstyled.com/adminus/original/page.html#">Something else</a></li>
                        </ul>
                    </li>
                    <li class="nobg"><a href="http://enstyled.com/adminus/original/page.html#">Users</a></li>
                </ul>
                
                <p class="user">Logged in as, <?php echo $this->session->userdata('backend')->email?> | <a href="<?php echo site_url('admin/password')?>">Password</a> | <a href="<?php echo site_url('admin/logout')?>">Logout</a></p>
            </div>		<!-- #header ends -->
        		
        <div class="block">

            <div class="block_head">
                <div class="bheadl"></div>
                <div class="bheadr"></div>
                
                <h2><?php echo $heading?></h2>
                
            </div>	<!-- .block_head ends -->
            
            <div class="block_content">
            
                <p class="breadcrumb"><a href=".">Dashboard</a> &raquo; <a href=".">Manage users</a> &raquo; <strong>Create supplier</strong></p>
                <?php if($this->session->flashdata('success')) : // success msg ?>
                    <div class="message success">
                        <?php echo $this->session->flashdata('success') ?>					
                    </div>
                <?php endif ?>
                
                <?php if(isset($has_error)) : // error msg ?>
                    <div class="message errormsg">
                        Please fix all error(s) before re-submitting.					
                    </div>
                <?php endif ?>
				
                <!-- end header -->