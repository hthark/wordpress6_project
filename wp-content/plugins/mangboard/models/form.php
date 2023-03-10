<?php
$desktop_model					= array();
$tablet_model						= array();
$mobile_model					= array();
$desktop_model['version']		= "1.0.0";
$layout_type		= 'responsive-box2';		// responsive-box1, responsive-box2, responsive-box3, responsive-box4
mbw_set_vars("write_layout_type",$layout_type);
mbw_set_vars("mobile_write_layout_type",'responsive-box4');
mbw_set_vars("write_layout_class",'mb-max-width-1000');

// Board Model
$desktop_model['list']		= '
{"type":"list_check","width":"30px","level":"10","class":"list_check"},
{"field":"fn_pid","name":"W_PID","width":"50px","class":"num","type":"pid","class":"pid","responsive":"mb-hide-mobile mb-hide-tablet"},
{"field":"fn_title","name":"W_TITLE","width":"","type":"title","maxlength":"90","maxtext":"..","td_class":"text-left"},
{"field":"fn_user_name","name":"W_NAME","width":"115px","class":"user_name"},
{"field":"fn_content","name":"W_CONTENT","type":"search"},
{"field":"fn_reg_date","name":"W_DATE","width":"85px","type":"date","class":"date","responsive":"mb-hide-mobile"},
{"field":"fn_hit","name":"W_HIT","width":"60px","search":"false","class":"hit","responsive":"mb-hide-mobile mb-hide-tablet"},
{"field":"fn_tag","name":"W_TAG","type":"search"}
';

$desktop_model['list_gallery']		= '
{"field":"fn_image_path","name":"W_IMAGE","width":"100%","height":"220px","tablet_height":"200px","mobile_height":"180px","type":"img_bg","class":"img","link":"view","td_class":"gallery-item-img","search":"false","size":"small"},
{"field":"fn_title","name":"W_TITLE","width":"","type":"title_checkbox","maxlength":"32","maxtext":"..","td_class":"gallery-title"},
{"field":"fn_content","name":"W_CONTENT","type":"search"},
{"field":"fn_reg_date","name":"W_DATE","width":"115px","type":"gallery_date","td_class":"gallery-date"},
{"field":"fn_user_name","name":"W_WRITER","width":"115px","td_class":"gallery-name"},
{"field":"fn_tag","name":"W_TAG","type":"search"}
';
$desktop_model['list_calendar']		= '
{"field":"fn_title","name":"W_TITLE","width":"","type":"title_checkbox","maxlength":"19","maxtext":"..","td_class":"text-left"},
{"field":"fn_content","name":"W_CONTENT","type":"search"},
{"field":"fn_tag","name":"W_TAG","type":"search"}
';


//????????? ?????? ??????
$desktop_model['view']		= '
{"tpl":"tag","tag_name":"table","type":"start","name":"W_VIEW_MSG","width":"20%,*","mobile_width":"80px,*","class":"table table-view"},
{"field":"fn_title","name":"W_TITLE","width":"100px","type":"title","class":"text-left"},
{"field":"fn_category1","name":"W_CATEGORY","width":"100px","display_check":"empty:none","type":"category1","class":"category"},
{"field":"fn_user_name","name":"W_NAME","width":"200px","class":"user_name"},
{"field":"fn_email","name":"W_EMAIL","width":"200px","class":""},
{"field":"file_download","name":"W_ATTACHMENT","width":"100px","type":"file_download","class":"file-download"},
{"field":"fn_content","name":"W_CONTENT","width":"60px","type":"content","td_class":"content-box text-left","colspan":"2"},
{"tpl":"tag","tag_name":"table","type":"end"}
';

//????????? ?????? ??????
$desktop_model['write']		= '
{"tpl":"tag","tag_name":"table","type":"start","name":"W_WRITE","width":"20%,*","mobile_width":"80px,*","class":"table table-write"},
{"field":"fn_category1","name":"W_CATEGORY","width":"100%","type":"category1","class":"category"},
{"field":"fn_user_name","name":"W_NAME","width":"100%","maxlength":"50","required":"(*)","class":"user_name","filter":"filter_admin","filter_error":"MSG_NAME_UNUSABLE"},
{"field":"fn_email","name":"W_EMAIL","width":"100%","required":"(*)","maxlength":"250","pattern":"email","pattern_error":"MSG_EMAIL_FILTER_ERROR"},
{"field":"fn_title","name":"W_TITLE","width":"100%","required":"(*)","class":"text-left","required_error":"MSG_FIELD_EMPTY_ERROR2","filter":"filter_swear","filter_error":"MSG_WORD_UNUSABLE"},
{"field":"fn_content","name":"W_CONTENT","width":"100%","required":"(*)","type":"content","class":"content","td_class":"","required_error":"MSG_FIELD_EMPTY_ERROR2","filter":"filter_swear","filter_error":"MSG_WORD_UNUSABLE"},
{"field":"fn_file1","name":"W_ATTACHMENT","width":"300px","type":"file","class":"file"},
{"tpl":"tag","tag_name":"table","type":"end"}
';


