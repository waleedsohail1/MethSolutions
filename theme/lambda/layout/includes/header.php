<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Parent theme: Bootstrapbase by Bas Brands
 * Built on: Essential by Julian Ridden
 *
 * @package   theme_lambda
 * @copyright 2016 redPIthemes
 *
 */

$login_link = theme_lambda_get_setting('login_link');
$login_custom_url = theme_lambda_get_setting('custom_login_link_url');
$login_custom_txt = theme_lambda_get_setting('custom_login_link_txt');
$home_button = theme_lambda_get_setting('home_button');
$shadow_effect = theme_lambda_get_setting('shadow_effect');
$auth_googleoauth2 = theme_lambda_get_setting('auth_googleoauth2');
$haslogo = (!empty($PAGE->theme->settings->logo));
$hasheaderprofilepic = (empty($PAGE->theme->settings->headerprofilepic)) ? false : $PAGE->theme->settings->headerprofilepic;
$moodle_global_search = 0;

$checkuseragent = '';
if (!empty($_SERVER['HTTP_USER_AGENT'])) {
    $checkuseragent = $_SERVER['HTTP_USER_AGENT'];
}
$username = get_string('username');
if (strpos($checkuseragent, 'MSIE 8')) {$username = str_replace("'", "&prime;", $username);}
?>

<?php if($PAGE->theme->settings->socials_position==1) { ?>
    	<div class="container-fluid socials-header"> 
    	<?php require_once(dirname(__FILE__).'/socials.php');?>
        </div>
<?php
} ?>

    <header id="page-header" class="clearfix">
       
    <div class="container-fluid">    
    <div class="row-fluid">
    <!-- HEADER: LOGO AREA -->
        	
            <?php if (!$haslogo) { ?>
            	<div class="span6">
                	<div class="title-text">
              		<h1 id="title"><?php echo $SITE->fullname; ?></h1>
                    </div>
                </div>
            <?php } else { ?>
            	<div class="span6">
                <div class="logo-header">
                	<a class="logo" href="<?php echo $CFG->wwwroot; ?>" title="<?php print_string('home'); ?>">
                    <?php 
					echo html_writer::empty_tag('img', array('src'=>$PAGE->theme->setting_file_url('logo', 'logo'), 'class'=>'img-responsive', 'alt'=>'logo'));
					?>
                    </a>
                </div>
                </div>
            <?php } ?>      	
            
            <div class="span6 login-header">
            <div class="profileblock">
            
            <?php 
	function get_content () {
	global $USER, $CFG, $SESSION, $COURSE;
	$wwwroot = '';
	$signup = '';}

	if (empty($CFG->loginhttps)) {
		$wwwroot = $CFG->wwwroot;
	} else {
		$wwwroot = str_replace("http://", "https://", $CFG->wwwroot);
	}

		if (!isloggedin() or isguestuser()) {
			
			$login_link_url = '';
			$login_link_txt = '';
			if ($login_link=='1') {$login_link_url = $wwwroot.'/login/signup.php'; $login_link_txt = get_string('startsignup');}
			else if ($login_link=='2') {$login_link_url = $wwwroot.'/login/forgot_password.php'; $login_link_txt = get_string('forgotten');}
			else if ($login_link=='3') {$login_link_url = $wwwroot.'/login/index.php'; $login_link_txt = get_string('moodle_login_page','theme_lambda');}
			if ($login_custom_url != '') {$login_link_url = $login_custom_url;}
			if ($login_custom_txt != '') {$login_link_txt = $login_custom_txt;}

			$moodle_release = $CFG->version; // oauth2 Moodle core
			if (($moodle_release >= 2017051500) && ($auth_googleoauth2)) {
					$authsequence = get_enabled_auth_plugins(true);
            		$potentialidps = array();
            		foreach ($authsequence as $authname) {
                		$authplugin = get_auth_plugin($authname);
                		$potentialidps = array_merge($potentialidps, $authplugin->loginpage_idp_list($this->page->url->out(false)));
            		}
            		if (!empty($potentialidps)) { ?>
                		<div class="potentialidps">
                			<h6><?php echo get_string('potentialidps', 'auth') ?></h6>
                			<div class="potentialidplist">
                			<?php foreach ($potentialidps as $idp) { ?>
                    			<div class="potentialidp">
                    			<a class="btn btn-oauth2" href="<?php echo $idp['url']->out(); ?>" title="<?php echo s($idp['name']); ?>">
                    			<?php if (!empty($idp['iconurl'])) { ?>
                        			<img src="<?php echo s($idp['iconurl']); ?>" width="24" height="24" class="m-r-1"/>
                    			<?php } ?>
                    			<?php echo s($idp['name']); ?></a></div>
                			<?php } ?>
                			</div>
                		</div>
                        <div style="clear:both;"></div>
                		<div class="forgotpass oauth2">
        					<?php 
							if ($login_link_url != '' and $login_link_txt != '') { ?>
								<a target="_self" href="<?php echo $login_link_url; ?>"><?php echo $login_link_txt; ?></a>
            				<?php } ?> 
						</div>
            		<?php }
			} 
			else if (($auth_googleoauth2) && (file_exists($CFG->dirroot . '/auth/googleoauth2/lib.php'))) { // oauth2 plugin
        		require_once($CFG->dirroot . '/auth/googleoauth2/lib.php'); auth_googleoauth2_display_buttons(); ?>
                <div style="clear:both;"></div>
                <div class="forgotpass oauth2">
        			<?php 
					if ($login_link_url != '' and $login_link_txt != '') { ?>
						<a target="_self" href="<?php echo $login_link_url; ?>"><?php echo $login_link_txt; ?></a>
            		<?php } ?> 
				</div>
			<?php } else { ?>
        
				<form class="navbar-form pull-right" method="post" action="<?php echo $wwwroot; ?>/login/index.php?authldap_skipntlmsso=1">
					<div id="block-login">
					<div id="user"><i class="fa fa-user"></i></div>
                    <label for="inputName" class="lambda-sr-only"><?php echo $username; ?></label>
					<input id="inputName" class="span2" type="text" name="username" placeholder="<?php echo $username; ?>">
					<div id="pass"><i class="fa fa-key"></i></div>
                    <label for="inputPassword" class="lambda-sr-only"><?php echo get_string('password'); ?></label>
                    <input id="inputPassword" class="span2" type="password" name="password" id="password" placeholder="<?php echo get_string('password'); ?>">
					<button type="submit" id="submit"><span class="lambda-sr-only"><?php echo get_string('login'); ?></span></button>
					</div>
        
        			<div class="forgotpass">
        			<?php 
					if ($login_link_url != '' and $login_link_txt != '') { ?>
						<a target="_self" href="<?php echo $login_link_url; ?>"><?php echo $login_link_txt; ?></a>
            		<?php } ?> 
					</div>
        
				</form>
			<?php } ?>
 
	<?php } else {

 		echo '<div id="loggedin-user">';		
		echo $OUTPUT->navbar_plugin_output();
		echo $OUTPUT->user_menu();
		echo $OUTPUT->user_picture($USER, array('size' => 80, 'class' => 'welcome_userpicture'));		
		echo '</div>';

	}?>

	</div>
    </div>
            
    </div>
    </div>
               
