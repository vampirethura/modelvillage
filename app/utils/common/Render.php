<?php

class Render
{
	//geneate customs errror page based on the code or message passed in.
	public static function errorPage($code)
	{
	    switch ($code)
	    {
	        case 'NotLogin': //user session expired or not login.
	        	return \Response::view('errors.notlogin');

	        case '403': // forbidden access
	            return \Response::view('errors.403');

	        case '404': // page not found
	            return \Response::view('errors.404', array(), 404);

	        case '500':
	            return \Response::view('errors.500', array(), 500);

	        default:
	            return \Response::view('errors.default', array(), $code);
	    }
	}# end of errorPage


	public static function panelButtons($type='panel-default', $permissions, $actions, $arrayData = [], $arrayPermissionOff=[])
	{
		if ($type == "panel-default")
		{
			//get all the possible permission
			foreach ($permissions as $permission)
			{
				//for each of the permission, construct the buttons then render them
				foreach ($actions as $action)
				{
					$action_url 			= $action['url'];
					$action_label 			= $action['label'];
					$action_icon_bg 		= $action['icon_bg'];
					$action_icon 			= $action['icon'];
					$action_prompt_type 	= $action['prompt_type'];
					$action_prompt_title 	= $action['prompt_title'];
					$action_prompt_content 	= $action['prompt_content'];
					$action_module 			= $action['module'];
					$action_permission 		= $action['permission'];
					$action_page_render 	= $action['page'];
					//$action_position 		= $action['position'];

					if($permission == $action_permission)
					{
						$button_html =
						"<a id='$action_module'
							href='$action_url'
						    title='$action_label'
						    class='btn $action_icon_bg $action_icon_bg m-b-5 create-button'>
						    <i class='fa $action_icon'></i> $action_label
						</a> &nbsp";

						//replace the data with tagging.

						foreach ($arrayData as $key=>$value) $button_html = str_replace($key, $value, $button_html);

						$route_name = Route::currentRouteName();
						$route_name_array = explode('.', $route_name);
						$curr_page = end($route_name_array);

						if($curr_page == $action_page_render)
						{
							echo $button_html;
						}

					}#end if
				}#end foeach
			}#end foreach
		} #end else if
		else if ($type == "panel-alert")
		{
			//get all the possible permission
			foreach ($permissions as $permission)
			{
				//for each of the permission, construct the buttons then render them
				foreach ($actions as $action)
				{
					$action_url 			= $action['url'];
					$action_label 			= $action['label'];
					$action_icon_bg 		= $action['icon_bg'];
					$action_icon 			= $action['icon'];
					$action_prompt_type 	= $action['prompt_type'];
					$action_prompt_title 	= $action['prompt_title'];
					$action_prompt_content 	= $action['prompt_content'];
					$action_module 			= $action['module'];
					$action_permission 		= $action['permission'];
					$action_page_render 	= $action['page'];
					//$action_position 		= $action['position'];

					if($permission == $action_permission)
					{
						$button_html =
						"<a id='$action_permission"."_btn'
							href='javascript:;'
						    title='$action_label'
						    class='btn $action_icon_bg $action_icon_bg m-b-5 create-button'
						    onclick='sendAlert('sure?');'>
						    <i class='fa $action_icon'></i> $action_label
						</a> &nbsp";

						//replace the data with tagging.
						foreach ($arrayData as $key=>$value) $button_html = str_replace($key, $value, $button_html);
						if(!in_array($action_permission, $arrayPermissionOff)) echo $button_html;
					}#end if
				}#end foeach
			}#end foreach
		} #end else if
		else if ($type == "panel-with-modal-delete")
		{			
			//get all the possible permission
			foreach ($permissions as $permission)
			{
				//for each of the permission, construct the buttons then render them
				foreach ($actions as $action)
				{
					$action_url 			= $action['url'];
					$action_label 			= $action['label'];
					$action_icon_bg 		= $action['icon_bg'];
					$action_icon 			= $action['icon'];
					$action_prompt_type 	= $action['prompt_type'];
					$action_prompt_title 	= $action['prompt_title'];
					$action_prompt_content 	= $action['prompt_content'];
					$action_module 			= $action['module'];
					$action_permission 		= $action['permission'];
					$action_page_render 	= $action['page'];
					//$action_position 		= $action['position'];

					if($permission == $action_permission)
					{
						$button_html =
							"<a href='$action_url'
								title='$action_label'
								class='deletion-modal btn $action_icon_bg $action_icon_bg m-b-5 create-button'
								data-title='$action_prompt_title'
								data-content='$action_prompt_content'
								onClick='return false;''>
								<i class='fa $action_icon'></i> $action_label
							</a> &nbsp";
						//replace the data with tagging.
						foreach ($arrayData as $key=>$value) $button_html = str_replace($key, $value, $button_html);
						echo $button_html;
					}#end if
				}#end foeach
			}#end foreach
		} #end else if
	}

