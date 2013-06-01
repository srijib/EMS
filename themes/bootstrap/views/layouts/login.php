<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo app()->theme->baseUrl; ?>/css/login.css" />
    <link rel="shortcut icon" href="<?php echo app()->theme->baseUrl; ?>/images/ico/title.png" type="image/x-icon" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>


</head>

<body>

<div class="wrapper">
    <a href="<?php echo app()->createUrl('/Site/Login');?>"><img id="img_header" src="<?php echo app()->theme->baseUrl; ?>/images/ico/try1.png" alt="Image"></a>
    <hr>

    <div id="login-form">
        <?php echo $content; ?>
    </div><!-- login-fom -->

    <hr>
    <div id="footer">

        <div id="distance2">
            <div id="block-bottom" style="margin-top: 2em;">
                <div class="wrapper">
                    <div class="grid-block" id="toolbar">
                        <div class="float-left">

                            <div class="module  deepest">
                                <ul class="bottom_left">
                                    <li class="databases">
                                        <a title="Glandore Systems" target="_blank" href="http://www.GlandoreSystems.com/" class="mootip">
                                            <strong style="float: left">The POWER to Launch BIG Ideas</strong>
                                        </a>
                                    </li>
                                    <li class="messages">
                                        <a title="Glandore Systems" target="_blank" href="http://www.GlandoreSystems.com/" class="mootip">
                                            <strong style="float: left">Software Innovation Consultancy</strong>
                                        </a>
                                    </li>
                                    <li class="options">
                                        <a title="Glandore Systems" target="_blank" href="http://www.GlandoreSystems.com/" class="mootip">
                                            <strong style="float: left">Generate IDEAS and Formulate BEST Practices</strong>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="float-right">
                            <div class="module  deepest">
                                <ul class="bottom_right">
                                    <li class="users">
                                        <a title="Glandore Human Resource" href="#" class="mootip">
                                            <strong>EMS</strong>
                                        </a>
                                    </li>
                                    <li class="right_info">
                                        Ho Chi Minh City University of Transport
                                    </li>
                                    <li class="right_info">
                                        Employee Management System
                                    </li>
                                    <li class="right_info">
                                        version: v1.0
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- footer -->

</div><!-- page -->
</body>
</html>