</header>

<header role="banner" class="navbar">
    <nav role="navigation" class="navbar-inner">
        <div class="container-fluid">
            <?php
                if ($home_button == 'shortname') { 
                    $home_button_string = '<a class="brand" href="'.$CFG->wwwroot.'">'.$SITE->shortname.'</a>'; 
                }
                else if ($home_button == 'frontpage') { 
                    $home_button_string = '<a class="brand" href="'.$CFG->wwwroot.'">'.get_string('frontpage', 'admin').'</a>'; 
                }
                else if ($home_button == 'frontpagedashboard') { 
                    if (isloggedin()) {
                        $home_button_string = '<a class="brand" href="'.$CFG->wwwroot.'">'.get_string('mymoodle', 'admin').'</a>'; 
                    }
                    else {
                        $home_button_string = '<a class="brand" href="'.$CFG->wwwroot.'">'.get_string('frontpage', 'admin').'</a>'; 
                    }
                }
                else { // Fallback, should not happen
                    $home_button_string = '<a class="brand" href="'.$CFG->wwwroot.'">'.$SITE->shortname.'</a>'; 
                }
                echo $home_button_string;
            ?>
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse collapse">
                <?php echo $OUTPUT->custom_menu(); ?>
                <ul class="nav pull-right">
                    <li><?php echo $OUTPUT->page_heading_menu(); ?></li>
                </ul>
                
                <?php
				$moodle_release = $CFG->version;
				if ($moodle_release > 2015111600) {
					if (!empty($CFG->enableglobalsearch) && has_capability('moodle/search:query', context_system::instance())) {
						$moodle_global_search = 1;
					}
				}?>
                
                <form id="search" action="<?php if ($moodle_global_search) {echo $CFG->wwwroot.'/search/index.php';} else {echo $CFG->wwwroot.'/course/search.php';} ?>" >
                <div class="divider pull-left"></div>
                	<label for="coursesearchbox" class="lambda-sr-only"><?php if ($moodle_global_search) {echo get_string('search', 'search');} else {echo get_string('searchcourses');} ?></label>						
					<input id="coursesearchbox" type="text" onFocus="if(this.value =='<?php if ($moodle_global_search) {echo get_string('search', 'search');} else {echo get_string('searchcourses');} ?>' ) this.value=''" onBlur="if(this.value=='') this.value='<?php if ($moodle_global_search) {echo get_string('search', 'search');} else {echo get_string('searchcourses');} ?>'" value="<?php if ($moodle_global_search) {echo get_string('search', 'search');} else {echo get_string('searchcourses');} ?>" <?php if ($moodle_global_search) {echo 'name="q"';} else {echo 'name="search"';} ?> >
					<button type="submit"><span class="lambda-sr-only"><?php echo get_string('submit'); ?></span></button>						
				</form>
                
            </div>
        </div>
    </nav>
</header>

<?php if ($shadow_effect) { ?>
<div class="container-fluid"><img src="<?php echo $OUTPUT->pix_url('bg/lambda-shadow', 'theme'); ?>" class="lambda-shadow" alt=""></div>
<?php } ?>