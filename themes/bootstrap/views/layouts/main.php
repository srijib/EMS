<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo app()->theme->baseUrl; ?>/css/styles.css" />
    <link rel="shortcut icon" href="<?php echo app()->theme->baseUrl; ?>/images/ico/title.png" type="image/x-icon" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>


</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                /*
                array('label'=>'Home', 'url'=>array('/site/index')),
                array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>app()->user->isGuest),
                array('label'=>'Logout ('.app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!app()->user->isGuest)
                */
                array(
                    'label'=>'Home',
                    'url'=>array('/Site/Index')
                ),
                array(
                    //'label'=>'Profile',
                    //'url'=>array('/Profile/Admin'),
                    //'visible'=>(app()->user->role =='admin' || app()->user->role =='manager' || app()->user->role =='leader')
                ),
                array(
                    //'label'=>'User',
                    //'url'=>array('/User/Index'),
                    //'visible'=>(webapp()->user->role =='admin' || webapp()->user->role =='manager' || webapp()->user->role =='leader')
                ),
            ),
        ),
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                //array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>webapp()->user->isGuest),
                /*array('label'=>app()->user->name, 'url'=>'#', 'items'=>array(
                    array('label'=>'Upload Avatar', 'url'=>'#'),
                    array('label'=>'Change Password', 'url'=>array('/User/Changepassword')),
                    array('label'=>'Logout', 'url'=>array('/Site/Logout'), 'visible'=>!app()->user->isGuest)
                )),*/
            ),
        ),
    ),
)); ?>

<div class="container">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

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