// Comment Model
$desktop_model['comment_list']		= '
{"field":"fn_user_name","name":"W_NAME","width":"100px","class":"cmt-name","type":"cl_name_date"},
{"field":"fn_content","name":"W_CONTENT","width":"60px","class":"cmt-content","type":"cl_content"}
';

$desktop_model['comment_write']		= '
{"tpl":"tag","tag_name":"table","type":"start","name":"W_COMMENT","width":"20%,*","mobile_width":"80px,*","class":"table table-comment"},
{"field":"fn_user_name","name":"W_WRITER","width":"157px","login":"cw_name","required":"(*)","class":"user_name","filter":"filter_admin","filter_error":"MSG_NAME_UNUSABLE"},
{"field":"fn_passwd","name":"W_PASSWORD","width":"157px","login":"none","type":"password","required":"(*)","class":"passwd"},
{"type":"kcaptcha_img","name":"W_KCAPTCHA","width":"70px","height":"30px","class":"kcaptcha","level":{"sign":"<","grade":"1"},"modify":"none","description":"<br>(MSG_CAPTCHA_INPUT)"},
{"field":"fn_content","name":"W_CONTENT","width":"100%","type":"cw_content","required":"(*)","class":"comment","required_error":"MSG_FIELD_EMPTY_ERROR2","filter":"filter_swear","filter_error":"MSG_WORD_UNUSABLE"},
{"tpl":"tag","tag_name":"table","type":"end"}
';
$desktop_model['comment_reply']	= $desktop_model['comment_write'];


// Tablet Model
$tablet_model					= $desktop_model;

// Mobile Model
$mobile_model				= $desktop_model;

$mobile_model['list']		= '
{"type":"list_check","width":"30px","level":"10","class":"list_check"},
{"field":"fn_title","name":"W_TITLE","width":"","type":"title_img","maxlength":"36","maxtext":"..","td_class":"list-title text-left"},
{"field":"fn_user_name","name":"W_WRITER","type":"search"},
{"field":"fn_content","name":"W_CONTENT","type":"search"}
';
mbw_set_filter("filter_swear","18???,18???,18??????,18???,18???,18???,18???,??????,??????,??????,??????,?????????,?????????,?????????,?????????,??????,??????,?????????,?????????,??????,?????????,?????????,??????,???,??????,?????????,?????????,?????????,??????,??????,?????????,?????????,?????????,?????????,?????????,?????????,??????,??????,??????,??????,??????,?????????,??????,??????,??????,??????,??????,?????????,??????,??????,?????????,?????????,?????????,??????,?????????,??????,??????,??????,??????,???8,??????,??????,??????,??????,??????,??????,??????,???,??????,?????????,??????,??????,??????,??????,??????,??????,???8,??????,??????,??????,??????,?????????,?????????,?????????,?????????,?????????,??????,?????????,??????,??????,?????????,??????,??????,??????,?????????,?????????,??????,??????,??????,??????,?????????,??????,??????,?????????,?????????,?????????,?????????,??????,??????,??????,??????,???,???,???,??????,??????,??????,??????,??????,??????,?????????,??????,???,??????,??????,??????");
mbw_set_filter("filter_admin","admin,administrator,?????????,?????????");

mbw_set_pattern("email","/^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i");