	public static function tableButtons($permissions, $actions, $arrayData=[], $arrayPermissionOff=[])
	{
		//get all the possible permission
		foreach ($permissions as $permission)
		{
			//for each of the permission, construct the buttons then render them
			foreach ($actions as $action)
			{
				$action_url 			= $action['url'];
				$action_label 			= $action['label'];
				$action_icon_bg 		= $action['icon_bg'];
				$action_icon 			= $action['icon'];
				$action_prompt_type 	= $action['prompt_type'];
				$action_prompt_title 	= $action['prompt_title'];
				$action_prompt_content 	= $action['prompt_content'];
				$action_module 			= $action['module'];
				$action_permission 		= $action['permission'];
				$action_page_render 	= $action['page'];
				//$action_position 		= $action['position'];

				if($permission == $action_permission)
				{
					//special render for some buttons like delete which has a modal box popup.
					if ($action_prompt_type != 'none')
					{
						if($action_prompt_type == 'confirm')
						{
							$button_html =
							"<a href='$action_url'
								data-toggle='tooltip'
								data-placement='bottom'
								title='$action_label'
								class='deletion-modal btn btn-icon btn-circle btn-lg $action_icon_bg'
								data-title='$action_prompt_title'
								data-content='$action_prompt_content'
								onClick='return false;'>
								<i class='fa $action_icon'></i>
							</a> &nbsp";
						}
						if($action_prompt_type == 'remove')
						{
							$button_html =
							"<a href='$action_url'
								data-toggle='tooltip'
								data-placement='bottom'
								title='$action_label'
								class='removal-modal btn btn-icon btn-circle btn-lg $action_icon_bg'
								data-title='$action_prompt_title'
								data-content='$action_prompt_content'
								onClick='return false;'>
								<i class='fa $action_icon'></i>
							</a> &nbsp";
						}
					}
					else
					{
						$button_html =
						"<a href='$action_url'
						    data-toggle='tooltip'
						    data-placement='bottom'
						    title='$action_label'
						    class='btn btn-icon btn-circle btn-lg $action_icon_bg $action_icon_bg'>
						    <i class='fa $action_icon'></i>
						</a> &nbsp";
					}

					//replace the data with tagging.
					foreach ($arrayData as $key=>$value) $button_html = str_replace($key, $value, $button_html);
					if(!in_array($action_permission, $arrayPermissionOff)) echo $button_html;

				}#end if
			}#end foeach

		}#end foreach

	} #end tablebutton rendering


