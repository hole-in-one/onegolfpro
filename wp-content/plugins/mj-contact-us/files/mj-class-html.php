<?php
class mjContactHTML extends mjContactPRO {

	public  function mjForm()
	{
		global $post;
?>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery("#mailform").validate();
			});
		</script>
		<div>
			<div id="container">
				<h3 id="reply-title"><?php _e('Email Us below:') ;?></h3>
				<form action="<?php echo get_permalink($post->ID); ?>" method="post" id="mailform" enctype="multipart/form-data">
					<input type="hidden" name="CODEINCODE" value="<?php echo MjFunctions::BaseIncode(); ?>">
					<div class="h-71">
						<label for="name"><?php _e('Name') ;?><?php echo (get_option('MJname')==1)? "*" : "";?></label>
						<input  <?php echo (get_option('MJname')==1)? "required='required'" : "";?> name="uname" id="uname" type="name" aria-required="true" class="form-text">
					</div>
					<div class="h-71">
						<label for="email"><?php _e('E-mail') ;?><?php echo (get_option('MJemail')==1)? "*" : "";?></label>
						<input id="email" <?php echo (get_option('MJemail')==1)? "required" : "";?> name="email" type="email" aria-required="true" class="form-text">
					</div>
					<div class="h-71">
						<label for="subject"><?php _e('Subject') ;?><?php echo (get_option('MJsubject')==1)? "*" : "";?></label>
						<input id="subject" <?php echo (get_option('MJsubject')==1)? "required" : "";?> name="subject" type="subject" size="30" aria-required="true" class="form-text">
					</div>
					<div class="h-71">
						<label for="url"><?php _e('Website') ;?><?php echo (get_option('MJwebsite')==1)? "*" : "";?></label>
						<input id="url" <?php echo (get_option('MJwebsite')==1)? "required" : "";?> name="url" type="url" value=""  aria-required="true" class="form-text">
					</div>
					<div class="h-134">
						<label for="message"><?php _e('Comment') ;?><?php echo (get_option('MJcomment')==1)? "*" : "";?></label>
						<textarea id="comment" name="comment" <?php echo (get_option('MJcomment')==1)? "required" : "";?> cols="" rows=""></textarea>
					</div>
					<?php if(get_option('MJcopytome')==1):?>
						<div class="h-71">
							<label for="message"><?php _e('Send copy to me') ;?></label>
							<input type="checkbox" name="copytome" class="w-16" id="copytome" value="1">
						</div>
					<?php endif; ?>
					<div class="h-71">
						<label for="message"><?php _e('Captcha : '. MjFunctions::MathCaptcha()) ;?></label>
						<input id="captcha" required name="captcha" type="text" value=""  aria-required="true" class="form-text">
					</div>
					 <?php if(get_option('MJattachment')):?>
						<div class="h-71">
							<label for="message"><?php _e('Upload Files') ;?></label>
							<input type="file" name="file" id="file" />
						</div>
					<?php endif; ?>
					<div>
						<input name="mj_submit" type="submit" id="submit" value="<?php _e('Send') ;?>">
						<input type="hidden" name="mj_submit" value="active">
						<input type="hidden" name="page_id" value="<?php echo $post->ID; ?>">
					</div>
				</form>
			</div>
		</div>
<?php
	}

	function AdminOption()
	{
?>
		<div id="wrap">
			<div id="container">
				<h3 id="reply-title"><?php _e('Contact US Page Settings') ;?></h3>
				<form action="" method="post" id="mailform">
					<div class="h-43">
						<label for="name"><?php _e('Email Address to recieve Email address') ;?></label>
						<input name="MJmailto" class="f-13" id="mailto" type="text" aria-required="true" value="<?php echo get_option('MJmailto');?>" >
						<small><i><?php _e('if blank then default mail will goes on '.get_option('admin_email'));?></i></small>
					</div>
					<div class="h-43">
						<label for="name"><?php _e('Copy to me') ;?></label>
						<input type="checkbox" class="w-16" name="MJcopytome" <?php echo (get_option('MJcopytome')==1)? "checked='checked'" : "";?> value="1"> <?php _e('Enable this option ?'); ?>
					</div>
					<div class="h-100">
						<label for="name"><?php _e('Other options') ;?></label>
						<input type="checkbox" class="w-16" name="MJname" <?php echo (get_option('MJname')==1)? "checked='checked'" : "";?> value="1"><?php _e(' - Required Name ?') ;?><br/>
						<input type="checkbox" class="w-16" name="MJemail" <?php echo (get_option('MJemail')==1)? "checked='checked'" : "";?> value="1"><?php _e(' - Required Email ?') ;?><br/>
						<input type="checkbox" class="w-16" name="MJsubject" <?php echo (get_option('MJsubject')==1)? "checked='checked'" : "";?> value="1"><?php _e(' - Required Subject ?') ;?><br/>
						<input type="checkbox" class="w-16" name="MJwebsite" <?php echo (get_option('MJwebsite')==1)? "checked='checked'" : "";?> value="1"><?php _e(' - Required Website ?') ;?><br/>
						<input type="checkbox" class="w-16" name="MJcomment" <?php echo (get_option('MJcomment')==1)? "checked='checked'" : "";?> value="1"><?php _e(' - Required Comment ?') ;?><br/>
						<input type="checkbox" class="w-16" name="MJattachment" <?php echo (get_option('MJattachment')==1)? "checked='checked'" : "";?> value="1"><?php _e(' - Enable  Attachment ?') ;?><br/>
					</div>
					<div>
						<input name="MJact" type="hidden" id="MJact" value="insert">
						<input name="Save" type="submit" id="Save" value="<?php _e('Save') ;?>">
					</div>
				</form>
			</div>
		</div>
	<?php
	}

}
?>