//??? ??? ????????? ??????????????? ????????? ?????????
//??? ????????? ??????????????? ????????? ?????????
if(!function_exists('mbw_board_send_mail_api_footer')){
	function mbw_board_send_mail_api_footer(){	
		global $mdb,$mb_fields,$mb_board_table_name,$mstore;
		$where_query			= "";
		$query_command	= "";
		$field						= $mb_fields["select_board"];

		if(mbw_get_param("mode")=="write"){
			$from					= "";
			$to						= "";
			$title						= mbw_get_param("title");
			$content				= mbw_get_param("content");

			if(mbw_get_param("board_action")=="write"){		
				$to				= mbw_get_option("admin_email");		//????????? ????????? ?????????
				if(empty($to)) $to		= get_option("admin_email");  //??????????????? ????????? ?????????
			}else if(mbw_get_param("board_action")=="reply"){
				$to				= $mdb->get_var($mdb->prepare("select ".$field["fn_email"]." from `".$mb_board_table_name."` where ".$field["fn_pid"]."=%d limit 1", mbw_get_param("board_gid")));		//????????? ?????????
			}
			if(!empty($to) && !empty($title) && !empty($content )){
				//?????? ?????? ????????? ??????
				add_filter( 'wp_mail_from', 'mbw_custom_wp_mail_from' );
				function mbw_custom_wp_mail_from( $email ) {
					$from		= "";
					if(mbw_get_param("board_action")=="write"){		
						$from			= mbw_get_param("email");			//????????? ?????????
						if(empty($from)) $from	= get_option("admin_email");				//??????????????? ????????? ?????????
					}else if(mbw_get_param("board_action")=="reply"){
						$from			= mbw_get_param("email");			//????????? ?????????
						if(empty($from)){
							if(mbw_get_option("admin_email")!=""){
								$from	= mbw_get_option("admin_email");		//????????? ????????? ?????????
								if(strpos($from, ',')!==false){
									$email_array	= explode(",",$from);
									$from			= $email_array[0];
								}							
							}
							else $from	= get_option("admin_email");				//??????????????? ????????? ?????????
						}
					}
					return $from;
				}
				//?????? ?????? ?????? ??????
				add_filter( 'wp_mail_from_name', 'mbw_custom_wp_mail_from_name' );
				function mbw_custom_wp_mail_from_name( $name ) {
					if(mbw_get_param("board_action")=="write"){
						if(mbw_is_login())	
							return mbw_get_user("fn_user_name");
						else
							return mbw_get_param("user_name");
					}else if(mbw_get_param("board_action")=="reply"){
						if(mbw_is_login())	
							return mbw_get_user("fn_user_name");
						else return "";
					}
				}
				$headers			= array('Content-Type: text/html; charset=UTF-8');
				$attachments		= array();
				if(!empty($_FILES)){
					$file_data			= $mstore->get_board_files(mbw_get_param("board_pid"));
					if(!empty($file_data)){
						foreach($file_data as $file){
							$attachments[]		= MBW_UPLOAD_PATH.$file[$mb_fields["files"]["fn_file_path"]];
						}
					}
				}
				mbw_mail( $to, wp_specialchars_decode($title), nl2br($content), $headers, $attachments);
			}
		}	
	}
}
add_action('mbw_board_api_footer', 'mbw_board_send_mail_api_footer',5); 



if(!function_exists('mbw_board_skin_form_add_button')){
	function mbw_board_skin_form_add_button(){
		if(mbw_get_param("mode")=='write' && mbw_get_param("board_action")=='write'){
			mbw_set_option("use_write_button",false);
			echo '<div class="btn-box-center">'.mbw_get_btn_template(array("name"=>"W_FORM_SUBMIT","onclick"=>"checkWriteData()","class"=>"btn btn-default btn-send-write","style"=>"height: 38px !important;min-width:200px !important;font-size: 15px !important;margin-top: 40px !important;font-weight:600 !important")).'</div>';
		}
	}
}
add_action('mbw_board_skin_form', 'mbw_board_skin_form_add_button',5);

if(mbw_is_admin_page()){		//????????? ?????????????????? ??????
	if(mbw_get_request_mode()=="Frontend"){
		add_action('mbw_board_skin_search', 'mbw_get_date_search_template');		// ?????? ?????? ????????? ??????
		add_action('mbw_board_skin_header', 'mbw_get_copy_move_template');			// ??????, ?????? ????????? ??????
	}
}else{			
	if(mbw_get_request_mode()=="Frontend"){
		//????????? ?????? ????????? ????????? ???????????? ??????
		mbw_set_param("mode","write");
		mbw_set_param("board_action","write");

		//???????????? ???????????? ?????? ????????? ???????????? ??????
		mbw_set_option("write_next_page","write");
	}

	mbw_set_board_option("fn_list_level",99);
	mbw_set_board_option("fn_view_level",99);
}

?>