	//
	public static function permissionActionHelper($permissions, $actions, $type, $arrayData=[])
	{
		if($type=="table")
		{
			//get all the possible permission
			foreach ($permissions as $permission)
			{
				//for each of the permission, construct the buttons then render them
				foreach ($actions as $action)
				{
					$action_url 			= $action['url'];
					$action_label 			= $action['label'];
					$action_icon_bg 		= $action['icon_bg'];
					$action_icon 			= $action['icon'];
					$action_prompt_type 	= $action['prompt_type'];
					$action_prompt_title 	= $action['prompt_title'];
					$action_prompt_content 	= $action['prompt_content'];
					$action_module 			= $action['module'];
					$action_permission 		= $action['permission'];
					$action_page_render 	= $action['page'];
					//$action_position 		= $action['position'];

					if($permission == $action_permission)
					{
						//special render for some buttons like delete which has a modal box popup.
						if ($action_prompt_type != 'none')
						{
							if($action_prompt_type == 'confirm')
							{
								$button_html =
								"<a href='$action_url'
									data-toggle='tooltip'
									data-placement='bottom'
									title='$action_label'
									class='deletion-modal btn btn-icon btn-circle btn-lg $action_icon_bg'
									data-title='$action_prompt_title'
									data-content='$action_prompt_content'
									onClick='return false;''>
									<i class='fa $action_icon'></i>
								</a> &nbsp";
							}
							if($action_prompt_type == 'remove')
							{
								$button_html =
								"<a href='$action_url'
									data-toggle='tooltip'
									data-placement='bottom'
									title='$action_label'
									class='removal-modal btn btn-icon btn-circle btn-lg $action_icon_bg'
									data-title='$action_prompt_title'
									data-content='$action_prompt_content'
									onClick='return false;''>
									<i class='fa $action_icon'></i>
								</a> &nbsp";
							}
						}
						else
						{
							$button_html =
							"<a href='$action_url'
							    data-toggle='tooltip'
							    data-placement='bottom'
							    title='$action_label'
							    class='btn btn-icon btn-circle btn-lg $action_icon_bg $action_icon_bg'>
							    <i class='fa $action_icon'></i>
							</a> &nbsp";
						}

						//replace the data with tagging.
						foreach ($arrayData as $key=>$value) $button_html = str_replace($key, $value, $button_html);

						echo $button_html;

					}#end if
				}#end foeach
			}#end foreach
		}#end if

		else if ($type == "panel-default")
		{
			//get all the possible permission
			foreach ($permissions as $permission)
			{
				//for each of the permission, construct the buttons then render them
				foreach ($actions as $action)
				{
					$action_url 			= $action['url'];
					$action_label 			= $action['label'];
					$action_icon_bg 		= $action['icon_bg'];
					$action_icon 			= $action['icon'];
					$action_prompt_type 	= $action['prompt_type'];
					$action_prompt_title 	= $action['prompt_title'];
					$action_prompt_content 	= $action['prompt_content'];
					$action_module 			= $action['module'];
					$action_permission 		= $action['permission'];
					$action_page_render 	= $action['page'];
					//$action_position 		= $action['position'];

					if($permission == $action_permission)
					{
						$button_html =
						"<a id='$action_module'
							href='$action_url'
						    title='$action_label'
						    class='btn $action_icon_bg $action_icon_bg m-b-5'>
						    <i class='fa $action_icon'></i> $action_label
						</a> &nbsp";

						//replace the data with tagging.

						foreach ($arrayData as $key=>$value) $button_html = str_replace($key, $value, $button_html);

						$route_name = Route::currentRouteName();
						$route_name_array = explode('.', $route_name);
						$curr_page = end($route_name_array);

						if($curr_page == $action_page_render)
						{
							echo $button_html;
						}

					}#end if
				}#end foeach
			}#end foreach
		} #end else if

		else if ($type == "panel-alert")
		{
			//get all the possible permission
			foreach ($permissions as $permission)
			{
				//for each of the permission, construct the buttons then render them
				foreach ($actions as $action)
				{
					$action_url 			= $action['url'];
					$action_label 			= $action['label'];
					$action_icon_bg 		= $action['icon_bg'];
					$action_icon 			= $action['icon'];
					$action_prompt_type 	= $action['prompt_type'];
					$action_prompt_title 	= $action['prompt_title'];
					$action_prompt_content 	= $action['prompt_content'];
					$action_module 			= $action['module'];
					$action_permission 		= $action['permission'];
					$action_page_render 	= $action['page'];
					//$action_position 		= $action['position'];

					if($permission == $action_permission)
					{

						$button_html =
						"<a id='$action_permission"."_btn'
							href='javascript:;'
						    title='$action_label'
						    class='btn $action_icon_bg $action_icon_bg m-b-5'
						    onclick='sendAlert('sure?');'>
						    <i class='fa $action_icon'></i> $action_label
						</a> &nbsp";

						//replace the data with tagging.
						foreach ($arrayData as $key=>$value) $button_html = str_replace($key, $value, $button_html);

						echo $button_html;

					}#end if
				}#end foeach
			}#end foreach
		} #end else if

		else if ($type == "panel3")
		{
			//get all the possible permission
			foreach ($permissions as $permission)
			{
				//for each of the permission, construct the buttons then render them
				foreach ($actions as $action)
				{
					$action_url 			= $action['url'];
					$action_label 			= $action['label'];
					$action_icon_bg 		= $action['icon_bg'];
					$action_icon 			= $action['icon'];
					$action_prompt_type 	= $action['prompt_type'];
					$action_prompt_title 	= $action['prompt_title'];
					$action_prompt_content 	= $action['prompt_content'];
					$action_module 			= $action['module'];
					$action_permission 		= $action['permission'];
					$action_page_render 	= $action['page'];
					//$action_position 		= $action['position'];

					if($permission == $action_permission)
					{
						$button_html =
								"<a href='$action_url'
									title='$action_label'
									class='deletion-modal btn $action_icon_bg $action_icon_bg m-b-5'
									data-title='$action_prompt_title'
									data-content='$action_prompt_content'
									onClick='return false;''>
									<i class='fa $action_icon'></i> $action_label
								</a> &nbsp";

						//replace the data with tagging.
						foreach ($arrayData as $key=>$value) $button_html = str_replace($key, $value, $button_html);

						echo $button_html;

					}#end if
				}#end foeach
			}#end foreach
		} #end else if


	}#end function

}
